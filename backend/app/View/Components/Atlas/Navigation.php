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
        $branch->load('systemComponents:id,branch_id,order,path,status', 'repository.project');
        $sections = $branch->systemComponents
            ->sortBy('order')
            ->mapWithKeys(fn (SystemComponent $component) => [$component->folder => new NavigationSection($component->folder)])
            ->toArray();

        $branch->systemComponents
            ->each(fn (SystemComponent $component) => $sections[$component->folder]->addItem(new NavigationItem(
                name: $component->name,
                url: route('docs.show-component', [
                    'project' => $branch->repository->project,
                    'repository' => $branch->repository,
                    'branch' => $branch,
                    'systemComponent' => $component,
                ]),
            )));

        $this->sections = collect([
            new NavigationSection(name: 'General', children: [
                new NavigationItem('README', route('docs.show-readme', [
                    'project' => $branch->repository->project,
                    'repository' => $branch->repository,
                    'branch' => $branch,
                ])),
            ]),
            ...$sections,
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atlas.navigation');
    }
}
