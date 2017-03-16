<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models\Backend
 * @version March 11, 2017, 7:45 am UTC
 */
class Category extends Model
{
    use SoftDeletes;


    const TYPE_USER = 3;
    const TYPE_AGENT = 2;
    const TYPE_MANUFACTURER = 1;

    const TYPE_USER_PRODUCT = 6;
    const TYPE_AGENT_PRODUCT = 5;
    const TYPE_MANUFACTURER_PRODUCT = 4;

    public $table = 'categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'display_name',
        'parent_id',
        'pic_url',
        'type',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_name' => 'string',
        'parent_id' => 'integer',
        'pic_url' => 'file',
        'type' => 'integer',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'display_name' => 'required|string',
        'parent_id' => 'required|numeric',
        //'pic_url' => 'required',
        'type' => 'numeric',
        //'url' => 'required|string'
    ];

    
}
