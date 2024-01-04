<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Invoice as Repository;

use App\Http\Requests\Invoice\{
    Index   as IndexRequest,
};

use Inertia\Inertia;
use Throwable;

class ReportController extends Controller
{
    private Repository  $repository;

    private $module = 'Transaction';
    private $page = 'Report';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
        $this->middleware('permission:report');
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
    public function invoiceHeader(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
        ]);
    }

    /**
     * Export
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function invoiceHeaderExport(IndexRequest $request)
    {
        try {
            return $this->repository::invoiceHeaderExport($request);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }
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
    public function invoiceLineManual(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
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
    public function invoiceLineAwb(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
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
    public function invoiceLineSmu(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
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
    public function oracleHeader(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
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
    public function oracleLine(IndexRequest $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $this->repository::report($request),
            'statistic' => $this->repository::statistic($request),
        ]);
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
