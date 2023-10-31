<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Stripe\Charge;
use Stripe\Price;
use Stripe\Product;
use Stripe\Checkout\Session;
use Stevebauman\Location\Facades\Location;
use AmrShawky\LaravelCurrency\Facade\Currency;

class StripeController extends Controller
{
    public function retrieveProduct(Request $request)
    {
        try {
            $data = $request->query('starting_after');
            $productsWithPrices = [];
            $products = Product::all([
                // 'limit' => 3,
                // 'starting_after' => $data
            ]);
            foreach ($products as $product) {
                $prices = Price::all(['product' => $product->id]);
                $productWithPrices = [
                    'product' => $product,
                    'prices' => $prices,
                ];
                $productsWithPrices[] = $productWithPrices;
            }
            return View::make('welcome', ['products' => $productsWithPrices]);
            // return $product;
        } catch (\Error $th) {
            throw $th;
        }
    }

    public function buyProduct(Request $request)
    {
        try {
            $data = $request->all();

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'AUD',
                            'product_data' => [
                                'name' => 'T-shirt',
                            ],
                            'unit_amount' => 2000,
                        ],
                        'quantity' => $data['quantity'],
                    ],
                ],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8000/success',
                'cancel_url' => 'http://localhost:8000/cancel',
            ]);
            return $session->url;
        } catch (\Error $th) {
            throw $th;
        }
    }

    public function chargeProduct(Request $request)
    {
        try {
            $data = $request->all();

            $charge = Charge::create([
                'amount' => 9000 * 100,
                'currency' => 'lkr',
                'source' => 'tok_1O5QAeGEjKvfQnqpS13DOOI7',
                'description' => 'My First Test Charge ',
            ]);
            return $charge;
        } catch (\Error $th) {
            throw $th;
        }
    }

    public function buyStripeProduct(Request $request)
    {
        try {
            //INR 59.144.33.0
            //USA 101.36.115.0
            //LKR 103.138.180.50

            $clientIP = request()->ip();

            $productIds = [];
            $position = Location::get($clientIP);

            $prices = Price::all(["currency" => $position->currencyCode]);

            foreach ($prices as $price) {
                $productIds[] = $price->product;
            }
            // Log::info($productIds);

            $products = [];
            foreach ($productIds as $productId) {
                $product = Product::retrieve($productId);
                if ($product) {
                    $products[] = $product;
                }
            }
            // Log::info($products);
            $productsWithPrices = [];
            foreach ($products as $product) {
                $productPrices = [];
                foreach ($prices as $price) {
                    if ($price->product === $product->id) {
                        $productPrices[] = $price;
                    }
                }
                $productsWithPrices[] = [
                    'product' => $product,
                    'prices' => $productPrices,
                ];
            }
            return View::make('welcome', ['products' => $productsWithPrices]);
            // Log::info($productsWithPrices);

            // if ($position = Location::get('66.105.0.0')) {
            //     $prices = Price::all([
            //         "currency"=>$position->countryName
            //     ]);
            //     $products = Product::retrieve($prices->data->product);
            //     Log::info($prices);
            //     Log::info($products);
            //     echo $position;
            //     Log::info($position);
            // } else {
            // Failed retrieving position.
            // }





            // $data = $request->all();

            // $session = Session::create([
            //     'payment_method_types' => ['card'],
            //     'currency'=>'LKR',
            //     'line_items' => [
            //         [
            //             'price' => $data['price'],
            //             'quantity' => $data['quantity'],

            //         ],
            //     ],
            //     'mode' => 'payment',
            //     'success_url' => 'http://localhost:8000/success',
            //     'cancel_url' => 'http://localhost:8000/cancel',
            // ]);
            // return $session->url;

        } catch (\Error $th) {
            throw $th;
        }
    }


    public function retrieve(Request $request)
    {
        try {

            $fromCurrency = "USD";
            $toCurrency = "LKR";
            $amount = 10;

            // Fetch exchange rates from an external API (e.g., Open Exchange Rates API)
            $client = new Client();
            // $response = $client->get("https://api.openexchangerates.org/latest?base={$fromCurrency}&app_id=5fe991d78c4b4e108c568e6f02f542b9");
            // $response = `https://openexchangerates.org/api/convert/{$amount}/{$fromCurrency}/{$toCurrency}`;
            $respon = `https://openexchangerates.org/api/latest.json?app_id=5fe991d78c4b4e108c568e6f02f542b9`;

            Log::info($respon);
            // $data = json_decode($response->getBody());
            // Calculate the converted amount
            //         $conversionRate = $data->rates->$toCurrency;
            //         $convertedAmount = $amount * $conversionRate;

            // Log::info("". $convertedAmount ."". $toCurrency);
            //         return response()->json(['amount' => $convertedAmount, 'currency' => $toCurrency]);



            //       $result =  Currency::convert()
            //         ->from('USD')
            //         ->to('EUR')
            //         ->amount(50)
            //         ->get();
            // Log::info($result);

            // return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
