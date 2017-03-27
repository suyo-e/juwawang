<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Icon
 * @package App\Models\Backend
 * @version March 26, 2017, 4:10 pm UTC
 */
class Icon extends Model
{
    use SoftDeletes;

    public $table = 'icons';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'pic_url',
        'type',
        'category_ids',
        'rank'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'pic_url' => 'string',
        'type' => 'integer',
        'category_ids' => 'string',
        'rank' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'pic_url' => 'required',
        'type' => 'required',
        'category_ids' => 'required'
    ];

    
}
