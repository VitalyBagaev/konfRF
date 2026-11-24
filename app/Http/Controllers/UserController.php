<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Application;
use App\Models\Comment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()) {
          if(Auth::user()->role == 'admin') {
            return redirect()->route('perpage');
        }  
        }
        
        $rooms = Room::orderBy('id', 'asc')->get();
        return view('index', compact('rooms'));
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->save();
        Auth::login($user);
        return redirect()->route('index');
    }

    public function auth(UpdateUserRequest $request)
    {
        $user = User::where('login', $request->login)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('index');
            }
        }
        return back()->withErrors(['login' => 'Логин или пароль введены неверно'])->withInput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function authpage()
    {
        return view('auth');
    }

    public function regpage()
    {
        return view('register');
    }

    public function perpage()
    {  if (Auth::user()) { 
       if(Auth::user()->role == 'admin') {
        $rooms = Room::orderBy('id', 'asc')->get();
        $applications = Application::with('comments')->with('room')->orderBy('created_at', 'desc')->get();
        return view('personal', compact('applications', 'rooms'));
       } else {
        $applications = Application::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->with('comments')->with('room')->get();
       }
        
        return view('personal', compact('applications'));
        }
        return abort(404);
    }

    public function reservation(Room $room)
    {if (Auth::user()) { 
        return view('reservation', compact('room'));
        }
        return abort(404);
    }
    
    public function logout()
    {
        Auth()->logout();
        return redirect()->route('index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
