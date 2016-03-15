<?php

namespace App\Http\Controllers;

use App\Account;
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
     * TransactionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Transaction::orderBy('transaction_date')->select('transaction_date')->get();

        $dates = [
            'first' => $collection->first()->transaction_date->toDateString(),
            'last'  => $collection->last()->transaction_date->toDateString(),
        ];

//        dd($dates);


//        $transactions = Transaction::latest('transaction_date')->with('Account','Company','Category');
//
//        $transactions = $transactions->get()->groupBy(function($item){
//            return $item->transaction_date->format('m-Y');
//        });

        return view('transactions.index', compact('dates'));
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
//        dd($request->all());
        //gets all the inputs
        $inputs = $request->all();
        //add ths correctly formatted date to the correct name...
        $inputs['transaction_date'] = $inputs['transaction_date_submit'];
        $inputs['payment_date'] = $inputs['payment_date_submit'];
        //and unset the unnecessary name
        unset($inputs['transaction_date_submit']);
        unset($inputs['payment_date_submit']);

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
        dd('update');
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
        $inputs['payment_date'] = $inputs['payment_date_submit'];
        //and unset the unnecessary name
        unset($inputs['transaction_date_submit']);
        unset($inputs['payment_date_submit']);


        //if the is_expense checkbox is unchecked then add it to the inputs field
        if(!isset($inputs['is_expense']))
            $inputs['is_expense'] = 0;

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

    /**
     * Gets the filtered transactions for ajax request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterData()
    {

        $start = Input::get('start_date');
        $end = Input::get('end_date');

        $start = strtotime($start);
        $end = strtotime($end);

        //validates the dates
        if($start == false || $end == false)
        {
            return Response::json(array(
                'success' => false,
                'errors'  => 'Invalid date set!',
            ), 400);
        }

        //switch the dates if they were put in reverse order
        if ($start > $end)
        {
            $temp = $start;
            $start = $end;
            $end = $temp;
        }

        //instanciates a carbon for start and end
        $start = Carbon::createFromTimestamp($start);
        $end = Carbon::createFromTimestamp($end);


        $transactions = Transaction::latest('transaction_date')->with('Account','Company','Category');

        $transactions = $transactions->whereBetween('transaction_date',[$start->toDateString(), $end->toDateString()]);
        $transactions = $transactions->get()->groupBy(function($item){
            return $item->transaction_date->format('m-Y');
        });

        foreach($transactions as $date => $transaction_grouped)
        {
            $balances[$date] = format_balance($transaction_grouped->sum(function ($transaction){return $transaction['amount']*pow(-1,$transaction['is_expense']);}));
        }

        $response = array(
            'start'         => $start,
            'end'           => $end,
            'status'        => 'success',
            'msg'           => 'Data filtered correctly',
            'transactions'  => $transactions,
            'balances'      => $balances
        );

        return \Response::json( $response );
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generatePDF()
    {
        /*
         * group by
         * if 0 then doesnt group, i.e., returns ordered by date
         */

        $filtering = Input::all();


        //handles exception when the start_date has not been defined
        if(!isset($filtering['start_date']) ) {
            $filtering['start_date'] = Transaction::orderBy('transaction_date')->select('transaction_date')->get()->first()->transaction_date->toDateString();
        }
        //handles exception when the end_date has not been defined
        if(!isset($filtering['end_date']) ) {
            $filtering['end_date'] = Transaction::orderBy('transaction_date')->select('transaction_date')->get()->last()->transaction_date->toDateString();
        }
        //handles exception when the account has not been defined
        if(!isset($filtering['account'])) {
            $filtering['account'] = 0;
        }
        //handles exception when the show option has not been defined
        if(!isset($filtering['show'])) {
            $filtering['show'] = -1;
        }



        $transactions = Transaction::latest('transaction_date')
                        ->with('Account','Company','Category')
                        ->whereBetween('transaction_date',[$filtering['start_date'], $filtering['end_date']]);

        if($filtering['account']) {
            $transactions = $transactions->where('account_id', $filtering['account']);
            $filtering['account'] = Account::find($filtering['account'])->name;
        }
        else
        {
            $filtering['account'] = 'Todas';
        }


        if($filtering['show'] != -1)
        {
            $transactions = $transactions->where('is_expense', $filtering['show']);
            $filtering['show'] = ($filtering['show']) ? 'Despesas' : 'Receitas';
        }
        else
        {
            $filtering['show'] = 'Todas';
        }

        $transactions = $transactions->get();
//        dump($transactions->first()->formatted_amount);
//        dd($transactions->sum('formatted_amount'));

//        dd($filtering);

//        return view('transactions.transactions', compact('transactions', 'filtering'));
        return \PDF::loadView('transactions.transactions', compact('transactions', 'filtering'))
                ->inline();
    }
}
