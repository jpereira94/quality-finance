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
//	    return number_format($this->working_capital, 2, ',', ' ');
		return $this->working_capital;
	}
}
