<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $setting)
    {
        parent::__construct($setting);
    }

    public function all()
    {
        return $this->model->all()->pluck('value', 'key');
    }

    public function findByKey($key)
    {
        return $this->model->where('key', $key)->firstOrFail();
    }
}
