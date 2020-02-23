<?php

namespace App;

use App\Filters\QueryFilter;
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
     * Eager loading.
     * 
     * @var array
     */
    protected $with = [
        'images'
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

    /**
     * Scope to get access to QueryBuilder.
     * 
     * @param $query
     * @param QueryFilter $filters
     * @return QueryFilters
     */
    public function scopeFilter($query, QueryFilter $filters) 
    {
        return $filters->apply($query);
    }

    /**
     * Get all images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'owner');
    }
}
