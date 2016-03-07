<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transaction;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $transactions = Transaction::groupBy('transaction_date')select(\DB::raw('transaction_date, SUM(amount*POWER(-1,is_expense)) as balance'))->get();
        $transactions = Transaction::groupBy(DB::raw('MONTH(transaction_date), YEAR(transaction_date)'))->select(\DB::raw('transaction_date, SUM(amount*POWER(-1,is_expense)) as balance'))->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        //gets all the inputs
        $inputs = $request->all();
        //add ths correctly formatted date to the correct name...
        $inputs['transaction_date'] = $inputs['transaction_date_submit'];
        //and unset the unnecessary name
        unset($inputs['transaction_date_submit']);

        //finally, add the account to the database
        Transaction::create($inputs);

        //return to the index view
        return redirect()->action('TransactionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransactionRequest $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        //gets all the inputs
        $inputs = $request->all();
        //add ths correctly formatted date to the correct name...
        $inputs['transaction_date'] = $inputs['transaction_date_submit'];
        //and unset the unnecessary name
        unset($inputs['transaction_date_submit']);

        //if the is_expense checkbox is unchecked then add it to the inputs field
        if(!isset($inputs['is_expense']))
            $inputs['is_expense'] = 1;

        //finally, add the account to the database
        $transaction->update($inputs);

        //return to the index view
        return redirect()->action('TransactionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        //return to the index view
        return redirect()->action('TransactionController@index');
    }
}
