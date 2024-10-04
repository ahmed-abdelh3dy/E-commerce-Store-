<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;

class DelvieriesController extends Controller


{
    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',

        ]);

        $delivery->update([
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        return response()->json(['message' => 'Delivery updated successfully', 'delivery' => $delivery]);
    }

    public function show(Delivery $delivery){
    return $delivery;
    }
}
