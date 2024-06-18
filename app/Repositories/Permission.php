<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Models\Permission as Model;
use App\Models\PermissionGroup;

class Permission
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Permission
     */
    public static function init(Model $model): Permission
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
        $query = Model::latest()
            ->ordering($request)
            ->filtering($request)
            ->searching($request, ['label', 'name']);

        return $query->paginate($request->per_page ?? 10)->withQueryString()
            ->through(function ($item) {
                return [
                    'id'                => $item->id,
                    'name'              => $item->name,
                    'label'             => $item->label,
                    'guard_name'        => $item->guard_name,
                    'permission_group'  => $item->permissionGroup,
                    'created_at'        => $item->created_at,
                    'updated_at'        => $item->updated_at,
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

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model
    {
        return $this->model->load(['permissionGroup']);
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
     * Data reference resource for this resource.
     *
     * @return array|null
     */
    public static function reference(): array
    {
        return [
            'permission_groups' => PermissionGroup::select(['id', 'name'])->get(),
        ];
    }
}
