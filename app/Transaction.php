<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Transaction
 *
 * @property integer $id
 * @property \Carbon\Carbon $transaction_date
 * @property \Carbon\Carbon $payment_date
 * @property integer $company_id
 * @property integer $category_id
 * @property integer $account_id
 * @property boolean $is_expense
 * @property string $invoice_number
 * @property float $amount
 * @property float $tax
 * @property string $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Account $Account
 * @property-read \App\Company $Company
 * @property-read \App\Category $Category
 * @property-read mixed $color_code
 */
class Transaction extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'transaction_date',
		'payment_date',
		'company_id',
		'category_id',
		'account_id',
		'is_expense',
		'amount',
		'notes',
		'invoice_number',
		'tax',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['transaction_date', 'payment_date'];

	/**
	 * Get the account where the transaction was made.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function Account()
	{
	    return $this->belongsTo(Account::class);
	}

	/**
	 * A transaction must have a company.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function Company()
	{
	    return $this->belongsTo(Company::class);
	}

	/**
	 * A transaction must have a category.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function Category()
	{
	    return $this->belongsTo(Category::class);
	}

	/**
	 * Convert the model instance to an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$array = parent::toArray();
		$array['color_code'] = $this->color_code;
		$array['formatted_amount'] = $this->FormattedAmount(true);
		return $array;
	}

	/**
	 * Formats the transaction_date field to be according to carbon standards
	 * @param $value
     */
	public function setTransactionDateAttribute($value)
	{
		$this->attributes['transaction_date'] = Carbon::createFromFormat('Y-m-d', $value);
	}
	/**
	 * Formats the payment_date field to be according ot carbon standards
	 * @param $value
	 */
	public function setPaymentDateAttribute($value)
	{
		//only set the payment if the user set it, otherwise the app would crash
		if($value)
	        $this->attributes['payment_date'] = Carbon::createFromFormat('Y-m-d', $value);
	}

	/**
	 * Returns the formatted amount
	 * @param $value
	 * @return float
	 */
	public function getFormattedAmountAttribute($value)
	{
		return $this->is_expense ? $this->amount * -1 : $this->amount;
	}

	/**
	 * Returns a formatted amount, i.e. if is expense then return a negative amount, otherwise return a positive number
	 * @return float
     */
	public function FormattedAmount($str = false)
	{
		$amount = $this->is_expense ? $this->amount * -1 : $this->amount;
		if(!$str) {
			return $amount;
		}
		else
			return format_balance($amount);
	}

	/**
	 * Accessor to get the color code
	 *
	 * @param $value
	 * @return string
     */
	public function getColorCodeAttribute($value)
	{
		return $this->is_expense ? 'blue-text text-accent-2' : 'green-text';
	}

	/**
	 *  Returns only the transactions that are expenses
	 * @param $query
	 * @return mixed
	 */
	public function scopeExpenses($query)
	{
	    return $query->where('is_expense', '1');
	}

	/**
	 * Returns only the transactions that are revenues
	 * @param $query
	 * @return mixed
	 */
	public function scopeRevenues($query)
	{
	    return $query->where('is_expense', '0');
	}


}
