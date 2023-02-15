<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCardRequest;
use App\Models\Card;
use App\Models\Utility;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        return view('dashboard.aibopay.card.view-user-cards', ['cards' => Auth::user()->card]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        return view('dashboard.aibopay.card.create-card', ['types' => Utility::CARD_TYPE, 'banks' => Utility::BANKS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(NewCardRequest $request): Redirector|Application|RedirectResponse
    {
        $request->validated();

        $monthYear = explode("-", $request->get('expiry-month'));

        $expiryMonth = $monthYear[1];
        $expiryYear = $monthYear[0];

        Card::create([
            'user_id' => Auth::user()->id,
            'type' => $request->get('type'),
            'number' => $request->get('card-number'),
            'expiryMonth' => $expiryMonth,
            'bank' => $request->get('bank-name'),
            'expiryYear' => $expiryYear,
            'pin' => $request->get('card-pin'),
            'cvv' => $request->get('card-cvv')
        ]);

        return redirect(route('card.view', ['cards' => Auth::user()->card]));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     */
    public function destroy(int $id)
    {
        Card::destroy($id);
        return redirect(route('card.view', ['cards' => Auth::user()->card]))->with(['message'=>'Card deleted']);

    }
}
