<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\LineType as Repository;
use App\Models\LineType as Model;

use App\Http\Requests\LineType\{
    Show    as ShowRequest,
    Index   as IndexRequest,
    Store   as StoreRequest,
    Update  as UpdateRequest,
    Destroy as DestroyRequest
};

use Inertia\Inertia;
use Throwable;

class LineTypeController extends Controller
{
    private Repository  $repository;

    private $module = 'Master';
    private $page = 'LineType';

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
     * @param   Model $line_type
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function show(ShowRequest $request, Model $line_type)
    {
        try {
            $data = $this->repository::init($line_type)->show($request);
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
     * @param   Model $line_type
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function update(UpdateRequest $request, Model $line_type)
    {
        try {
            $this->repository::init($line_type)->update($request);
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
     * @param   Model $line_type
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function destroy(DestroyRequest $request, Model $line_type)
    {
        try {
            $this->repository::init($line_type)->delete();
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
     * @param   Model $line_type
     * 
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function restore(DestroyRequest $request, Model $line_type)
    {
        try {
            $this->repository::init($line_type)->restore();
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
