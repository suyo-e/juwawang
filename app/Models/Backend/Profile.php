<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profile
 * @package App\Models\Backend
 * @version March 13, 2017, 7:55 am UTC
 */
class Profile extends Model
{
    use SoftDeletes;

    public $table = 'profiles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'avatar',
        'user_id',
        'prov_id',
        'city_id',
        'sex',
        'industry_id',
        'industry_name',
        'category_id',
        'service',
        'identity_urls',
        'identity_str',
        'is_identity',
        'realname'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'user_id' => 'integer',
        'prov_id' => 'integer',
        'city_id' => 'integer',
        'sex' => 'integer',
        'industry_id' => 'integer',
        'industry_name' => 'string',
        'category_id' => 'integer',
        'service' => 'string',
        'avatar' => 'string',
        'identity_str' => 'string',
        'identity_urls' => 'string',
        'is_identity' => 'integer',
        'realname' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|numeric',
        'user_id' => 'required|numeric',
        'prov_id' => 'numeric',
        'city_id' => 'numeric',
        'sex' => 'numeric',
        'industry_id' => 'numeric',
        'industry_name' => 'string',
        'category_id' => 'numeric',
        'service' => 'string',
        'avatar' => 'string',
        //'identity_urls' => 'string'
    ];
}
