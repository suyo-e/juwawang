<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Feedback
 * @package App\Models\Backend
 * @version March 26, 2017, 6:37 am UTC
 */
class Feedback extends Model
{
    use SoftDeletes;

    public $table = 'feedback';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'title',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
