<?php

namespace App\Traits;

use App\Models\Project;

trait HasProject
{
    public ?Project $project = null;

    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    public function project(): Project
    {
        return $this->project;
    }
}
