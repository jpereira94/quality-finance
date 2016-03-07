<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Transaction
 *
 * @property integer $id
 * @property \Carbon\Carbon $date
 * @property integer $company_id
 * @property integer $category_id
 * @property integer $account_id
 * @property boolean $is_expense
 * @property float $amount
 * @property string $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Account $Account
 * @property-read \App\Company $Company
 * @property-read \App\Category $Category
 */
class Transaction extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'date',
		'company_id',
		'category_id',
		'account_id',
		'is_expense',
		'amount',
		'notes',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['date'];

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
}
