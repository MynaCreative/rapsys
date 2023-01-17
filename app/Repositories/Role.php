<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Models\Role as Model;
use App\Models\Permission;

class Role
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Role
     */
    public static function init(Model $model): Role
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
        $query = Model::ordering($request)
            ->filtering($request)
            ->searching($request, ['name']);

        return $query->paginate($request->per_page ?? 10)->withQueryString()
        ->through(function ($item) {
            return [
                'id'            => $item->id,
                'name'          => $item->name,
                'guard_name'    => $item->guard_name,
                'created_at'    => $item->created_at,
                'updated_at'    => $item->updated_at,
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
        if (!empty($request->permissions_id)) {
            $model->givePermissionTo($request->permissions_id);
        }
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
        if (!empty($request->permissions_id)) {
            $this->model->syncPermissions($request->permissions_id);
        }
        $this->model->updateOrFail();

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model {
        $this->model->load(['permissions']);
        $this->model->permissions_id = $this->model->permissions->map(fn($item) => $item->id)->all();
        return $this->model;
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
            'permissions' => Permission::pluck('label','id'),
        ];
    }
}
