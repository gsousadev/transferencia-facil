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
        return $this->model::query()->find($id)->toArray();
    }

    public function find(array $filters = []): ?array
    {
        $query = $this->model::query();

        $initialDate = data_get($filters, 'initial_date');
        $finalDate = data_get($filters, 'final_date');

        unset($filters['initial_date'], $filters['final_date']);

        if (!empty($filters)) {
            $query = $query->where($filters);
        }

        if (($initialDate != null && $finalDate === null)) {

            $initialDate = Carbon::parse($initialDate);
            $finalDate = Carbon::parse($finalDate);

            $query = $query
                ->where('created_at', '>=', $initialDate->toDateTimeString())
                ->where('updated_at', '<=', $finalDate->toDateTimeString());
        }

        return $query
            ->where('created_at', '>=', $initialDate->toDateTimeString())
            ->where('updated_at', '<=', $finalDate->toDateTimeString())
            ->with(['from', 'to'])
            ->get()
            ->toArray();
    }

    public function findBy(string $key, string $value): array
    {
        return $this->model::query()->where($key, $value)->get()->toArray();
    }

    public function findOneBy(string $key, string $value): array
    {
        return $this->model::query()->where($key, $value)->first()->toArray();
    }

    public function store(array $attributes = []): bool
    {
        $this->model->fill($attributes);
        return $this->model->save();
    }

    public function edit(int $id, array $attributes = []): bool
    {
        $model = $this->model::query()->find($id);

        $model->fill($attributes);

        return $model->save();
    }
}
