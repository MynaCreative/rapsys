<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Helpers\Relationship;

use App\Models\Workflow as Model;
use App\Models\User;

class Workflow
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Workflow
     */
    public static function init(Model $model): Workflow
    {
        $instance = new self;
        $instance->model = $model;

        return $instance;
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function all(Request $request)
    {
        $query = Model::withTrashed()
            ->with(['createdUser:id,name', 'updatedUser:id,name', 'department:id,name', 'items'])
            ->latest();

        return $query->paginate($request->per_page ?? 10)
            ->withQueryString()
            ->through(function ($item) {
                return [
                    'id'            => $item->id,
                    'department'    => $item->department,
                    'code'          => $item->code,
                    'name'          => $item->name,
                    'items'         => $item->items,
                    'created_user'  => $item->createdUser,
                    'updated_user'  => $item->updatedUser,
                    'created_at'    => $item->created_at,
                    'updated_at'    => $item->updated_at,
                    'deleted_at'    => $item->deleted_at,
                ];
            });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function store($request): Model
    {
        $model = new Model($request->sanitizedData());
        $model->saveOrFail();

        /**
         * Document Item
         */
        self::saveDocumentItem($model, $request->items ?? []);

        return $model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function update($request): Model
    {
        $this->model->fill($request->sanitizedData());
        $this->model->updateOrFail();

        /**
         * Document Item
         */
        self::saveDocumentItem($this->model, $request->items ?? []);

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model
    {
        return $this->model->load([
            'createdUser:id,name', 'updatedUser:id,name', 'department:id,name', 'items', 'items.user',
        ]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function delete(): bool
    {
        return $this->model->deleteOrFail();
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function forceDelete(): bool
    {
        return $this->model->forceDelete();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return bool|null
     */
    public function restore(): bool
    {
        return $this->model->restore();
    }

    /**
     * Save items
     */
    public static function saveDocumentItem(Model $model, $items)
    {
        if (!empty($items)) {
            Relationship::proccesRelationWithRequest(
                $model->items(),
                $items
            );
        }
    }

    /**
     * Data reference resource for this resource.
     *
     * @return array|null
     */
    public static function reference(): array
    {
        return [
            'departments' => Department::pluck('name', 'id'),
            'users' => User::pluck('name', 'id'),
        ];
    }
}
