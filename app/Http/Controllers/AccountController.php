<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        return view('settings.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        //gets all the inputs
        $inputs = $request->all();
        //add ths correctly formatted date to the correct name...
        $inputs['balance_date'] = $inputs['balance_date_submit'];
        //and unset the unnecessary name
        unset($inputs['balance_date_submit']);

        //finally, add the account to the database
        Account::create($inputs);

        //return to the index view
        return redirect()->action('AccountController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        dd($account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account $account
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Account $account)
    {
        return view('settings.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccountRequest $request
     * @param Account $account
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(AccountRequest $request, Account $account)
    {
        //gets all the inputs
        $inputs = $request->all();
        //add ths correctly formatted date to the correct name...
        $inputs['balance_date'] = $inputs['balance_date_submit'];
        //and unset the unnecessary name
        unset($inputs['balance_date_submit']);

        //finally, update the account to the database
        $account->update($inputs);

        //return to the index view
        return redirect()->action('AccountController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        //return to the index view
        return redirect()->action('AccountController@index');
    }
}
