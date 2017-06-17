<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Score;
use InfyOm\Generator\Common\BaseRepository as iBaseRepository;

class ScoreRepository extends iBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'amount',
        'current_amount',
        'typename',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Score::class;
    }
}
