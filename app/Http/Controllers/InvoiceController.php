<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Throwable;

class InvoiceController extends Controller
{
    private $module = 'Transaction';
    private $page = 'Invoice';

    /**
     * 
     * Display a listing of the resources.
     *
     * @param   Request  $request
     * 
     * @throws  Throwable
     */
    public function index(Request $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Index");
    }

    /**
     * 
     * Store a newly created resource.
     *
     * @param   Request  $request
     * 
     * @throws  Throwable
     */
    public function create(Request $request)
    {
        return Inertia::render("{$this->module}/{$this->page}/Create");
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
