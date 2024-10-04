<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\services\currencyConverter;
use Illuminate\Support\Facades\Cache;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Currency_code ' => 'required|string|size:3'
        ]);
        $Currency_code = $request->input('currency_code');

        Session::put('currency_code', $Currency_code,);

        $baseCurrency = config('app.currency');

        $rates = Cache::get('currency_rates', []);
        if (!isset($rates[$Currency_code])) {
            $converter = new currencyConverter(config('services.Currency_Converter.api_key'));
            $rate = $converter->convert($baseCurrency, $Currency_code);
            $rates[$Currency_code] = $rate;

            Cache::put('currency_rate', $rates, now()->addMinutes(60));
        }



        Session::put('currency_rates', $rate,);

        return redirect()->back();
    }
}
