<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

class ApprovalController extends Controller
{
    private $module = 'General';
    private $page = 'Approval';

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'collection' => $request->user()->currentApprovals->load(['invoice','invoice.vendor'])
        ]);
    }
}
