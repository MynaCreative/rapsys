<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Role as Repository;
use App\Models\Role as Model;

use App\Http\Requests\Role\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class RoleController extends Controller
{
    private Repository  $repository;

    private $module = 'Setting/Administrator';
    private $page = 'Role';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;

        $this->middleware('permission:role');

        $this->middleware('password.confirm', [
            'only' => ['index']
        ]);
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
            'collection' =>$this->repository::all($request),
            'references' => $this->repository::reference(),
        ]);
    }

    /**
     * 
     * Display the specified resource.
     *
     * @param   ShowRequest  $request
     * @param   Model $role
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $role)
    {
        try {
            $data = $this->repository::init($role)->show($request);
            return response()->json($data);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
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
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', __('messages.success.store'));
    }

    /**
     * 
     * Update specified resource.
     *
     * @param   UpdateRequest  $request
     * @param   Model $role
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $role)
    {
        try {
            $this->repository::init($role)->update($request);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', __('messages.success.update'));
    }

    /**
     * 
     * Remove specified resource.
     *
     * @param   DestroyRequest  $request
     * @param   Model $role
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $role)
    {
        try {
            $this->repository::init($role)->delete();
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', __('messages.success.delete'));
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
