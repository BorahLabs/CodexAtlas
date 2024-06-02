<?php

namespace App\Console\Commands\Internal;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use Illuminate\Console\Command;
use function Laravel\Prompts\multiselect;

class MakeCodeConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:code-converter {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $code = '<?php

namespace App\CodeConverter\Tools;

use {fromNamespace};
use {toNamespace};

class {from}To{to} extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new {from}(), new {to}());
    }
}
';

        $from = array_filter(array_map('trim', explode(',', $this->argument('from'))));
        $to = array_filter(array_map('trim', explode(',', $this->argument('to'))));
        if (empty($from)) {
            $from = multiselect('From: ', options: [
                ...collect(Guesser::supportedFrameworks())->map(fn (Framework $f) => $f->name())->toArray(),
                ...collect(Guesser::supportedLanguages())->map(fn (Language $l) => $l->name())->toArray(),
            ]);
        }

        if (empty($to)) {
            $to = multiselect('To: ', options: [
                ...collect(Guesser::supportedFrameworks())->map(fn (Framework $f) => $f->name())->toArray(),
                ...collect(Guesser::supportedLanguages())->map(fn (Language $l) => $l->name())->toArray(),
            ]);
        }

        $from = collect($from)
            ->map(fn (string $name) => Guesser::fromName($name));
        $to = collect($to)
            ->map(fn (string $name) => Guesser::fromName($name));

        foreach ($from as $fromItem) {
            $fromNamespace = get_class($fromItem);
            foreach ($to as $toItem) {
                $toNamespace = get_class($toItem);
                $classCode = strtr($code, [
                    '{fromNamespace}' => $fromNamespace,
                    '{toNamespace}' => $toNamespace,
                    '{from}' => class_basename($fromNamespace),
                    '{to}' => class_basename($toNamespace),
                ]);
                $className = app_path('CodeConverter/Tools/'.class_basename($fromNamespace).'To'.class_basename($toNamespace).'.php');
                file_put_contents($className, $classCode);
            }
        }
    }
}
