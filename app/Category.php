<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property integer $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $Child
 * @method static \Illuminate\Database\Query\Builder|\App\Category parents()
 */
class Category extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'color',
		'category_id'
	];

	/**
	 * Returns the parent category
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function Parent()
	{
		return Category::findOrFail($this->category_id);
	}

	/**
	 * Return ths children category for this parent
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function Child()
	{
		return $this->hasMany(Category::class);
	}

	/**
	 * Returns the category that are parents, i.e. that has no value in category_id
	 * @param $query
	 * @return mixed
     */
	public function scopeParents($query)
	{
		return $query->whereNull('category_id')->get();
	}
}
