<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Cart;
use Auth;
use Stripe\Stripe;
use Stripe\Charge;

class ProductController extends Controller {

//
    public function getIndex() {
        $product = Product::all();
        return view('shop.index', ['product' => $product]);
    }

    public function getAddToCart(Request $request, $id) {

        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        }
        else{
             Session::forget('cart'); 
        }
        
        return redirect()->route('product.shoppingCart');
    }

    public function getReduceItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        }
        else{
             Session::forget('cart'); 
        }
        return redirect()->route('product.shoppingCart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['product' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request) {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_RlBQ5xSVC1gBAoJNHskC0OWn');
        try {
            $charge = Charge::create(array(
                        "amount" => $cart->totalPrice * 100,
                        "currency" => "usd",
                        "source" => $request->input('stripeToken'), // obtained with Stripe.js
                        "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->address;
            $order->name = $request->name;
            $order->payment_id = $charge->id;
            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }


        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully Purchased Products!!');
    }

}
