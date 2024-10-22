<?php

namespace App\Livewire\DigitalOnboarding\Traits;

trait HasNavigation
{
  public function next()
  {
      $this->dispatch('next-step');
  }

  public function previous()
  {
      $this->dispatch('previous-step');
  }
}
