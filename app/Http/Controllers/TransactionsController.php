<?php

namespace App\Http\Controllers;
use App\Models\Dispute;
use App\Models\Transaction;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function dispute(Request $request)
    {
        // dd($request->all());

        $transaction = Transaction::find($request->transaction);

        $dispute = new Dispute();
        $dispute->title = $request->subject;
        $dispute->body = $request->description;
        $dispute->transaction_id = $request->transaction;
        if (isset($request->evidence)) {
            $dispute->payee_proof = $request->evidence->store('public');
        }

        $transaction->disputed = 1;

        $transaction->save();

        if ($dispute->save()) {

            return redirect()->route('sold')->with(["message" => "Dispute Submitted Successfully, we will address it before the next round of investments", "alert-type" => "success"]);
        }
    }

    public function disputeproof(Request $request)
    {
        $file = $request->evidence->store('public');
        $transaction = Transaction::find($request->transaction);

        $transaction->payer_proof = $file;

        if ($transaction->save()) {

            return redirect()->route('bought')->with(["message" => "Evidence Submitted Successfully, we will review it before the next round of investments", "alert-type" => "success"]);
        }
    }
}
