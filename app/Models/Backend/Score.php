<?php

namespace App\Models\Backend;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Score
 * @package App\Models\Backend
 * @version June 17, 2017, 4:13 am UTC
 */
class Score extends Model
{
    use SoftDeletes;

    public $table = 'scores';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'amount',
        'current_amount',
        'total_amount',
        'typename',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'amount' => 'integer',
        'current_amount' => 'integer',
        'total_amount' => 'integer',
        'typename' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
