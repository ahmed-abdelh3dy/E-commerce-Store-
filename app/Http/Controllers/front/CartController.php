<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\cart\CartModelRepository;
use App\Repositories\cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        
        

        return view('front.cart' ,[
            'cart' => $cart,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepository   $cart)
    {

        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['min:1', 'int', 'nullable'],
        ]);
       
        $product_id = Product::findOrFail($request->post('product_id'));
        $cart->add($product_id, $request->post('quantity'));

        return redirect()
        ->route('cart.index')
        ->with('success', 'product added to cart');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'quantity'   => ['min:1' , 'int', 'required'],
    //     ]);
    //     $this->cart->update($id , $request->post('quantity'));

    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    // افتراضاً أن لديك دالة لتحديث الكمية في CartRepository
    $this->cart->update($id, $request->input('quantity'));

    return response()->json(['message' => 'Quantity updated successfully']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // $this->cart->delete($id);  
    Cart::destroy($id);  
    return redirect()->route('front.products.show');
    // return response()->json(['message' => 'Deleted successfully']);
}

}
