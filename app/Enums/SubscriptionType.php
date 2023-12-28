<?php

namespace App\Enums;

enum SubscriptionType
{
    case FreeTrial;
    case PayAsYouGo;
    case LimitedCompanyPlan;
    case UnlimitedCompanyPlan;
    case Unlimited;

    public function canCreateTeams(): bool
    {
        return match ($this) {
            self::FreeTrial => false,
            self::PayAsYouGo => true,
            self::LimitedCompanyPlan => true,
            self::UnlimitedCompanyPlan => true,
            self::Unlimited => true,
        };
    }

    public function maxProjects(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::LimitedCompanyPlan => null,
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
        };
    }

    public function maxRepositories(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::LimitedCompanyPlan => 80,
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
        };
    }

    public function maxBranchesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::LimitedCompanyPlan => null, // TODO: tbd
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
        };
    }

    public function maxFilesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 300,
            self::PayAsYouGo => null,
            self::LimitedCompanyPlan => null,
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
        };
    }
}
