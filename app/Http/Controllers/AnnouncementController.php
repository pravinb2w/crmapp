<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Announcement::latest()->paginate(10);
        return view('crm.utilities.announcements.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('crm.utilities.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {

        $store  =   Announcement::create([
            "subject" => $request->subject,
            "message" => $request->message,
            "show_staff" => $request->show_staff ?? 0,
            "show_customer" => $request->show_clients ?? 0,
            "show_my_name" => $request->show_my_name ?? 0,
        ]);
        return redirect()->back()->with('success','Announcement Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Announcement::findOrFail($id);
        return view('crm.utilities.announcements.edit',compact("data"));
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
        $data = Announcement::findOrFail($id);

        $data->update([
            "subject" => $request->subject,
            "message" => $request->message,
            "show_staff" => $request->show_staff,
            "show_customer" => $request->show_clients,
            "show_my_name" => $request->show_my_name,
        ]);
        return redirect()->back()->with('success','Announcement Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Announcement::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success','Announcement Deleted!');
    }
}
