<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Collect
 * @package App\Models\Backend
 * @version March 11, 2017, 7:28 am UTC
 */
class Collect extends Model
{
    use SoftDeletes;

    public $table = 'collects';

    const TYPE_LIKE = 1;
    const TYPE_COLLECT = 2;

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'seller_id',
        'product_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|numeric',
        'product_id' => 'required|numeric'
    ];

    
}
