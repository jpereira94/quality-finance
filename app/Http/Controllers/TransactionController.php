<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transaction;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Response;
use Session;

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
//        $transactions = Transaction::groupBy(DB::raw('MONTH(transaction_date), YEAR(transaction_date)'))->select(\DB::raw('transaction_date, SUM(amount*POWER(-1,is_expense)) as balance'))->get();
//        $transactions = Transaction::latest('transaction_date')->with('Account','Company','Category')->get()->groupBy(function($item){
//            return $item->transaction_date->format('m-Y');
//        });

        $transactions = Transaction::latest('transaction_date')->with('Account','Company','Category');

        $transactions = $transactions->whereBetween('transaction_date',['2014-4-00','2014-06-31']);
        $transactions = $transactions->get()->groupBy(function($item){
            return $item->transaction_date->format('m-Y');
        });

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

    public function filterData()
    {
        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $start = Input::get('start_date');
        $end = Input::get('end_date');




        //.....
        //validate data
        //and then store it in DB
        //.....

        $response = array(
            'start' => $start,
            'end' => $end,
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );

        return \Response::json( $response );
    }
}
