<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Industry;
use InfyOm\Generator\Common\BaseRepository;

class IndustryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Industry::class;
    }
}
