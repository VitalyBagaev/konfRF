<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room as ModelsRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function roomadd(StoreRoomRequest $request)
    {
        $room = new Room();
        $room->user_id = Auth::user()->id;
        $room->room_name = $request->room_name;
        $room->description = $request->description;
        $room->photo = 'storage/photos/' . Storage::disk("photos")->putFile($request->file('photo'));

        $room->save();
        return redirect()->route('index');
    }

    public function roomform()
    {

        if (Auth::user()->role == 'admin') {
            return view('roomadd');
        }
        return abort(404);
    }
    public function delete(Room $room)
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'admin') {
                $room->delete();
                return redirect()->route('perpage');
            }
        }
        return abort(404);
    }

    public function roomeditform(Room $room)
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'admin') {
                return view('roomadd', compact('room'));
            }
        }
        return abort(404);
    }
    public function roomedit(UpdateRoomRequest $request, Room $room)
    {
        $room->room_name = $request->room_name;
        $room->description = $request->description;
        if ($request->file('photo')) {
            $room->photo = 'storage/photos/' . Storage::disk("photos")->putFile($request->file('photo'));
        }
        $room->save();
        return redirect()->route('perpage', [$room->id]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
