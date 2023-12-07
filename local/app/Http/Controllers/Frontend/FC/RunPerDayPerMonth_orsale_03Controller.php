<?php

namespace App\Http\Controllers\Frontend\FC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\eWallet;
use Mpdf\Tag\Select;

class RunPerDayPerMonth_orsale_03Controller extends Controller
{
    public $arr = array();

    public function bonus_allsale_permounth_03()
    {
 
 
        dd('closs');
        $introduce_id = self::tree()->flatten();
        // dd($introduce_id,$this->arr);
        $y = '2023';
        $m = '10';
        $route = 1; 

        foreach ($introduce_id as $value) {
            if (@$this->arr['full_bonus'][$value->id]) {
                $sum_bonus_sponser = array_sum($this->arr['full_bonus'][$value->id]);
            } else {
                $sum_bonus_sponser = 0;
            }

            $dataPrepare = [ 
                'bonus_full' => $value->full_bonus,
                'bonus_sponser' => $sum_bonus_sponser,
                'bonus_total_01' => $value->full_bonus - $sum_bonus_sponser,

            ];
            // dd($dataPrepare); 
            $report_bonus_all_sale_permouth =  DB::table('report_bonus_all_sale_permouth')
                ->updateOrInsert(['user_name' => $value->user_name, 'year' => $y, 'month' => $m, 'route' => $route], $dataPrepare);
        }

        dd('success 03');
    }
 



    public function tree()
    {
        $request['s_date'] = date('2023-10-01');
        $request['e_date'] = date('2023-10-31');
        $y = '2023';
        $m = '10'; 
        $route = 1;
        $data_all = DB::table('report_bonus_all_sale_permouth')
            ->where('year', '=', $y)
            ->where('month', '=', $m)
            ->where('route', '=', $route)

            // ->where('id', '=','11737')
            ->orderby('customer_id_fk', 'DESC')
            //->limit(10)
            ->get();

        $this->formatTree($data_all);
        return $data_all;
    }



    public function formatTree($data_all, $num = 0, $head = 0)
    {

        $num += 1;
        foreach ($data_all as $key => $upline_id) {


            $data = self::user_upline($upline_id->user_name);


            if ($data->isNotEmpty()) {




                if ($num == 1) {

                    $upline_id->children = self::user_upline($upline_id->user_name);
                    $upline_id->num = $num;

                    self::formatTree($upline_id->children, $num, $upline_id->id);
                    $upline_id->head = $upline_id->id;
                    $upline_id->full_bonus   = $upline_id->pv_full * $upline_id->rat / 100;
                } else {
                    $upline_id->head = $head;

                    if (
                        $upline_id->qualification_id == 'XVVIP' ||  $upline_id->qualification_id == 'SVVIP' || $upline_id->qualification_id == 'MG' || $upline_id->qualification_id == 'MR'
                        ||  $upline_id->qualification_id == 'ME' || $upline_id->qualification_id == 'MD'
                    ) {

                        if ($upline_id->pv_allsale_permouth >= 100000) {
                            $rat = 75;
                        } elseif ($upline_id->pv_allsale_permouth  >= 30000 and $upline_id->pv_allsale_permouth < 100000) {
                            $rat = 55;
                        } elseif ($upline_id->pv_allsale_permouth  >= 10000 and $upline_id->pv_allsale_permouth < 30000) {
                            $rat = 40;
                        } elseif ($upline_id->pv_allsale_permouth  >= 5000 and $upline_id->pv_allsale_permouth < 10000) {
                            $rat = 30;
                        } elseif ($upline_id->pv_allsale_permouth  >= 2400 and $upline_id->pv_allsale_permouth < 5000) {
                            $rat = 20;
                        } elseif ($upline_id->pv_allsale_permouth  >= 1200 and $upline_id->pv_allsale_permouth < 2400) {
                            $rat = 15;
                        } elseif ($upline_id->pv_allsale_permouth  >= 800 and $upline_id->pv_allsale_permouth < 1200) {
                            $rat = 10;
                        } elseif ($upline_id->pv_allsale_permouth  >= 400 and $upline_id->pv_allsale_permouth < 800) {
                            $rat = 5;
                        } else {
                            $rat = 0;
                        }
                        if ($rat > 0) {
                            $this->arr['full_bonus'][$head][$upline_id->user_name] = $upline_id->pv_allsale_permouth * $rat / 100;
                        }
                    } else {
                        $upline_id->children = self::user_upline($upline_id->user_name);
                        $upline_id->num = $num;

                        self::formatTree($upline_id->children, $num, $head);
                    }
                }
            } else {

                if ($num == 1) {
                    $upline_id->full_bonus   = $upline_id->pv_full * $upline_id->rat / 100;
                } else {
                    $upline_id->head = $head;
                    if (
                        $upline_id->qualification_id == 'XVVIP' ||  $upline_id->qualification_id == 'SVVIP' || $upline_id->qualification_id == 'MG' || $upline_id->qualification_id == 'MR'
                        ||  $upline_id->qualification_id == 'ME' || $upline_id->qualification_id == 'MD'
                    ) {

                        if ($upline_id->pv_allsale_permouth >= 100000) {
                            $rat = 75;
                        } elseif ($upline_id->pv_allsale_permouth  >= 30000 and $upline_id->pv_allsale_permouth < 100000) {
                            $rat = 55;
                        } elseif ($upline_id->pv_allsale_permouth  >= 10000 and $upline_id->pv_allsale_permouth < 30000) {
                            $rat = 40;
                        } elseif ($upline_id->pv_allsale_permouth  >= 5000 and $upline_id->pv_allsale_permouth < 10000) {
                            $rat = 30;
                        } elseif ($upline_id->pv_allsale_permouth  >= 2400 and $upline_id->pv_allsale_permouth < 5000) {
                            $rat = 20;
                        } elseif ($upline_id->pv_allsale_permouth  >= 1200 and $upline_id->pv_allsale_permouth < 2400) {
                            $rat = 15;
                        } elseif ($upline_id->pv_allsale_permouth  >= 800 and $upline_id->pv_allsale_permouth < 1200) {
                            $rat = 10;
                        } elseif ($upline_id->pv_allsale_permouth  >= 400 and $upline_id->pv_allsale_permouth < 800) {
                            $rat = 5;
                        } else {
                            $rat = 0;
                        }
                        if ($rat > 0) {
                            $this->arr['full_bonus'][$head][$upline_id->user_name] = $upline_id->pv_allsale_permouth * $rat / 100;
                        }
                    } else {
                        $upline_id->children = self::user_upline($upline_id->user_name);
                        $upline_id->num = $num;
                        self::formatTree($upline_id->children, $num, $head);
                    }
                }
            }
        }
    }

 
    public static function user_upline($user_name)
    {
        $introduce_id = DB::table('customers')
            ->select('id', 'user_name', 'introduce_id', 'qualification_id', 'expire_date', 'name', 'last_name', 'id_card', 'pv_allsale_permouth')
            //   ->wherein('customers.qualification_id',['XVVIP','SVVIP','MG','MR','ME','MD'])
            ->where('customers.pv_allsale_permouth', '>', 0)
            ->where('customers.introduce_id', '=', $user_name);

        return $introduce_id->get();
    }
 

    public function bonus_allsale_permounth_04()
    {
          dd('closs');



        $request['s_date'] = date('2023-10-01');
        $request['e_date'] = date('2023-10-31');
        $y = '2023';
        $m = '10';
        $route = 1;
        $report_bonus_all_sale_permouth = DB::table('report_bonus_all_sale_permouth')
            ->where('year', '=', $y)
            ->where('month', '=', $m)
            ->where('route', '=', $route)
            ->where('rat', '=', 75)
            // ->wherein('user_name',['4005475','6056722'])
            ->where('status_runbonus_allsale_2','pending')
            ->orderby('customer_id_fk', 'DESC')
            // ->limit(2) 
            ->get(); 

            // dd($report_bonus_all_sale_permouth);
         
            $arr = array();
            $i = 0;
        foreach ($report_bonus_all_sale_permouth as $value) {
           
            $customer = DB::table('report_bonus_all_sale_permouth')
          
                ->where('year', '=', $y)
                ->where('month', '=', $m)
                ->where('route', '=', $route)
                ->where('rat', '=', 75)
                // ->whereRaw("$value->pv_full - `pv_full` >= 100000") 
                ->where('introduce_id', $value->user_name)
               
                ->orderby('customer_id_fk', 'DESC')
                // ->limit(2)
                ->get();


                if(count($customer)> 0){
                    $i++;
                    $customer_rs = DB::table('report_bonus_all_sale_permouth')
                    ->SelectRaw('sum(pv_full) as pv_full')
                        ->where('year', '=', $y)
                        ->where('month', '=', $m)
                        ->where('route', '=', $route)
                        ->where('rat', '=', 75)
                        ->where('introduce_id', $value->user_name)

                        ->groupby('introduce_id')
                        // ->limit(2)
                        ->first();

                        

                    $bonus_total_02 = $customer_rs->pv_full * (25/100);
                    DB::table('report_bonus_all_sale_permouth')
                    ->where('user_name', '=', $value->user_name)
                    ->update(['bonus_total_02'=>$bonus_total_02,'status_runbonus_allsale_2' => 'success']);
                                   
                    $arr[$value->user_name]['user'][] = $customer;
                    $arr[$value->user_name]['pv_full_head'] =  $value->pv_full;
          
                   
                }else{
                 
                DB::table('report_bonus_all_sale_permouth')
                ->where('user_name', '=', $value->user_name)
                ->update(['bonus_total_02'=>0,'status_runbonus_allsale_2' => 'success']);
             
                }

        }

        // dd($arr);
        dd($i,'success');
      
    }
 
    public function bonus_allsale_permounth_05()//คำนวน vat
    {
        dd('closs');
         
    try {
        DB::BeginTransaction();
        $request['s_date'] = date('2023-10-01');
        $request['e_date'] = date('2023-10-31');
        $y = '2023';
        $m = '10';
        $route = 1;
        $report_bonus_all_sale_permouth_all = DB::table('report_bonus_all_sale_permouth')
        ->where('year', '=', $y)
        ->where('month', '=', $m)
        ->where('route', '=', $route)
        ->orderby('customer_id_fk', 'DESC')
        // ->limit(2) 
        ->get();
    foreach ($report_bonus_all_sale_permouth_all as $value) {
        if (empty($value->bonus_total_02)) {
            $bonus_total_02 = 0;
        } else {
            $bonus_total_02 = $value->bonus_total_02;
        }


        $tax_total = ($value->bonus_total_01+$bonus_total_02) * (3/100);
        $bonus_total_not_tax =  $value->bonus_total_01+$bonus_total_02;
        $bonus_total_in_tax =   $bonus_total_not_tax - $tax_total;



        $dataPrepare = [
            'bonus_total_02' => $bonus_total_02,
            'tax_total' => $tax_total,
            'bonus_total_not_tax' =>$bonus_total_not_tax,
            'bonus_total_in_tax' =>$bonus_total_in_tax ,

        ];
        // dd($dataPrepare);
        $update =  DB::table('report_bonus_all_sale_permouth')
            ->updateOrInsert(['user_name' => $value->user_name, 'year' => $y, 'month' => $m, 'route' => $route], $dataPrepare);


    }

    // dd('success');
      
        DB::commit();
           dd('success');
    } catch (Exception $e) {
        DB::rollback();
        return 'fail';
    }

 
    }

    

    public function bonus_allsale_permounth_06()

    {
        $m = 10;
        dd('closs');
        //]ลบรายการที่เป็น 0
        // $delete = DB::table('report_bonus_all_sale_permouth')
        // ->select('id','user_name','bonus_total_not_tax as bonus_full', 'bonus_total_in_tax as el','tax_total', 'note')
        // ->where('status','=','pending')
        // ->where('month', '=',$m)
        // ->where('bonus_total_in_tax', '<=',0)
        // ->delete();
        // dd($delete); 
      
        $c = DB::table('report_bonus_all_sale_permouth')
        ->select('id','user_name','bonus_total_not_tax as bonus_full', 'bonus_total_in_tax as el','tax_total', 'note')
        ->where('status','=','pending')
        ->where('month', '=',$m)
        ->limit(50)
        // ->where('note','=','Easy โปรโมชั่น รอบ 21ธ.ค.65 - 5 ม.ค.66')
        ->get();


    
        // dd('ddd');
    $i = 0;
    try {
        DB::BeginTransaction();

        // foreach ($c as $value) {
        //     $customers = DB::table('customers')
        //         ->select('id', 'user_name', 'ewallet','ewallet_use')
        //         ->where('user_name', $value->user_name)
        //         ->first();
        //         if(empty($customers)){
        //             dd($value->user_name,'Not Success');
        //         }
        // }

        foreach ($c as $value) {
            $customers = DB::table('customers')
                ->select('id', 'user_name', 'ewallet','ewallet_use')
                ->where('user_name', $value->user_name)
                ->first();
                // if(empty($customers)){
                //     dd($value->user_name);
                // }


                if(empty($customers->ewallet)){
                    $ewallet = 0;
                }else{
                    $ewallet = $customers->ewallet;
                }

                if(empty($customers->ewallet_use)){
                    $ewallet_use = 0;
                }else{
                    $ewallet_use = $customers->ewallet_use;
                }

            $ew_total = $ewallet  + $value->el;
            $ew_use = $ewallet_use + $value->el;
            DB::table('customers')
                ->where('user_name', $value->user_name)
                ->update(['ewallet' => $ew_total,'ewallet_use'=>$ew_use]);


            $count_eWallet =  \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_wallet();


            $dataPrepare = [
                'transaction_code' => $count_eWallet,
                'customers_id_fk' => $customers->id,
                'customer_username' => $value->user_name,
                'tax_total' => $value->tax_total,
                'bonus_full' => $value->bonus_full,
                'amt' => $value->el,
                'old_balance' => $customers->ewallet,
                'balance' => $ew_total,
                'note_orther' => $value->note,
                'receive_date' => now(),
                'receive_time' => now(),
                'type' => 1,
                'status' => 2,
            ];

            $query =  eWallet::create($dataPrepare);
            DB::table('report_bonus_all_sale_permouth')
                ->where('id', $value->id)
                ->update(['status' => 'success']);

            $i++;
        }
      
        DB::commit();
           dd('success');
    } catch (Exception $e) {
        DB::rollback();
        return 'fail';
    }


    dd($i, 'success');

    }



 


    public function bonus_allsale_permounth_06_error()

    {
            $c = DB::table('report_bonus_all_sale_permouth')
            ->select('id','user_name','bonus_total_not_tax as bonus_full', 'bonus_total_in_tax as el','tax_total', 'note')
            ->where('status_fail','=','success')
            ->get();
           dd($c);
        $i = 0;
        $arr = array();

        foreach ($c as $value) {

            $customers = DB::table('customers')
                ->select('id', 'user_name', 'ewallet')
                ->where('user_name', $value->user_name)
                ->first();

              
            $ew_total = $customers->ewallet - $value->el;

            if($ew_total< 0){
                DB::table('report_bonus_all_sale_permouth')
                ->where('id', $value->id)
                ->update(['status_fail' => 'fail']);


            }else{
                DB::table('customers')
                ->where('user_name', $value->user_name)
                ->update(['ewallet' => $ew_total]);

                DB::table('report_bonus_all_sale_permouth')
                ->where('id', $value->id)
                ->update(['status_fail' => 'success']);

            }

            $i++;
        }

    }






}
