<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Permission as Repository;
use App\Models\Permission as Model;

use App\Http\Requests\Permission\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class PermissionController extends Controller
{
    private Repository  $repository;

    private $module = 'Setting/Administrator';
    private $page = 'Permission';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
    }

    /**
     * 
     * Display a listing of the resources.
     *
     * @param   IndexRequest  $request
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function index(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection'=>$this->repository::all($request),
        ]);
    }

    /**
     * 
     * Display the specified resource.
     *
     * @param   ShowRequest  $request
     * @param   Model $permission
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $permission)
    {
        try {
            $data = $this->repository::init($permission)->show($request);
            return response()->json($data);
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in data fetching. Please try again.');
        }
    }

    /**
     * 
     * Store a newly created resource.
     *
     * @param   StoreRequest  $request
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->repository::store($request);
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in form submissions. Please try again.');
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', 'The record has been created.');
    }

    /**
     * 
     * Update specified resource.
     *
     * @param   UpdateRequest  $request
     * @param   Model $permission
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $permission)
    {
        try {
            $this->repository::init($permission)->update($request);
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in form submissions. Please try again.');
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', 'The record has been updated.');
    }

    /**
     * 
     * Remove specified resource.
     *
     * @param   DestroyRequest  $request
     * @param   Model $permission
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $permission)
    {
        try {
            $this->repository::init($permission)->delete();
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in form submissions. Please try again.');
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', 'The record has been deleted.');
    }

    /**
     * 
     * Convert module string to route format.
     * 
     * @return  String
     */
    public function routeModule(){
        $splitter = array_map(
            fn($item) => str($item)->snake('-'), 
            explode('/', $this->module)
        );
        $merger = implode('.', $splitter);
        return $merger;
    }

    /**
     * 
     * Convert page string to route format.
     * 
     * @return  String
     */
    public function routePage(){
        return str($this->page)->plural()->snake('-');
    }
}
