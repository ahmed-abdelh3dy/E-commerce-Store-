<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ProductsApiController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except('index', 'show');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products =  Product::filter($request->query())
            ->with('category:id,name', 'store:id,name')     // لو انا عايز ارجع بيانات اضافيه وممكن اخصص البيانات دي هتكون اي 
            ->paginate();


        //  يستخدم للتحكم في شكل عرض البيانات  في حاله  جميع العناصر ProductsResource:collection
        return ProductsResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $user = Auth::guard('sanctum')->user();
        
        if (!$user->tokenCan('products.create')) {
            return response([
                'massage' => 'not allowed'
            ]);
        }
        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //  يستخدم للتحكم في شكل عرض البيانات  في حاله العنصر الواحد new ProductsResource
        return new ProductsResource($product);
        return $product
            ->load('category:id,name', 'store:id,name');           // في حاله لو انا عايز ارجع داتا كمان مع ال الريسبونس
        // return  Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('products.update')) {
            abort(403);
        }

        $product->update($request->all());
        return Response::json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('products.delete')) {
            return response([
                'massage' => 'not allowed'
            ]);
        }
        Product::destroy($id);
        return response()->json([
            'message' =>    'category deleted successfully'
        ], 200);
    }
}
