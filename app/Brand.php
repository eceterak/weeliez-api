<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Set the slug while creating a new Brand.
     */
    protected static function boot()
    {
        parent::boot();

        // Generate the slug. See @setSlugAttribute
        static::creating(function($brand) 
        {
            $brand->slug = $brand->name;
        });
    }
}
