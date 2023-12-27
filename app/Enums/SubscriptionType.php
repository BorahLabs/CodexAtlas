<?php

namespace App\Enums;

enum SubscriptionType
{
    case FreeTrial;
    case PayAsYouGo;
    case CompanyPlan;

    public function canCreateTeams(): bool
    {
        return match ($this) {
            self::FreeTrial => false,
            self::PayAsYouGo => true,
            self::CompanyPlan => true,
        };
    }

    public function maxProjects(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::CompanyPlan => null,
        };
    }

    public function maxRepositories(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::CompanyPlan => 50,
        };
    }

    public function maxFilesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 300,
            self::PayAsYouGo => null,
            self::CompanyPlan => null,
        };
    }
}
