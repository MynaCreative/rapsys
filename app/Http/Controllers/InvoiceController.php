<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Invoice as Repository;
use App\Models\Invoice as Model;

use App\Http\Requests\Invoice\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Import  as ImportRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class InvoiceController extends Controller
{
    private Repository  $repository;

    private $module = 'Transaction';
    private $page = 'Invoice';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
        $this->middleware('permission:invoice');
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
     * @param   Model $invoice
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $invoice)
    {
        try {
            $data = $this->repository::init($invoice)->show($request);
            return response()->json($data);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("{$this->module}/{$this->page}/Form", [
            'references' => $this->repository::reference(),
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $invoice)
    {
        return Inertia::render("{$this->module}/{$this->page}/Form", [
            'model' => $this->repository::init($invoice)->show(),
            'references' => $this->repository::reference(),
        ]);
    }

    /**
     * 
     * Update specified resource.
     *
     * @param   UpdateRequest  $request
     * @param   Model $invoice
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $invoice)
    {
        try {
            $this->repository::init($invoice)->update($request);
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
     * @param   Model $invoice
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $invoice)
    {
        try {
            $this->repository::init($invoice)->delete();
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
     * @param   Model $invoice
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function restore(DestroyRequest $request, Model $invoice)
    {
        try {
            $this->repository::init($invoice)->restore();
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
