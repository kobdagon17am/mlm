<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;


class ReportRegisterController extends Controller
{


    public function index()
    {


        return view('backend/Report_register/index');

    }

    public function report_register_datable(Request $request)
    {

        $report_bonus_copyright = DB::table('log_up_vl')
        // ->where('status','=','success')
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"))
        ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  user_name = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($report_bonus_copyright);
        return $sQuery

            // ->setRowClass('intro-x py-4 h-24 zoom-in')
            ->addColumn('created_at', function ($row) {
                return date('Y/m/d H:i:s', strtotime($row->created_at));
            })

            ->addColumn('user_name', function ($row) {
                // $upline = \App\Http\Controllers\Frontend\FC\AllFunctionController::get_upline($row->user_name);
                // if ($upline) {
                //     $html = @$upline->name . ' ' . @$upline->last_name . ' (' . $upline->user_name . ')';
                // } else {
                //     $html = '-';
                // }
                return $row->user_name;
            })

            ->addColumn('name', function ($row) {

                if($row->user_name){
                    $upline = \App\Http\Controllers\Frontend\FC\AllFunctionController::get_upline($row->user_name);
                    if ($upline) {
                        $html = @$upline->name . ' ' . @$upline->last_name;
                    } else {
                        $html = '-';
                    }
                }else{
                    $html = '-';
                }

                return $html;
            })







            //->rawColumns(['detail', 'pv_total', 'date', 'code_order','tracking'])

            ->make(true);
    }
}