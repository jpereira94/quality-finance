<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Account
 *
 * @property integer $id
 * @property string $name
 * @property string $notes
 * @property float $working_capital
 * @property string $balance_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Transaction[] $Transactions
 */
class Account extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'notes',
		'working_capital',
		'balance_date'
	];

	/**
	 * Gets the current balance for the Account
	 *
	 * @param $value
	 * @return string
	 */
	public function getBalanceAttribute($value)
	{
		//get all the transactions for this account
		$transactions = $this->Transactions;
		//get the starting working capital
		$capital = $this->working_capital;

		//iterate through each transaction
		foreach($transactions as $transaction)
		{
			//update the capital
			$capital += $transaction->FormattedAmount();
		}

		//returns it
		return $capital;
	}

	/**
	 * Returns the transactions for the given account
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function Transactions()
	{
		return $this->hasMany(Transaction::class);
	}
}
