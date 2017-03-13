<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models\Backend
 * @version March 11, 2017, 7:44 am UTC
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'user_id:unsigned:foreign,users,id',
        'type_name',
        'category_id',
        'industry_id',
        'prov_id',
        'city_id',
        'brand_name',
        'price',
        'address',
        'contact_name',
        'wechat',
        'qq',
        'phone',
        'view_count',
        'collect_count',
        'banner_urls',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'user_id:unsigned:foreign,users,id' => 'integer',
        'type_name' => 'string',
        'category_id' => 'integer',
        'industry_id' => 'integer',
        'prov_id' => 'integer',
        'city_id' => 'integer',
        'brand_name' => 'string',
        'price' => 'string',
        'address' => 'string',
        'contact_name' => 'string',
        'wechat' => 'string',
        'qq' => 'string',
        'phone' => 'string',
        'view_count' => 'integer',
        'collect_count' => 'integer',
        'banner_urls' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'user_id:unsigned:foreign,users,id' => 'required|numeric',
        'type_name' => 'string',
        'category_id' => 'numeric',
        'industry_id' => 'numeric',
        'prov_id' => 'numeric',
        'city_id' => 'numeric',
        'brand_name' => 'string',
        'address' => 'string',
        'contact_name' => 'string',
        'wechat' => 'string',
        'qq' => 'string',
        'phone' => 'string',
        'view_count' => 'numeric',
        'collect_count' => 'numeric',
        'status' => 'numeric'
    ];

    
}
