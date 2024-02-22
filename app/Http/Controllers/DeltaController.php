<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Delta as Repository;

use Inertia\Inertia;
use Throwable;

class DeltaController extends Controller
{
    private Repository  $repository;

    private $module = 'Setting/Delta';

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
    public function smu(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::smu($request->code)->json();
            }
            return Inertia::render("{$this->module}/Smu", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/track/getSmuDetail',
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
     * Display a awb test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function awb(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::awb($request->code);
            }
            return Inertia::render("{$this->module}/Awb", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.soap.url'),
                    'username' => config('delta.soap.username'),
                    'password' => config('delta.soap.password'),
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
     * Display a smu test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function awbDetail(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::awbDetail($request->code)->json();
            }
            return Inertia::render("{$this->module}/AwbDetail", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/track/getTrackAwbDetail',
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
     * Display a smu test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function awbScanCompliance(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::awbScanCompliance($request->code, $request->with_scan, $request->or_scan)->json();
            }
            return Inertia::render("{$this->module}/AwbScanCompliance", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/getScanCompliance/',
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
     * Display a smu test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function awbBatch(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $awb = explode(',', $request->code);
                $result = $this->repository::awbBatch($awb)->json();
            }
            return Inertia::render("{$this->module}/AwbBatch", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/tracking/',
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
     * Display a smu test.
     *
     * @param   Request  $request
     *
     * @return  ApiResponse
     * @throws  Throwable
     */
    public function consDetail(Request $request)
    {
        $result = null;
        try {
            if ($request->code) {
                $result = $this->repository::consDetail($request->code)->json();
            }
            return Inertia::render("{$this->module}/ConsDetail", [
                'result' => $result,
                'information' => [
                    'url' => config('delta.rest.url') . '/v3/racos/info',
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
