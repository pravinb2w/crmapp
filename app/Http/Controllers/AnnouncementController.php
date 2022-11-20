<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\LandingPages;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $companyCode;

    public function __construct(Request $request)
    {
        $this->companyCode = $request->segment(1);
    }

    public function index()
    {
        $data   = Announcement::latest()->paginate(25);
        return view('crm.utilities.announcements.index', compact('data'));
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['subject', 'page_id', 'message', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = Announcement::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = Announcement::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = Announcement::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Announcement::count();
        } else {
            $total_filtered = Announcement::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $announcement) {

                $action = '
                <a href="' . route('edit.announcement', ['id' => $announcement->id,'companyCode' => $this->companyCode]) . '" class="action-icon" ><i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return announce_delete(' . $announcement->id . ')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data['subject']             = $announcement->subject;
                $nested_data['page']                = $announcement->page->page_title ?? null;
                $nested_data['message']             = $announcement->message;
                $nested_data['action']              = $action;
                $data[]                             = $nested_data;
            }
        }

        return response()->json([
            'draw'              => intval($request->input('draw')),
            'recordsTotal'      => intval($total_list),
            'data'              => $data,
            'recordsFiltered'   => intval($total_filtered)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = LandingPages::where('status', 1)->get();
        return view('crm.utilities.announcements.create', compact('pages'));
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
            "page_id" => $request->page_id,
            "show_staff" => $request->show_staff ?? 0,
            "show_customer" => $request->show_clients ?? 0,
            "show_my_name" => $request->show_my_name ?? 0,
        ]);
        return redirect()->back()->with('success', 'Announcement Created!');
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
    public function edit($companyCode, $id)
    {
        $data = Announcement::findOrFail($id);
        $pages = LandingPages::where('status', 1)->get();

        return view('crm.utilities.announcements.edit', compact("data", "pages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyCode, $id)
    {
        $data = Announcement::findOrFail($id);

        $data->update([
            "subject" => $request->subject,
            "message" => $request->message,
            "show_staff" => $request->show_staff,
            "show_customer" => $request->show_clients,
            "show_my_name" => $request->show_my_name,
            "page_id" => $request->page_id,

        ]);
        return redirect()->back()->with('success', 'Announcement Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Announcement::findOrFail($id);
        $data->delete();
        return response()->json(['error' => '', 'status' => '0']);
    }
}