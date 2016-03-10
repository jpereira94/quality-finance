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
 * @property-read mixed $compound_name
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
	 * Returns whether or not the parent has any children
	 * @return bool
     */
	public function HasChild()
	{
		return ($this->Child()->count()) ? true : false;
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

	/**
	 * Makes the category id equal to null if the choose ID is set to 0
	 *
	 * @param $value
     */
	public function setCategoryIdAttribute($value)
	{
		$this->attributes['category_id'] = ($value) ? $value : null;
	}


	/**
	 * Check whether or not the category is a parent category or not
	 * @return bool
     */
	private function is_parent()
	{
		return is_null($this->category_id);
	}

	/**
	 * Generates a prefix name to get the parent category name
	 * @return null|string
	 */
	public function getCompoundNameAttribute($value)
	{
		if($this->is_parent())
			return $this->name;
		else
			return $this->Parent()->name. ' : '. $this->name;
	}

	/**
	 * Convert the model instance to an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$array = parent::toArray();
		$array['compound_name'] = $this->compound_name;
		return $array;
	}
}
