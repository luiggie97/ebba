<?php

namespace App\Http\Controllers;

use App\Classes\Users;
use App\Http\Middleware\Admin;
use App\Http\Middleware\IsAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $users;
     /**
     * UsersController constructor.
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->middleware(Admin::class);
        $this->users = $users;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list')->with(['users' => $users = $this->users->access(0)]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $users = $this->users->access(2, $request);
        return redirect('/user/list')->with(['status' => $message]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit')->with(['users' => $users = $this->users->access(3,$id)]);
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
        $message = $users = $this->users->access(2, $request,1);
        return redirect('/user/list')->with(['status' => $message]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $users = $this->users->access(1, $id);
        return redirect('/user/list')->with(['status' => $message]);
    }
}
