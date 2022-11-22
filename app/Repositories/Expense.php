<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Models\Expense as Model;

class Expense
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Expense
     */
    public static function init(Model $model): Expense
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
            ->ordering($request)
            ->filtering($request)
            ->searching($request, ['code', 'name', 'coa'])
            ->with(['createdUser:id,name','updatedUser:id,name'])
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
        ->through(function ($item) {
            return [
                'id'            => $item->id,
                'name'          => $item->name,
                'code'          => $item->code,
                'coa'           => $item->coa,
                'description'   => $item->description,
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
    public function show(): Model {
        return $this->model->load([
            'createdUser:id,name','updatedUser:id,name'
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
}
