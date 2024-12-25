<?php

namespace App\Cashier;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use RuntimeException;
use Spark\Spark;

class StripePlanProvider
{
    public static function price(string $priceId): \Stripe\Price
    {
        $price = Cashier::stripe()->prices->retrieve($priceId);
        $price->rawPrice = $price->unit_amount;

        $amount = Cashier::formatAmount($price->unit_amount, $price->currency);

        if (Str::endsWith($amount, '.00')) {
            $amount = substr($amount, 0, -3);
        }

        if (Str::endsWith($amount, '.0')) {
            $amount = substr($amount, 0, -2);
        }

        $price->price = $amount;

        $price->currency = $price->currency;

        return $price;
    }

    public static function plans(string $type = 'user'): Collection
    {
        return Cache::remember('spark-plans-'.$type.'-v3', now()->addHour(), function () use ($type) {
            $plans = Spark::plans($type);

            $prices = collect(Cashier::stripe()->prices->all(['limit' => 100])->autoPagingIterator());

            return $plans->map(function (\Spark\Plan $plan) use ($prices) {
                if (! $stripePrice = $prices->firstWhere('id', $plan->id)) {
                    throw new RuntimeException('Price ['.$plan->id.'] does not exist in your Stripe account.');
                }

                $plan->rawPrice = $stripePrice->unit_amount;

                $price = Cashier::formatAmount($stripePrice->unit_amount, $stripePrice->currency);

                if (Str::endsWith($price, '.00')) {
                    $price = substr($price, 0, -3);
                }

                if (Str::endsWith($price, '.0')) {
                    $price = substr($price, 0, -2);
                }

                // @phpstan-ignore-next-line
                $plan->price = $price;

                $plan->currency = $stripePrice->currency;

                return $plan;
            });
        });
    }
}
