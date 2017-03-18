<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Information;
use InfyOm\Generator\Common\BaseRepository;

class InformationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'subtitle',
        'pic_url',
        'view_count',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Information::class;
    }
}
