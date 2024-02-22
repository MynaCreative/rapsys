<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Racos as Repository;

use Inertia\Inertia;
use Throwable;

class RacosController extends Controller
{
    private Repository  $repository;

    private $module = 'Setting/Racos';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository   = $repository;
        $this->middleware(['permission:delta', 'password.confirm']);
    }

    /**
     *
     * Display a smu test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function info(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::info($request->code)->json();
            }
            return Inertia::render("{$this->module}/ConsInfo", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/track/cons-number-detail',
                    'username' => config('delta.rest.username'),
                    'password' => config('delta.rest.password'),
                ]
            ]);
        } catch (Throwable $exception) {
            return redirect()->back()->withErrors([
                'error' => __('messages.error.internal_server'),
                'exception' => $exception->getMessage()
            ]);
        }
    }

    /**
     *
     * Convert module string to route format.
     *
     * @return  String
     */
    public function routeModule()
    {
        $splitter = array_map(
            fn ($item) => str($item)->snake('-'),
            explode('/', $this->module)
        );
        $merger = implode('.', $splitter);
        return $merger;
    }
}
