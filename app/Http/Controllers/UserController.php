<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->create($request->validated());
    return redirect()
        ->route('users.index')
        ->with('success','User berhasil dibuat');
    }

    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        $users = $this->service->getAll();
        return view('users.index', compact('users'));
    }
}
