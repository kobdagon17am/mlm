<?php

namespace App\Http\Controllers\Backend;

use App\eWallet;
use App\Customers;
use App\CustomersBank;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Customer;
use App\Member;
use App\Exports\Export;
use App\Exports\Exportaccounting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use  Maatwebsite\Excel\Facades\Excel;

class eWalletController extends Controller
{

    public function index()
    {
        return view('backend/ewallet/index');
    }

    public function withdraw()
    {
        return view('backend/ewallet/withdraw');
    }

    public function transfer()
    {
        return view('backend/ewallet/transfer');
    }


    public function get_ewallet(Request $request)
    {
        $data =  eWallet::select(
            'ewallet.id',
            'transaction_code',
            'customers_id_fk',
            'file_ewllet',
            'ewallet.amt',
            'ewallet.edit_amt',
            'ewallet.note_orther',
            'customers_id_receive',
            'customers_name_receive',
            'type',
            'status',
            'type_note',
            'ewallet.created_at',
            'date_mark',
            'ew_mark',
            'customers.user_name',
            'customers.name as customer_name',
            'customers.last_name as customer_last_name',
        )
            ->where('type', '1')
            ->where(function ($query) use ($request) {
                if ($request->has('Where')) {
                    foreach (request('Where') as $key => $val) {
                        if ($val) {
                            if (strpos($val, ',')) {
                                $query->whereIn($key, explode(',', $val));
                            } else {
                                $query->where($key, $val);
                            }
                        }
                    }
                }
                if ($request->has('Like')) {
                    foreach (request('Like') as $key => $val) {
                        if ($val) {
                            $query->where($key, 'like', '%' . $val . '%');
                        }
                    }
                }
            })
            ->leftjoin('customers', 'customers.id', 'ewallet.customers_id_fk')
            ->OrderBy('created_at', 'DESC')
            ->get();




        return DataTables::of($data)
            ->setRowClass('intro-x py-4 h-24 zoom-in')

            // ดึงข้อมูล created_at
            ->editColumn('created_at', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->created_at));

                return $time;
            })
            ->editColumn('date_mark', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->date_mark));
                return $time == '01-01-1970 07:00:00' ?  '-' : $time;
            })
            // ดึงข้อมูล lot_expired_date วันหมดอายุ
            ->editColumn('amt', function ($query) {
                $amt = number_format($query->amt, 2) . " บาท";
                return $amt;
            })
            ->editColumn('edit_amt', function ($query) {
                $edit_amt = $query->edit_amt == 0 ? '' :  number_format($query->edit_amt, 2) . " บาท";
                return $edit_amt;
            })


            ->addColumn('customers_name', function ($query) {
                $customers = Customers::select('name', 'last_name')->where('id', $query->customers_id_fk)->first();
                $test_customers = $customers['name'] . " " . $customers['last_name'];
                return $test_customers;
            })

            ->editColumn('ew_mark', function ($query) {
                $member = Member::select('name', 'last_name')->where('id', $query->ew_mark)->first();
                $text_member =  $member != null ? $member['name'] . ' ' . $member['last_name'] : '-';
                return $text_member;
            })

            ->editColumn('type', function ($query) {
                $type = $query->type;
                $text_type = "";

                if ($type  == 1) {
                    $text_type = "ฝากเงิน";
                }
                if ($type  == 2) {
                    $text_type = "โอนเงิน";
                }
                if ($type  == 3) {
                    $text_type = "ถอนเงิน";
                }

                return $text_type;
            })

            ->make(true);
    }

    public function get_transfer(Request $request)
    {
        $data =  eWallet::select(
            'ewallet.id',
            'transaction_code',
            'customers_id_fk',
            'file_ewllet',
            'ewallet.amt',
            'ewallet.edit_amt',
            'customers_id_receive',
            'customers_name_receive',
            'type',
            'status',
            'type_note',
            'ewallet.created_at',
            'date_mark',
            'ew_mark',
            'customers.user_name',
            'customers.name as customer_name',
            'customers.last_name as customer_last_name',
        )
            ->where('type', '2')
            ->where(function ($query) use ($request) {
                if ($request->has('Where')) {
                    foreach (request('Where') as $key => $val) {
                        if ($val) {
                            if (strpos($val, ',')) {
                                $query->whereIn($key, explode(',', $val));
                            } else {
                                $query->where($key, $val);
                            }
                        }
                    }
                }
                if ($request->has('Like')) {
                    foreach (request('Like') as $key => $val) {
                        if ($val) {
                            $query->where($key, 'like', '%' . $val . '%');
                        }
                    }
                }
            })
            ->leftjoin('customers', 'customers.id', 'ewallet.customers_id_fk')
            ->OrderBy('created_at', 'DESC')
            ->get();




        return DataTables::of($data)
            ->setRowClass('intro-x py-4 h-24 zoom-in')

            // ดึงข้อมูล created_at
            ->editColumn('created_at', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->created_at));

                return $time;
            })
            ->editColumn('date_mark', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->date_mark));
                return $time == '01-01-1970 07:00:00' ?  '-' : $time;
            })
            // ดึงข้อมูล lot_expired_date วันหมดอายุ
            ->editColumn('amt', function ($query) {
                $amt = number_format($query->amt, 2) . " บาท";
                return $amt;
            })
            ->editColumn('edit_amt', function ($query) {
                $edit_amt = $query->edit_amt == 0 ? '' :  number_format($query->edit_amt, 2) . " บาท";
                return $edit_amt;
            })


            ->editColumn('user_name', function ($query) {
                $customers = Customers::select('name', 'last_name', 'user_name')->where('user_name', $query->user_name)->first();
                $test_customers = $customers['name'] . " " . $customers['last_name']   . " " . '(' . $customers['user_name'] . ')';
                return $test_customers;
            })

            ->editColumn('customers_id_receive', function ($query) {

                $test_customers = $query->customers_name_receive . " " . '(' . $query->customers_id_receive . ')';
                return $test_customers;
            })

            ->editColumn('ew_mark', function ($query) {
                $member = Member::select('name', 'last_name')->where('id', $query->ew_mark)->first();
                $text_member =  $member != null ? $member['name'] . ' ' . $member['last_name'] : '-';
                return $text_member;
            })

            ->editColumn('type', function ($query) {
                $type = $query->type;
                $text_type = "";

                if ($type  == 1) {
                    $text_type = "ฝากเงิน";
                }
                if ($type  == 2) {
                    $text_type = "โอนเงิน";
                }
                if ($type  == 3) {
                    $text_type = "ถอนเงิน";
                }

                return $text_type;
            })

            ->make(true);
    }

    public function get_withdraw(Request $request)
    {
        $data =  eWallet::select(
            'ewallet.id',
            'transaction_code',
            'customers_id_fk',
            'file_ewllet',
            'ewallet.amt',
            'ewallet.edit_amt',
            'customers_id_receive',
            'customers_name_receive',
            'type',
            'status',
            'type_note',
            'ewallet.created_at',
            'date_mark',
            'ew_mark',
            'customers.user_name',
            'customers.name as customer_name',
            'customers.last_name as customer_last_name',
        )
            ->where('type', '3')
            ->where(function ($query) use ($request) {
                if ($request->has('Where')) {
                    foreach (request('Where') as $key => $val) {
                        if ($val) {
                            if (strpos($val, ',')) {
                                $query->whereIn($key, explode(',', $val));
                            } else {
                                $query->where($key, $val);
                            }
                        }
                    }
                }
                if ($request->has('Like')) {
                    foreach (request('Like') as $key => $val) {
                        if ($val) {
                            $query->where($key, 'like', '%' . $val . '%');
                        }
                    }
                }
            })
            ->leftjoin('customers', 'customers.id', 'ewallet.customers_id_fk')
            ->OrderBy('created_at', 'DESC')
            ->get();




        return DataTables::of($data)
            ->setRowClass('intro-x py-4 h-24 zoom-in')

            // ดึงข้อมูล created_at
            ->editColumn('created_at', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->created_at));

                return $time;
            })
            ->editColumn('date_mark', function ($query) {
                $time = date('d-m-Y H:i:s', strtotime($query->date_mark));
                return $time == '01-01-1970 07:00:00' ?  '-' : $time;
            })
            // ดึงข้อมูล lot_expired_date วันหมดอายุ
            ->editColumn('amt', function ($query) {
                $amt = number_format($query->amt, 2) . " บาท";
                return $amt;
            })
            ->editColumn('edit_amt', function ($query) {
                $edit_amt = $query->edit_amt == 0 ? '' :  number_format($query->edit_amt, 2) . " บาท";
                return $edit_amt;
            })


            ->addColumn('customers_name', function ($query) {
                $customers = Customers::select('name', 'last_name')->where('id', $query->customers_id_fk)->first();
                $test_customers = $customers['name'] . " " . $customers['last_name'];
                return $test_customers;
            })

            ->editColumn('ew_mark', function ($query) {
                $member = Member::select('name', 'last_name')->where('id', $query->ew_mark)->first();
                $text_member =  $member != null ? $member['name'] . ' ' . $member['last_name'] : '-';
                return $text_member;
            })

            ->editColumn('type', function ($query) {
                $type = $query->type;
                $text_type = "";

                if ($type  == 1) {
                    $text_type = "ฝากเงิน";
                }
                if ($type  == 2) {
                    $text_type = "โอนเงิน";
                }
                if ($type  == 3) {
                    $text_type = "ถอนเงิน";
                }

                return $text_type;
            })

            ->make(true);
    }






    public function  get_info_ewallet(Request $request)
    {


        $data =  eWallet::select(
            'ewallet.id as ewallet_id',
            'transaction_code',
            'customers_id_fk',
            'ewallet.url',
            'ewallet.file_ewllet',
            'amt',
            'customers_id_receive',
            'customers_name_receive',
            'type',
            'status',
            'ewallet.created_at as ewallet_created_at',
            'customers.user_name',
            'customers.name',
            'customers_bank.bank_name',
            'customers_bank.bank_branch',
            'customers_bank.bank_no',
            'customers_bank.account_name',
        )
            ->leftjoin('customers', 'customers.id', 'ewallet.customers_id_fk')
            ->leftjoin('customers_bank', 'customers_bank.customers_id', 'customers.id')
            ->where('ewallet.id', $request->id)
            ->get();


        $data_amt =  eWallet::select(
            'amt',
        )
            ->leftjoin('customers', 'customers.id', 'ewallet.customers_id_fk')
            ->leftjoin('customers_bank', 'customers_bank.customers_id', 'customers.id')
            ->where('ewallet.id', $request->id)
            ->first();

        return response()->json(['data' => $data, 'data_amt' => number_format($data_amt['amt'], 2)]);
    }



    public function approve_update_ewallet(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required',
                'time' => 'required',
                'code_refer' => 'required',

            ],
            [
                'date.required' => 'กรุณากรอกข้อมูล',
                'time.required' => 'กรุณากรอกข้อมูล',
                'code_refer.required' => 'กรุณากรอกข้อมูล',
            ]
        );
        if (!$validator->fails()) {

            $ewallet_id = $request->ewallet_id;
            $code_refer = $request->code_refer;

            $check = eWallet::where('id', $ewallet_id)->first();

            $query = eWallet::where('code_refer', $code_refer)->first();

            $customers = Customers::where('id', $request->customers_id_fk)->first();


            $amt = $request->edit_amt == '' ? $request->amt : $request->edit_amt;

            $query_ewallet = eWallet::where('id', $ewallet_id);


            if ($query == null) {
                $dataPrepare = [
                    'receive_date' => $request->date,
                    'receive_time' => $request->time,
                    'code_refer' => $request->code_refer,
                    'balance' =>  $customers->ewallet,
                    'edit_amt' => $request->edit_amt != '' ? $request->edit_amt : 0,
                    'ew_mark' => Auth::guard('member')->user()->id,
                    'date_mark' => date('Y-m-d H:i:s'),
                    'status' => 2,
                ];



                $query_ewallet->update($dataPrepare);

                // อัพเดท old_balance กับ  balance ของ table ewallet

                if ($check->type == "3") {
                } else {
                    if ($query_ewallet) {
                        $dataPrepare_update = [
                            'old_balance' => $customers->ewallet,
                            'balance' =>  $customers->ewallet + $amt
                        ];
                        $query_ewallet->update($dataPrepare_update);
                        if ($query_ewallet) {

                            $dataPrepare_update_ewallet = [
                                'ewallet' =>  $customers->ewallet + $amt
                            ];
                            Customers::where('id', $request->customers_id_fk)->update($dataPrepare_update_ewallet);
                        }
                    }
                }
                return response()->json(['status' => 'success'], 200);
            } else {
                return response()->json(['error' => ['code_refer' => 'เลขที่อ้างอิงถูกใช้งานแล้ว']]);
            }
        }
        return response()->json(['error' => $validator->errors()]);
    }


    public function disapproved_update_ewallet(Request $request)
    {




        $radio = $request->vertical_radio_button;




        $rule = [
            'vertical_radio_button' => 'required',
        ];

        $message_err = [
            'vertical_radio_button.required' => 'กรุณาเลือกรายการ',
        ];

        if ($radio == 'อื่นๆ') {
            $rule['info_other'] = 'required';
            $message_err['info_other.required'] = 'กรุณากรอกข้อมูล';
        }

        $validator = Validator::make(
            $request->all(),
            $rule,
            $message_err
        );
        if (!$validator->fails()) {

            $dataPrepare = [
                'type_note' => $radio,
                'note_orther' => $request->info_other,
                'ew_mark' => Auth::guard('member')->user()->id,
                'date_mark' => date('Y-m-d H:i:s'),
                'status' => 3,
            ];



            $ewallet_id = $request->ewallet_id;
            $query_ewallet = eWallet::where('id', $ewallet_id)->update($dataPrepare);

            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function export()
    {
        return Excel::download(new Export, 'WithdrawExport-' . date("d-m-Y") . '.xlsx');
    }
    public function export2()
    {
        return  Excel::download(new Exportaccounting, 'Accounting-' . date("d-m-Y") . '.xlsx');
    }
    // public function saveexport(){
    //     $check = eWallet::select(
    //         'ewallet.transaction_code',
    //         'customers_bank.user_name',
    //         'customers_bank.bank_name as bankcode',
    //         'customers_bank.bank_no',
    //         'customers_bank.account_name as info1',
    //         'customers_bank.user_name as space',
    //         'ewallet.amt as amt',
    //         'ewallet.status',
    //         'customers_bank.user_name as info2',
    //         'customers_bank.user_name as info3',
    //         'customers_bank.user_name as info4',
    //         'customers_bank.user_name as info5',
    //         'customers_bank.user_name as info6',
    //         'customers_bank.user_name as info7',
    //         'customers_bank.user_name as info8',
    //     )
    //         ->join('customers_bank', 'ewallet.customers_id_fk', '=', 'customers_bank.customers_id')
    //         ->join('customers','customers_bank.customers_id','=','customers.id')
    //         ->where('ewallet.type', '3') // ประเภท
    //         ->where('ewallet.status', '1') // สถานะ
    //         ->get();
    //         foreach($check as $c){
    //             $ewallet = eWallet::where('transaction_code',$c->transaction_code)->first();
    //             $ewallet->status = "2";
    //             $ewallet->save();
    //         }
    // }

}
