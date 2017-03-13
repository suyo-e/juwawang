<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Collect;
use InfyOm\Generator\Common\BaseRepository;

class CollectRepository extends BaseRepository
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
        return Collect::class;
    }
}
