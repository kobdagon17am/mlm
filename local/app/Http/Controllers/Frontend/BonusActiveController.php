<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customers;
use App\Jang_pv;
use App\Report_bonus_active;
use App\Report_bonus_copyright;
use DB;
use DataTables;
use Auth;
use App\eWallet;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Mpdf\Tag\Em;
use PhpParser\Node\Stmt\Return_;

class BonusActiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public static function RunBonusActive($code)
    {

        $jang_pv = DB::table('jang_pv')
        ->where('code','=',$code)
        ->first();

        if(empty($jang_pv)){
            $data = ['status'=>'fail','ms'=>'ไม่พบข้อมูลที่นำไปประมวลผล'];
            return $data;
        }
        $customer_username = $jang_pv->to_customer_username;

        $data_user_g1 =  DB::table('customers')
        ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
        // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
        ->where('user_name','=',$customer_username)
        ->first();

        $name_g1 = $data_user_g1->name.' '.$data_user_g1->last_name;
        $customer_username = $data_user_g1->upline_id;
        $arr_user = array();
        $report_bonus_active = array();
        for($i=1;$i<=10;$i++){
            $x = 'start';
            $data_user =  DB::table('customers')
            ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
            // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
            ->where('user_name','=',$customer_username)
            ->first();
            // if($i==1){
            //     $name_g1 = $data_user->name.' '.$data_user->last_name;
            // }
            // dd($customer_username);

            if(empty($data_user)){
                $rs = Report_bonus_active::insert($report_bonus_active);
                return $rs;
            }


            while($x = 'start') {
                if(empty($data_user->expire_date) || empty($data_user->name) || (strtotime($data_user->expire_date) < strtotime(date('Ymd'))) ){
                    $customer_username = $data_user->upline_id;
                    $data_user =  DB::table('customers')
                    ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
                    // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
                    ->where('user_name','=',$customer_username)
                    ->first();

                }else{
                    if($data_user->qualification_id == '' || $data_user->qualification_id == null || $data_user->qualification_id == '-'){
                        $qualification_id = 'MB';
                    }else{
                        $qualification_id = $data_user->qualification_id;
                    }

                    $report_bonus_active[$i]['user_name'] =$jang_pv->to_customer_username;
                    $report_bonus_active[$i]['name'] =$name_g1;

                    $report_bonus_active[$i]['customer_user_active'] =$jang_pv->customer_username;
                    $customers = Customers::select('name', 'last_name', 'user_name')->where('user_name',$jang_pv->customer_username)->first();
                    $name = $customers->name.' '.$customers->last_name;
                    $report_bonus_active[$i]['customer_name_active'] =$name;
                    $report_bonus_active[$i]['user_name_g'] =$data_user->user_name;
                    $report_bonus_active[$i]['name_g'] =$data_user->name.' '.$data_user->last_name;
                    $report_bonus_active[$i]['code'] =$jang_pv->code;
                    $report_bonus_active[$i]['qualification'] = $qualification_id;
                    $report_bonus_active[$i]['g'] = $i;
                    $report_bonus_active[$i]['pv'] = $jang_pv->pv;

                    $y = date('Y') + 543;
                    $y = substr($y, -2);
                    $code_bonus =  IdGenerator::generate([
                        'table' => 'report_bonus_active',
                        'field' => 'code_bonus',
                        'length' => 15,
                        'prefix' => 'B6' . $y . '' . date("m") . '-',
                        // 'reset_on_prefix_change' => true
                    ]);

                    $report_bonus_active[$i]['code_bonus'] = $code_bonus;

                    $arr_user[$i]['user_name']=$data_user->user_name;
                    $arr_user[$i]['lv']=[$i];
                    if($i<= 5){
                        $report_bonus_active[$i]['percen'] = 20;
                        $arr_user[$i]['bonus_percen'] = 20;
                        $arr_user[$i]['pv'] = $jang_pv->pv;
                        $arr_user[$i]['position'] = $qualification_id;
                        $wallet_total=$jang_pv->pv * 20/100;
                        $arr_user[$i]['bonus'] = $wallet_total;
                        $report_bonus_active[$i]['bonus'] = $wallet_total;

                    }else{
                        $report_bonus_active[$i]['percen'] = 20;
                        $arr_user[$i]['bonus_percen'] = 20;
                        $arr_user[$i]['pv'] = $jang_pv->pv;
                        $arr_user[$i]['position'] = $qualification_id;

                        if($i == 6 and $qualification_id == 'MB' ){
                            $report_bonus_active[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }elseif($i == 7 and ($qualification_id == 'MB' || $qualification_id == 'MO')){
                            $report_bonus_active[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;

                        }elseif($i == 8 and ($qualification_id == 'MB' || $qualification_id == 'MO' || $qualification_id == 'VIP')){
                            $report_bonus_active[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;

                        }elseif(($i == 9 || $i == 10) and ($qualification_id == 'MB' || $qualification_id == 'MO' || $qualification_id == 'VIP' || $qualification_id == 'VVIP')){
                            $report_bonus_active[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;

                        }else{
                            $wallet_total=$jang_pv->pv * 20/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_active[$i]['bonus'] = $wallet_total;

                        }


                    }

                    $customer_username = $data_user->upline_id;
                    $x = 'stop';
                    break;
                }


            }

        }
        //  dd($report_bonus_active);

         $rs = Report_bonus_active::insert($report_bonus_active);

         //$data = ['status'=>'success','ms'=>'success','arr_user'=>$arr_user,'report_bonus_active'=>$report_bonus_active];
         return $rs;
    }


    public static function RunBonus_copyright($code)//โบนัสเจ้าขอลิขสิท
    {

        $jang_pv = DB::table('jang_pv')
        ->where('code','=',$code)
        ->first();

        if(empty($jang_pv)){
            $data = ['status'=>'fail','ms'=>'ไม่พบข้อมูลที่นำไปประมวลผล'];
            return $data;
        }
        $customer_username = $jang_pv->to_customer_username;

        $data_user_g1 =  DB::table('customers')
        ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
        // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
        ->where('user_name','=',$customer_username)
        ->first();
        $name_g1 = $data_user_g1->name.' '.$data_user_g1->last_name;

        $customer_username = $data_user_g1->upline_id;
        $arr_user = array();
        $report_bonus_copyright = array();
        for($i=1;$i<=6;$i++){
            $x = 'start';
            $data_user =  DB::table('customers')
            ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
            // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
            ->where('user_name','=',$customer_username)
            ->first();

            // dd($customer_username);

            if(empty($data_user)){
                $rs = Report_bonus_copyright::insert($report_bonus_copyright);
                return $rs;
            }


            while($x = 'start') {
                if(empty($data_user->expire_date) || empty($data_user->name) || (strtotime($data_user->expire_date) < strtotime(date('Ymd'))) ){
                    $customer_username = $data_user->upline_id;
                    $data_user =  DB::table('customers')
                    ->select('customers.name','customers.last_name','customers.user_name','customers.upline_id','customers.qualification_id','customers.expire_date')
                    // ->leftjoin('dataset_qualification', 'dataset_qualification.code', '=','customers.qualification_id')
                    ->where('user_name','=',$customer_username)
                    ->first();

                }else{
                    if($data_user->qualification_id == '' || $data_user->qualification_id == null || $data_user->qualification_id == '-'){
                        $qualification_id = 'MB';
                    }else{
                        $qualification_id = $data_user->qualification_id;
                    }

                    $report_bonus_copyright[$i]['user_name'] =$jang_pv->to_customer_username;
                    $report_bonus_copyright[$i]['name'] =$name_g1;
                    $report_bonus_copyright[$i]['user_name_g'] =$data_user->user_name;
                    $report_bonus_copyright[$i]['name_g'] =$data_user->name.' '.$data_user->last_name;
                    $report_bonus_copyright[$i]['code'] =$jang_pv->code;
                    $report_bonus_copyright[$i]['qualification'] = $qualification_id;
                    $report_bonus_copyright[$i]['g'] = $i;
                    $report_bonus_copyright[$i]['bonus_type_6'] = $jang_pv->wallet;

                    $y = date('Y') + 543;
                    $y = substr($y, -2);
                    $code_bonus =  IdGenerator::generate([
                        'table' => 'report_bonus_copyright',
                        'field' => 'code_bonus',
                        'length' => 15,
                        'prefix' => 'B7' . $y . '' . date("m") . '-',
                        // 'reset_on_prefix_change' => true
                    ]);

                    $report_bonus_copyright[$i]['code_bonus'] = $code_bonus;

                    $arr_user[$i]['user_name']=$data_user->user_name;
                    $arr_user[$i]['lv']=[$i];

                    if($i== 1){
                        $report_bonus_copyright[$i]['percen'] = 20;
                        $arr_user[$i]['bonus_percen'] = 20;
                        $arr_user[$i]['bonus_type_6'] = $jang_pv->wallet;
                        $arr_user[$i]['position'] = $qualification_id;
                        if($i == 1 and $qualification_id == 'MB' ){
                            $report_bonus_copyright[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }else{
                            $wallet_total=$jang_pv->wallet * 20/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_copyright[$i]['bonus'] = $wallet_total;
                        }
                    }elseif($i== 2){
                        $report_bonus_copyright[$i]['percen'] = 15;
                        $arr_user[$i]['bonus_percen'] = 15;
                        $arr_user[$i]['bonus_type_6'] = $jang_pv->wallet;
                        $arr_user[$i]['position'] = $qualification_id;
                        if($i == 1 and ($qualification_id == 'MB'||$qualification_id == 'MO' ) ){
                            $report_bonus_copyright[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }else{
                            $wallet_total=$jang_pv->wallet * 15/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_copyright[$i]['bonus'] = $wallet_total;
                        }

                    }elseif($i== 3){
                        $report_bonus_copyright[$i]['percen'] = 5;
                        $arr_user[$i]['bonus_percen'] = 5;
                        $arr_user[$i]['bonus_type_6'] = $jang_pv->wallet;
                        $arr_user[$i]['position'] = $qualification_id;
                        if($i == 1 and ($qualification_id == 'MB'||$qualification_id == 'MO' ||$qualification_id == 'VIP' ) ){
                            $report_bonus_copyright[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }else{
                            $wallet_total=$jang_pv->wallet * 5/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_copyright[$i]['bonus'] = $wallet_total;
                        }

                    }elseif($i== 4){
                        $report_bonus_copyright[$i]['percen'] = 4;
                        $arr_user[$i]['bonus_percen'] = 4;
                        $arr_user[$i]['bonus_type_6'] = $jang_pv->wallet;
                        $arr_user[$i]['position'] = $qualification_id;
                        if($i == 1 and ($qualification_id == 'MB'||$qualification_id == 'MO' ||$qualification_id == 'VIP'|| $qualification_id == 'VVIP' ) ){
                            $report_bonus_copyright[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }else{
                            $wallet_total=$jang_pv->wallet * 4/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_copyright[$i]['bonus'] = $wallet_total;
                        }

                    }else{
                        $report_bonus_copyright[$i]['percen'] = 3;
                        $arr_user[$i]['bonus_percen'] = 3;
                        $arr_user[$i]['bonus_type_6'] = $jang_pv->wallet;
                        $arr_user[$i]['position'] = $qualification_id;
                        if($i == 1 and ($qualification_id == 'MB'||$qualification_id == 'MO' ||$qualification_id == 'VIP' || $qualification_id == 'VVIP' ) ){
                            $report_bonus_copyright[$i]['bonus'] = 0;
                            $arr_user[$i]['bonus'] = 0;
                        }else{
                            $wallet_total=$jang_pv->wallet * 3/100;
                            $arr_user[$i]['bonus'] = $wallet_total;
                            $report_bonus_copyright[$i]['bonus'] = $wallet_total;
                        }

                    }

                    $customer_username = $data_user->upline_id;
                    $x = 'stop';
                    break;
                }


            }

        }
        //dd($report_bonus_copyright);

         $rs = Report_bonus_copyright::insert($report_bonus_copyright);

         //$data = ['status'=>'success','ms'=>'success','arr_user'=>$arr_user,'report_bonus_cashback'=>$report_bonus_cashback];
         return $rs;
    }



}
