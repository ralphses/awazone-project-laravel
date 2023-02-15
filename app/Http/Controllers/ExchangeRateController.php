<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewExchangeRateRequest;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        ExchangeRate::
    }

    /**
     * Store a newly created resource in storage.
     * @param NewExchangeRateRequest $request
     * @return Response
     */
    public function store(NewExchangeRateRequest $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response
     */
    public function show(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response
     */
    public function edit(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response
     */
    public function update(Request $request, ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        //
    }
}
