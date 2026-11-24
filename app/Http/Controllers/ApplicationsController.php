<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationsRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Models\Application;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApplicationsController extends Controller
{
    public function application(ApplicationsRequest $request, Room $room) {
        if (Auth::user()) { 
    $application = new Application();
    //Application::create($request->all());
    $application->user_id = Auth::user()->id;
    $application->room_id = $room->id;
    $application->date = $request->date;
    $application->app_name = $request->app_name;
    $application->payment = $request->payment;

    $application->save();
    return redirect()->route('index');
    }
        return abort(404);
   
    }

    public function changeStatus(ChangeStatusRequest $request, Application $application) {
    
    $application->status = $request->status;

    $application->save();
    return back();
   
    }
    
}
