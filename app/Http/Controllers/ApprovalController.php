<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Approval as Repository;
use App\Models\Invoice as Model;

use App\Http\Requests\Approval\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Update  as UpdateRequest,
};

use Inertia\Inertia;
use Throwable;

class ApprovalController extends Controller
{
    private Repository  $repository;

    private $module = 'General';
    private $page = 'Approval';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
        $this->middleware('auth');
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
            'collection' => $this->repository::all($request),
        ]);
    }

    /**
     *
     * Display the specified resource.
     *
     * @param   ShowRequest  $request
     * @param   Model $approval
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $approval)
    {
        try {
            $data = $this->repository::init($approval)->show($request);
            return response()->json($data);
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
    public function edit(Model $approval)
    {
        return Inertia::render("{$this->module}/{$this->page}/Form", [
            'model' => $this->repository::init($approval)->show(),
        ]);
    }

    /**
     *
     * Update specified resource.
     *
     * @param   UpdateRequest  $request
     * @param   Model $approval
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $approval)
    {
        try {
            $this->repository::init($approval)->update($request);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }

        return redirect()->route(implode('.', [$this->routePage(), 'index']))
            ->with('success', __('messages.success.update'));
    }

    /**
     *
     * Convert module string to route format.
     *
     * @return  String
     */
    public function routeModule()
    {
        return str($this->module)->snake('-');
    }

    /**
     *
     * Convert page string to route format.
     *
     * @return  String
     */
    public function routePage()
    {
        return str($this->page)->plural()->snake('-');
    }
}
