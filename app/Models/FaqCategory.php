<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FaqCategory extends Model
{

    protected static function boot() {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name,'-');
        });
    }



    use SoftDeletes;

    protected $table = 'faq_categories';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name' => 'required|min:3:max:255',
    ];

    /**
     * Get the faqs
     */
    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'category_id')->orderBy('list_order');
    }
    
    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
    	return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }
}