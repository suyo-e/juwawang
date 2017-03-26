<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Banner
 * @package App\Models\Backend
 * @version March 11, 2017, 7:46 am UTC
 */
class Banner extends Model
{
    use SoftDeletes;

    public $table = 'banners';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'display_name',
        'url',
        'pic_url',
        'type',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_name' => 'string',
        'url' => 'string',
        'pic_url' => 'string',
        'type' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'display_name' => 'required|string',
        'url' => 'string',
        'pic_url' => 'file',
        'type' => 'required|numeric',
        'description' => 'string'
    ];

    
}
