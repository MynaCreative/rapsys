<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\User as Model;
use App\Models\Role;

class User
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return User
     */
    public static function init(Model $model): User
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
            ->searching($request, ['name']);

        return $query->paginate($request->per_page ?? 10)->withQueryString()
        ->through(function ($item) {
            return [
                'id'                => $item->id,
                'name'              => $item->name,
                'username'          => $item->username,
                'email'             => $item->email,
                'position_text'     => $item->position_text,
                'created_at'        => $item->created_at,
                'updated_at'        => $item->updated_at,
                'online'            => Cache::has('user-is-online-' . $item->id) ?? false
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
        if (!empty($request->roles_id)) {
            $model->assignRole($request->roles_id);
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
        if (!empty($request->roles_id)) {
            $this->model->syncRoles($request->roles_id);
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
        $this->model->load(['roles']);
        $this->model->roles_id = $this->model->roles->map(fn($item) => $item->id)->all();
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
            'roles' => Role::pluck('name','id'),
        ];
    }
}
