<?php

namespace App\Http\Controllers;

use App\Models\NfcCard;
use App\Http\Requests\StoreNfcCardRequest;
use App\Http\Requests\UpdateNfcCardRequest;
use Illuminate\Support\Facades\Auth;

class NfcCardController extends Controller
{
    public function login (StoreNfcCardRequest $request) {
        $nfc = NfcCard::where([
            'token' => $request->loginToken,
            'pin' => $request->loginPin,
        ])->first();
        if ($nfc) {
            Auth::login($nfc->user);
            $request->session()->regenerate();
            echo 1;
        } else {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNfcCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NfcCard $nfcCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NfcCard $nfcCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNfcCardRequest $request, NfcCard $nfcCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NfcCard $nfcCard)
    {
        //
    }
}
