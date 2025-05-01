<?php

namespace App\Http\Controllers;

use App\Services\BuyoutService;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class RedirectToBuyout extends Controller
{
    public function __invoke()
    {
        $stripe = Cashier::stripe();
        $price = BuyoutService::getPrice();
        $session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => 'CodexAtlas ownership',
                        ],
                        'unit_amount' => $price * 100,
                        'currency' => 'usd',
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('homepage', ['purchase' => 'success']),
            'cancel_url' => route('buyout'),
        ]);

        return redirect($session->url);
    }
}
