<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Service\UserService;
use App\Service\RoleService;
use App\Service\MediaService;
class UserController extends Controller
{
    protected $userService;
    protected $mediaService;
    protected $roleService;

    public function __construct(UserService $userService, MediaService $mediaService, RoleService $roleService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->mediaService = $mediaService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *s
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUser();

        return view( 'admin.user.list', ['users' => $users] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->getListRole();

        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request);
        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.list')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserByID($id);

        return view('admin.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->getUserByID($id);
        $roles = $this->roleService->getListRole();
        $userRole = $user->roles->pluck('name','name')->all();

        return view( 'admin.user.edit', compact('user','roles','userRole') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = $this->userService->updateUser($request,$id);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->deleteUserById($id);

        return redirect()->route('users.index');
    }

    public function getEditUserTemplate($id)
    {
        $user = $this->userService->getUserByID($id);

        return view('layouts.edit-user', compact('user'));
    }
}
