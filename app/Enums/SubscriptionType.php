<?php

namespace App\Enums;

enum SubscriptionType
{
    case FreeTrial;
    case PayAsYouGo;
    case CompanyPlan;
    case Unlimited;

    public function canCreateTeams(): bool
    {
        return match ($this) {
            self::FreeTrial => false,
            self::PayAsYouGo => true,
            self::CompanyPlan => true,
            self::Unlimited => true,
        };
    }

    public function maxProjects(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::CompanyPlan => null,
            self::Unlimited => null,
        };
    }

    public function maxRepositories(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::CompanyPlan => 50,
            self::Unlimited => null,
        };
    }

    public function maxBranchesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::CompanyPlan => null, // TODO: tbd
            self::Unlimited => null,
        };
    }

    public function maxFilesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 300,
            self::PayAsYouGo => null,
            self::CompanyPlan => null,
            self::Unlimited => null,
        };
    }
}
