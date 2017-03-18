<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Industry
 * @package App\Models\Backend
 * @version March 11, 2017, 7:45 am UTC
 */
class Industry extends Model
{
    use SoftDeletes;

    public $table = 'industries';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'display_name',
        'user_id',
        'avatar',
        'pic_urls',
        'identity_urls',
        'prov_id',
        'city_id',
        'address',
        'service',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_name' => 'string',
        'user_id' => 'integer',
        'avatar' => 'string',
        'pic_urls' => 'string',
        'identity_urls' => 'string',
        'prov_id' => 'integer',
        'city_id' => 'integer',
        'address' => 'string',
        'service' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'display_name' => 'required|string',
        'user_id' => 'required|numeric',
        'avatar' => 'required|string',
        'prov_id' => 'numeric',
        'city_id' => 'numeric',
        'address' => 'string',
        'service' => 'string',
        'description' => 'string'
    ];

    
}
