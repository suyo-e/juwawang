<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Information
 * @package App\Models\Backend
 * @version March 16, 2017, 9:05 am UTC
 */
class Information extends Model
{
    use SoftDeletes;

    public $table = 'information';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'subtitle',
        'pic_url',
        'view_count',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'subtitle' => 'string',
        'pic_url' => 'string',
        'view_count' => 'integer',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required'
    ];

    
}
