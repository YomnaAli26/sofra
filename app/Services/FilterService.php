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

        if (empty($queryParamsKeys)) {
            return $this->query;
        }

        $filters = array_intersect($this->getModelColumns(), $queryParamsKeys);

        $filterRelationsQueryParams = array_filter($queryParamsKeys, fn($key) => str_contains($key, '-'));
        $relationFilters = array_map(fn($key) => explode('-', $key), $filterRelationsQueryParams);
        $relationFilters = $this->validateRelationFilters($relationFilters);

        $this->applyModelFilters($filters);

       $this->applyRelationFilters($relationFilters);

        return $this->query;
    }
    private function validateRelationFilters(array $relationFilters): array
    {
        $modelRelations = $this->query->getModel()->filterRelations ?? [];
        $validRelations = [];

        foreach ($relationFilters as [$relation, $column]) {
            if (in_array($relation, $modelRelations)) {
                $validRelations[] = compact('relation', 'column');
            }
        }

        return $validRelations;
    }

    /**
     * Apply filters for direct model columns.
     */
    protected function applyModelFilters(array $filters): void
    {
        foreach ($filters as $filter) {


            $value = $this->request->input($filter);

            $method = match (true) {
                is_string($value) => 'filterLike',
                is_numeric($value) || is_bool($value) => 'filterWhere',
                is_array($value) => 'filterIn',
                default => null,
            };

            if ($method && method_exists($this, $method)) {
                $this->$method($filter, $value);
            }
        }
    }

    /**
     * Apply filters for relationships.
     */
    protected function applyRelationFilters(array $relationFilters): void
    {
        foreach ($relationFilters as $key =>$relation) {
            $value = $this->request->input($relation['relation']."-".$relation['column']);
            $this->applyRelationFilter($relation['relation'], $relation['column'], $value);
        }
    }

    /**
     * Filter the query using "LIKE" for string values.
     */
    protected function filterLike(string $column, mixed $value): void
    {
        $this->query->where($column, 'LIKE', "%$value%");
    }

    /**
     * Filter the query using "WHERE" for exact matches.
     */
    protected function filterWhere(string $column, mixed $value): void
    {
        $this->query->where($column, $value);
    }

    /**
     * Filter the query using "WHERE IN" for array values.
     */
    protected function filterIn(string $column, array $value): void
    {
        $this->query->whereIn($column, $value);
    }

    /**
     * Apply a filter to a related model's column.
     */
    protected function applyRelationFilter(string $relation, string $column, mixed $value): void
    {
        $this->query->whereHas($relation, function (Builder $query) use ($column, $value) {
           if (!in_array($column, $query->getModel()->getFillable()))
           {
               throw new \InvalidArgumentException("Invalid column: {$column}");
           }else{
               if (is_array($value)) {
                   $query->whereIn($column, $value);
               } elseif (is_string($value)) {
                   $query->where($column, 'LIKE', "%$value%");
               } else {
                   $query->where($column, $value);
               }
           }

        });
    }




}
