<?php

namespace App\Http\Controllers;

use App\Classes\Vehicles;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    private $vehicles;
    /**
     * VehiclesController constructor.
     * @param Vehicles $vehicles
     */
    public function __construct(Vehicles $vehicles)
    {
        $this->vehicles = $vehicles;
        $this->middleware(Admin::class)->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehicles.list')->with(['vehicles' => $vehicles = $this->vehicles->access(0)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $vehicles = $this->vehicles->access(2, $request);
        return redirect('/vehicle/list')->with(['status' => $message]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('vehicles.edit')->with(['vehicles' => $vehicles = $this->vehicles->access(3,$id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $message = $vehicles = $this->vehicles->access(2, $request,1);
        return redirect('/vehicle/list')->with(['status' => $message]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $vehicles = $this->vehicles->access(1, $id);
        return redirect('/vehicle/list')->with(['status' => $message]);
    }
}
