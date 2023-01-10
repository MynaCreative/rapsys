<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Currency as Repository;
use App\Models\Currency as Model;

use App\Http\Requests\Currency\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Import  as ImportRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class CurrencyController extends Controller
{
    private Repository  $repository;

    private $module = 'Master';
    private $page = 'Currency';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
        $this->middleware('permission:currency');
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
     * @param   Model $currency
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $currency)
    {
        try {
            $data = $this->repository::init($currency)->show($request);
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
     * Import resource.
     *
     * @param   ImportRequest  $request
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function import(ImportRequest $request)
    {
        try {
            $this->repository::import($request);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', __('messages.success.import'));
    }

    /**
     * Import Sample
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function importSample()
    {
        try {
            return $this->repository::importSample();
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }
    }

    /**
     * 
     * Update specified resource.
     *
     * @param   UpdateRequest  $request
     * @param   Model $currency
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $currency)
    {
        try {
            $this->repository::init($currency)->update($request);
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
     * @param   Model $currency
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $currency)
    {
        try {
            $this->repository::init($currency)->delete();
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
     * Restore specified resource.
     *
     * @param   DestroyRequest  $request
     * @param   Model $currency
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function restore(DestroyRequest $request, Model $currency)
    {
        try {
            $this->repository::init($currency)->restore();
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', __('messages.success.restore'));
    }

    /**
     * 
     * Convert module string to route format.
     * 
     * @return  String
     */
    public function routeModule(){
        return str($this->module)->snake('-');
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
