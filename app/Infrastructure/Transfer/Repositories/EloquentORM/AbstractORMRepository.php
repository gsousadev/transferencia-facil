<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractORMRepository implements AbstractORMRepositoryInterface
{
    /** @var Model */
    protected $model;

    public function getById(int $id): ?array
    {
        $model = $this->model::query()->find($id);

        return $model === null ? [] : $model->toArray();
    }

    public function find(array $filters = [], array $relations = []): array
    {
        $query = $this->model::query();

        $initialDate = data_get($filters, 'initial_date');
        $finalDate = data_get($filters, 'final_date');

        unset($filters['initial_date'], $filters['final_date']);

        if (!empty($filters)) {
            $newLikeFilters = [];

            foreach ($filters as $key => $value) {
                $newLikeFilters[] = [
                    $key,
                    'like',
                    '%' . $value . '%'
                ];
            }

            $query = $query->where($newLikeFilters);
        }

        if (!empty($relations)) {
            $query = $query->with($relations);
        }

        if ($initialDate !== null && $finalDate !== null) {
            $initialDate = Carbon::parse($initialDate)->startOfDay()->toDateTimeString();
            $finalDate = Carbon::parse($finalDate)->endOfDay()->toDateTimeString();


            $query = $query->whereBetween('created_at', [$initialDate, $finalDate]);
        }

        return $query->get()->toArray();
    }

    public function findBy(string $key, string $value): array
    {
        return $this->model::query()->where($key, $value)->get()->toArray();
    }

    public function findOneBy(string $key, string $value): array
    {
        $model = $this->model::query()->where($key, $value)->first();

        return $model === null ? [] : $model->toArray();
    }

    public function store(array $attributes = []): array
    {
        $this->model->fill($attributes);

        $this->model->save();

        return $this->model->toArray();
    }

    public function edit(int $id, array $attributes = []): array
    {
        $model = $this->model::query()->find($id);

        $model->fill($attributes);

        $model->save();

        return $model->toArray();
    }
}
