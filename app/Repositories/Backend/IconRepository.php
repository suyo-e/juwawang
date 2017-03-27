<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Icon;
use InfyOm\Generator\Common\BaseRepository;

class IconRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'pic_url',
        'type',
        'category_ids',
        'rank'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Icon::class;
    }

    public function getTypeIcons($type) {
        return $this->model
            ->where('type', $type)
            ->orderBy('rank', 'desc')
            ->get();
    }
}
