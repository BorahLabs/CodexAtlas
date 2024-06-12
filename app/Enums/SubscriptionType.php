<?php

namespace App\Enums;

enum SubscriptionType
{
    case FreeTrial;
    case PayAsYouGo;
    case LimitedCompanyPlan;
    case UnlimitedCompanyPlan;
    case Unlimited;

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
            self::LimitedCompanyPlan => null,
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
        };
    }

    public function maxBranchesPerRepository(): ?int
    {
        return match ($this) {
            self::FreeTrial => 1,
            self::PayAsYouGo => null,
            self::LimitedCompanyPlan => null,
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

    public function maxSingleCodeDocumentations(): ?int
    {
        return match ($this) {
            self::LimitedCompanyPlan => null,
            self::UnlimitedCompanyPlan => null,
            self::Unlimited => null,
            default => 30,
        };
    }

    public function maxCodeConversions(): ?int
    {
        return match ($this) {
            self::LimitedCompanyPlan => 100,
            self::UnlimitedCompanyPlan => 100,
            self::Unlimited => 100,
            default => 5,
        };
    }
}
