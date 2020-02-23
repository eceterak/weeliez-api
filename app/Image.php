<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     *  Get the image owner.
     */
    public function owner() 
    {
        return $this->morphTo();
    }
}
