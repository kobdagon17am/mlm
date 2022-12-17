<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;


class ReportJangPVController extends Controller
{


    public function index()
    {

        $jang_pv = DB::table('jang_pv')
        ->select('jang_pv.*','jang_type.type as type_name')
        ->leftjoin('jang_type', 'jang_pv.type', '=', 'jang_type.id')
        ->limit(10)
        ->get();



        return view('backend/JangPv_report/index');

    }

    public function jangpv_report_datable(Request $request)
    {
        $business_location_id = 1;
        $jang_pv = DB::table('jang_pv')
        ->select('jang_pv.*','jang_type.type as type_name')
        ->leftjoin('jang_type', 'jang_pv.type', '=', 'jang_type.id')
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(jang_pv.created_at) = '{$request->s_date}' else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(jang_pv.created_at) >= '{$request->s_date}' and date(jang_pv.created_at) <= '{$request->e_date}'else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(jang_pv.created_at) = '{$request->e_date}' else 1 END"))
        ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  jang_pv.customer_username = '{$request->user_name}' else 1 END"))
        ->whereRaw(("case WHEN  '{$request->code}' != ''  THEN  jang_pv.code = '{$request->code}' else 1 END"))
        ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  jang_pv.type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($jang_pv);
        return $sQuery

            // ->setRowClass('intro-x py-4 h-24 zoom-in')
            ->addColumn('created_at', function ($row) {
                return date('Y/m/d H:i:s', strtotime($row->created_at));
            })

            ->addColumn('code', function ($row) {
                return $row->code;
            })

            ->addColumn('customer_username', function ($row) {

                return  $row->customer_username;
            })


            ->addColumn('date_active', function ($row) {
                if($row->date_active){
                    return date('Y/m/d', strtotime($row->date_active));
                }else{
                    return '';
                }

            })

            ->addColumn('position', function ($row) {
                return $row->position;
            })

            ->addColumn('pv', function ($row) {
                return number_format($row->pv,2);
            })

            ->addColumn('note_orther', function ($row) {
                return  $row->note_orther;
            })


            //->rawColumns(['detail', 'pv_total', 'date', 'code_order','tracking'])

            ->make(true);
    }
}
