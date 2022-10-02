<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }
    public function index()
    {

        // Cart::session(1)->clear();

        $categories = DB::table('dataset_categories')
            ->where('lang_id', '=', 1)
            ->where('status', '=', 1)
            ->get();

            $product_all = OrderController::product_list();

        return view('frontend/order',compact('product_all','categories'));
    }


    public static function product_list(){

        $product = DB::table('products')
        ->select(
            'products.id as products_id',
            'products_details.*',
            'products_images.*',
            'products_cost.*',
            'dataset_currency.*',
        )
        ->leftjoin('products_details', 'products.id', '=', 'products_details.product_id_fk')
        ->leftjoin('products_images', 'products.id', '=', 'products_images.product_id_fk')
        ->leftjoin('products_cost', 'products.id', '=', 'products_cost.product_id_fk')
        ->leftjoin('dataset_currency', 'dataset_currency.id', '=', 'products_cost.currency_id')

        ->where('products_images.image_default', '=', 1)
        ->where('products_details.lang_id', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products_cost.business_location_id','=', 1)
        ->orderby('products.id')
        ->get();
        //->Paginate(4);
        //dd($product);

        $data = array(
            'product' => $product);
        return $data;

    }
    public static function get_product(Request $rs){
        $product = DB::table('products')
        ->select(
            'products.id as products_id',
            'products_details.*',
            'products_images.*',
            'products_cost.*',
            'dataset_currency.*',
        )
        ->leftjoin('products_details', 'products.id', '=', 'products_details.product_id_fk')
        ->leftjoin('products_images', 'products.id', '=', 'products_images.product_id_fk')
        ->leftjoin('products_cost', 'products.id', '=', 'products_cost.product_id_fk')
        ->leftjoin('dataset_currency', 'dataset_currency.id', '=', 'products_cost.currency_id')
        ->where('products.id','=',$rs->product_id)
        ->where('products_images.image_default', '=', 1)
        ->where('products_details.lang_id', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products_cost.business_location_id','=', 1)
        ->first();

        $data = array(
            'product' => $product);
        return $data;

    }


    public function add_cart(Request $rs)
    {


        $product = DB::table('products')
        ->select(
            'products.id as products_id',
            'products_details.*',
            'products_images.*',
            'products_cost.*',
            'dataset_currency.*',
            'dataset_product_unit.product_unit as product_unit_name',
        )
        ->leftjoin('products_details', 'products.id', '=', 'products_details.product_id_fk')
        ->leftjoin('products_images', 'products.id', '=', 'products_images.product_id_fk')
        ->leftjoin('products_cost', 'products.id', '=', 'products_cost.product_id_fk')
        ->leftjoin('dataset_currency', 'dataset_currency.id', '=', 'products_cost.currency_id')
        ->leftjoin('dataset_product_unit', 'dataset_product_unit.product_unit_id', '=', 'products.unit_id')
        ->where('products.id','=',$rs->id)
        ->where('products_images.image_default', '=', 1)
        ->where('products_details.lang_id', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products_cost.business_location_id','=', 1)
        ->first();

        if( $product){
             Cart::session(1)->add(array(
                'id' => $product->products_id, // inique row ID
                'name' => $product->product_name,
                'price' => $product->member_price,
                'quantity' => $rs->quantity,
                'attributes' => array(
                    'pv' => $product->pv,
                    'img' => asset($product->img_url . '' . $product->product_img),
                    // 'product_unit_id'=>$product->unit_id,
                    'product_unit_name'=>$product->product_unit_name,
                    'descriptions' => $product->descriptions,
                    // 'promotion_id' => $rs->id,
                    'detail' => '',
                    // 'category_id' => $product->category_id,
                ),
            ));

            $getTotalQuantity = Cart::session(1)->getTotalQuantity();

            // $item = Cart::session($request->type)->getContent();
            $data = ['status'=>'success','qty'=>$getTotalQuantity];

        }else{
            $data = ['status'=>'fail','ms'=>'ไม่พบสินค้าในระบบกรุณาทำรยการไหม่อีกครั้ง'];

        }


        return $data;


    }

    public function cart()
    {

        $cartCollection = Cart::session(1)->getContent();
        $data = $cartCollection->toArray();

        $quantity = Cart::session(1)->getTotalQuantity();
        if ($data) {
            foreach ($data as $value) {
                $pv[] = $value['quantity'] * $value['attributes']['pv'];
            }
            $pv_total = array_sum($pv);
        } else {
            $pv_total = 0;
        }


        $price = Cart::session(1)->getTotal();
        $price_total = number_format($price, 2);

        $bill = array('price_total' => $price_total,
            'pv_total' => $pv_total,
            'data' => $data,
            'quantity' => $quantity,
            'status' => 'success',

        );


        return view('frontend/cart', compact('bill'));
    }

    public function cart_delete(Request $request)
    {
        //dd($request->all());
        Cart::session(1)->remove($request->data_id);
        return redirect('cart')->withSuccess('Deleted Success');
    }


    // ประวัติการสั่งซื้อ
    public function order_history()
    {
        return view('frontend/order-history');
    }

    // รายละเอียดของ ออเดอร์
    public function order_detail()
    {
        return view('frontend/order-detail');
    }
}
