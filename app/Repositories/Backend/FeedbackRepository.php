<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Feedback;
use InfyOm\Generator\Common\BaseRepository;

class FeedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'title',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Feedback::class;
    }
}
