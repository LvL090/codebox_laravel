<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::orderBy('date', 'desc')->simplePaginate(6);
        $featured = Event::all()->where('featured', 1);
        return view('home', compact(['events', 'featured']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $newEvent = request()->except('_token');

        Event::create($newEvent);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = Event::find($id);
        return view('show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
        
        $event = Event::find($id);
        return view('edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $changeEvent = request()->except(['_token', '_method']);
        Event::where('id', '=', $id)->update($changeEvent);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Event::destroy($id);
        return redirect()->route('home');
    }

    public function subscribe($id){
        $user = User::find(Auth::id());
        $event = Event::find($id);

        $user->event()->attach($event);

        return redirect()->route('home');
    }

}
