<?php

namespace App\Repositories\Backend;

use App\Models\Backend\Setting;
use InfyOm\Generator\Common\BaseRepository as iBaseRepository;

class SettingRepository extends iBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'setting_key',
        'setting_val'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
}
