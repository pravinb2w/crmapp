<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPlanned implements FromView
{
    public function __construct($year = '', $type = '', $status = '')
    {
        $this->year = $year;
        $this->type = $type;
        $this->status = $status;
    }

    public function view(): View
    {
        $start_date = '';
        $end_date = '';
        if( isset($this->year) && !empty($this->year)) {
            $dates = explode("-", $this->year);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
            $dates =true;
        } 
       
        $total_list             = Activity::count();
        // DB::enableQueryLog();
        if( isset( $this->type ) && $this->type == 'activity') {
           
            $act           = Activity::Latests()
                            ->when($this->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($this->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();

            
        } elseif( isset($this->type ) && $this->type == 'task' ) {
            $tlist           = Task::Latests()
                            ->when($this->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($this->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get();            

          
        } else {
            // DB::enableQueryLog();

            $tlist           = Task::Latests()
                            ->when($this->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($this->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get(); 
            // dd(DB::getQueryLog());

           
            $act           = Activity::Latests()
                            ->when($this->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($this->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get();

            
        }
        $list = [];
        if( isset($tlist) && !empty($tlist) ) {
            foreach ($tlist as $item) {
                $tmp['title'] = $item->task_name;
                $tmp['type'] = 'Task';
                $tmp['customer'] = 'N/A';
                $tmp['user'] = $item->assigned->name ?? '';
                $tmp['lead_deal'] = 'N/A';
                $tmp['assigned_date'] = $item->created_at;
                $tmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';

                $list[] = $tmp;
            }
        }

        if( isset($act) && !empty($act) ) {
            $ntmp = [];
            foreach ($act as $item) {
                $ntmp['title'] = $item->subject;
                $ntmp['type'] = 'Activity';
                $ntmp['customer'] = $item->customer->first_name ?? '';
                $ntmp['user'] = $item->user->name ?? '';
                $ntmp['lead_deal'] = $item->lead->lead_subject ?? $item->deal->deal_title ?? '';
                $ntmp['assigned_date'] = $item->created_at;
                $ntmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';
                $list[] = $ntmp;

            }
        }
        foreach ($list as $key => $part) {
            $sort[$key] = strtotime($part['assigned_date']);
        }
        if( !empty($list)) {
            array_multisort($sort, SORT_DESC, $list);
        }
        
        return view('crm.exports.planned_excel', [
            'list' => $list
        ]);
    }
}
