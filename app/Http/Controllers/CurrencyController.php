<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCurrencyRequest;
use App\Models\Currency;
use App\Models\Utility;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $currencies = [];

        foreach (Currency::all() as $currency) {
            $currencies[$currency->id] = $currency->official_name . " [".$currency->code . "]";
        }

        return view('dashboard.aibopay.currency.view_currencies', ['currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('dashboard.aibopay.currency.new_currency', ['countries' => Utility::COUNTRIES]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NewCurrencyRequest $request
     * @return Response
     */
    public function store(NewCurrencyRequest $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
