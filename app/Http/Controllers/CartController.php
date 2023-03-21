<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as RequestFacade;


class CartController extends Controller
{

    public function addToCart(Request $request){
        $barcode = $request->input('product_barcode');
        $price = $request->input('price');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $cartProduct = (object) array(
            'barcode' =>$product[0]->barcode,
            'price' => $price,
            'qty' => 1
        );
        $oldCart  = $request->session()->has('cart')? $request->session()->get('cart'): null;
        if($oldCart){
            $inCart = false;
            foreach($oldCart as $item){
                if($item->barcode == $barcode){
                    $item->qty++;
                    $inCart = true;
                    break;
                }
            }
            if($inCart){
                $newCart = $oldCart;
            }
            else{
                $newCart = $oldCart;
                array_push($newCart,$cartProduct);
            }
        }
        else{
            $newCart = array($cartProduct);
        }
       
        $request->session()->put('cart', $newCart);
        $notification = array(
            'message' => 'product Added to list!',
            'alert-type' => 'success'
        );
        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addOrderPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addOrderPage')->with($notification);

        }            
    }

    public function updateCart(Request $request){
        $barcode = $request->input('barcode');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $quantity = $request->input('newQuantity');
        $cart  = $request->session()->get('cart');
        foreach($cart as $item){
            if($item->barcode == $barcode){
                $item->qty = $quantity ;
                break;
            }
        }
        $request->session()->put('cart', $cart);
        return response()->json(['cart'=>json_encode($cart)]);
        
    
    }

    public function removeCartProduct(Request $request){
        
        $barcode = $request->input('barcode');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $cart = $request->session()->get('cart');
        foreach($cart as $key=>$item){
            
            if($cart[$key]->barcode == $barcode ){
                unset($cart[$key]);
                $newcart = array_values($cart);
                $request->session()->put('cart', $newcart);
            }
        }

        //view cart
        $subTotal = 0;
        $grandTotal = 0;
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            foreach($cart as $item){
                $subTotal = $subTotal + ($item->price * $item->qty);
            }
            $grandTotal = $subTotal ;
            $notification = array(
                'message' => 'Remove product!',
                'alert-type' => 'success'
            );
            $currentUrl = RequestFacade::url();
            if(strpos($currentUrl, 'diamond') !== false){
                return redirect()->route('addOrderPageDiamond')->with($notification);
    
            }
            elseif(strpos($currentUrl, 'diamond') == false){
                return redirect()->route('addOrderPage')->with($notification);
    
            }          
        }
        else{
            $notification = array(
                'message' => 'No product to Remove!',
                'alert-type' => 'success'
            );
            return redirect()->route('addOrderPage')->with($notification);
        }
            
        
    }

    public function checkout(Request $request){
       
        $customerName = $request->customer_name;
        $customerAddress = $request->customer_address;
        $customerPhone = $request->customer_phone;
        $chalanNo = $request->chalan_no;
        $customer = Customer::where('phone',$customerPhone)->get();
        $cart = $request->session()->has('cart')? $request->session()->get('cart') : [];
        $total = 0;
        foreach($cart as $item){
            $total = $total + $item->price*$item->qty;
        }

        $invoice = new Order();
        if(count($customer) >0){
            $invoice['user_id'] = $customer[0]->id;
        }
        else{
            $newCustomer = Customer::create([
                'name' => $customerName,
                'address' => $customerAddress,
                'phone' => $customerPhone
            ]);
            $invoice['user_id'] = $newCustomer->id;
        }

        //storing order in order invoice table
        
        $invoice['phone'] = $customer[0]->phone;    
        $invoice['address'] = $customer[0]->address;
        $invoice['chalan_no'] = $chalanNo;
        $invoice['date'] = Carbon::now();
        $invoice['total_amount'] = $total;
        $invoice['status'] = "complete";
        $invoice->save();
        
        
        
        if(count($cart) > 0){
            foreach($cart as $item){
                $orderDetail = new Orderdetail();
                $orderDetail['order_id'] = $invoice['id'];
                $orderDetail['barcode_no'] = $item->barcode;
                $orderDetail['quantity'] = $item->qty;
                $orderDetail['singlePrice'] = $item->price;
                $orderDetail->save();

                $stock = DB::table('purchases')->where('barcode', $item->barcode)->get();
                $remainingStock = $stock[0]->available_qty - $item->qty ;
                DB::table('purchases')->where('barcode', $item->barcode)->update([
                    'available_qty' => $remainingStock
                ]);
            }
        }
        
        $request->session()->forget('cart');
        $notification = array(
            'message' => 'Order successfull!!',
            'alert-type' => 'success'
        );

        $currentUrl = RequestFacade::url();
        if(strpos($currentUrl, 'diamond') !== false){
            return redirect()->route('addOrderPageDiamond')->with($notification);

        }
        elseif(strpos($currentUrl, 'diamond') == false){
            return redirect()->route('addOrderPage')->with($notification);

        }          
    }
    
    
   
}