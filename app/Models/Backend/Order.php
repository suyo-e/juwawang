<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models\Backend
 * @version March 11, 2017, 7:31 am UTC
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_id',
        'user_id:unsigned:foreign,users,id',
        'contact_name',
        'phone',
        'prov_id',
        'city_id',
        'quantity',
        'remark',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'user_id:unsigned:foreign,users,id' => 'integer',
        'contact_name' => 'string',
        'phone' => 'string',
        'prov_id' => 'integer',
        'city_id' => 'integer',
        'quantity' => 'integer',
        'remark' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|numeric',
        'user_id:unsigned:foreign,users,id' => 'required|numeric',
        'contact_name' => 'required|string',
        'phone' => 'required|string',
        'prov_id' => 'numeric',
        'city_id' => 'numeric',
        'quantity' => 'numeric',
        'remark' => 'string',
        'status' => 'numeric'
    ];

    
}
