<?php
namespace App\Traits;
use App\Services\FilterService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


trait Filterable
{

    public function scopeFilter(Builder $query): Builder
    {
        $filterService = new FilterService($query,request());
        return $filterService->apply();

    }
}
