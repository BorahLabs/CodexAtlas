<?php

namespace App\View\Components\Atlas;

use App\Models\Branch;
use App\Models\SystemComponent;
use App\SourceCode\DTO\Atlas\NavigationItem;
use App\SourceCode\DTO\Atlas\NavigationSection;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Navigation extends Component
{
    public Collection $sections;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Branch $branch,
    ) {
        $this->loadSystemComponents();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atlas.navigation');
    }

    protected function loadSystemComponents(): void
    {
        $this->branch->load('systemComponents:id,branch_id,order,path,status', 'repository.project');
        $sections = $this->branch->systemComponents
            ->sortBy('order')
            ->mapWithKeys(fn (SystemComponent $component) => [$component->folder => new NavigationSection($component->folder)])
            ->toArray();

        $this->branch->systemComponents
            ->each(fn (SystemComponent $component) => $sections[$component->folder]->addItem(new NavigationItem(
                name: $component->name,
                url: route('docs.show-component', [
                    'project' => $this->branch->repository->project,
                    'repository' => $this->branch->repository,
                    'branch' => $this->branch,
                    'systemComponent' => $component,
                ]),
            )));

        $this->sections = collect([
            new NavigationSection(name: 'General', children: [
                new NavigationItem('README', route('docs.show-readme', [
                    'project' => $this->branch->repository->project,
                    'repository' => $this->branch->repository,
                    'branch' => $this->branch,
                ])),
                new NavigationItem('Tech Stack', route('docs.show-tech-stack', [
                    'project' => $this->branch->repository->project,
                    'repository' => $this->branch->repository,
                    'branch' => $this->branch,
                ])),
            ]),
            ...$sections,
        ]);
    }
}
