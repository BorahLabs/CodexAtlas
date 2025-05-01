<?php

namespace App\Services;

class BuyoutService
{
    public static function isAuctionActive()
    {
        $auctionStart = now()->parse('2025-05-31');
        return today()->isAfter($auctionStart);
    }

    public static function getPrice()
    {
        $auctionStart = now()->parse('2025-06-01');
        if (today()->isBefore($auctionStart)) {
            return 60000;
        }

        $startPrice = 100000;
        $daysSinceStart = today()->diffInDays($auctionStart);
        $price = $startPrice - ($daysSinceStart * 500);

        return max(20000, $price);
    }
}
