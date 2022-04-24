<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ConvertionStoreRequest;

use App\Models\Convertion;

class CurrencyController extends Controller
{
    public function store(ConvertionStoreRequest $request) {
        $convertion = Convertion::create([
            'ip' => $request->ip(),
            'currency' => $request->currency,
            'amount' => $request->amount,
            'crypto' => $request->crypto,
            'result' => $request->result
        ]);
    }
}
