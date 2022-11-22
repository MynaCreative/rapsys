<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\SalesChannel as Repository;
use App\Models\SalesChannel as Model;

use App\Http\Requests\SalesChannel\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class SalesChannelController extends Controller
{
    private Repository  $repository;

    private $module = 'Master';
    private $page = 'SalesChannel';

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
     * @param   Model $sales_channel
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $sales_channel)
    {
        try {
            $data = $this->repository::init($sales_channel)->show($request);
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
     * @param   Model $sales_channel
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $sales_channel)
    {
        try {
            $this->repository::init($sales_channel)->update($request);
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
     * @param   Model $sales_channel
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $sales_channel)
    {
        try {
            $this->repository::init($sales_channel)->delete();
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in form submissions. Please try again.');
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', 'The record has been deleted.');
    }

    /**
     * 
     * Restore specified resource.
     *
     * @param   DestroyRequest  $request
     * @param   Model $sales_channel
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function restore(DestroyRequest $request, Model $sales_channel)
    {
        try {
            $this->repository::init($sales_channel)->restore();
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Error in form submissions. Please try again.');
        }

        return redirect()->route(implode('.', [$this->routeModule(),$this->routePage(),'index']))
            ->with('success', 'The record has been restored.');
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
