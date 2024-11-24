<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FilterService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Builder $query, protected Request $request)
    {
    }

    private function getModelColumns(): array
    {
        return $this->query->getModel()->getFillable();
    }

    public function apply(): Builder
    {
        $queryParamsKeys = array_keys($this->request->query());
        $filters = array_intersect($this->getModelColumns(), $queryParamsKeys);
        $filterRelations = array_filter($queryParamsKeys, fn($paramKey) => str_contains($paramKey, '-'));

        if (!empty($queryParamsKeys) || $filters || $filterRelations) {

                foreach ($filters as $filter) {

                    $value = $this->request->input($filter);

                    $method = match (true) {
                        is_string($value) => 'filterLike',
                        is_numeric($value) || is_bool($value) => 'filterWhere',
                        is_array($value) => 'filterIn',
                        default => null,
                    };

                    if ($method && method_exists($this, $method)) {
                        $this->$method($filter, $this->request->input($filter));
                    }


                }

                $relationQueryParams = array_map(fn($paramKey) => explode("-", $paramKey)[0], $filterRelations);
                $relationColsQueryParams = array_map(function ($paramKey) {
                    [$relation, $col] = explode("-", $paramKey);
                    return [$relation, $col];
                }, $filterRelations);

                $modelFilterRelations = $this->query->getModel()->filterRelations ?? [];


                $matchingRelations = array_intersect($relationQueryParams, $modelFilterRelations);

                if (empty($matchingRelations)) {
                    throw new \InvalidArgumentException('No matching relations found for the provided parameters.');
                }


                foreach ($relationColsQueryParams as [$relation, $column]) {
                    $this->applyRelationFilter($relation, $column, $this->request->input("$relation-$column"));
                }

                return $this->query;





        }




        return $this->query;
    }

    protected function filterWhere(string $field, $value): void
    {
        $this->query->where($field, $value);

    }

    protected function filterLike(string $field, $value): void
    {
        $this->query->where($field, 'LIKE', "%$value%");

    }

    protected function filterBetween(string $field, array $value): void
    {
        $this->query->whereBetween($field, $value);
    }

    protected function filterIn(string $field, array $values): void
    {
        $this->query->whereIn($field, $values);
    }

    protected function applyRelationFilter($relation, string $field, $value): void
    {

        $this->query->whereHas($relation, function (Builder $query) use ($field, $value) {
            $query->where($field, $value);
        });

    }


}
