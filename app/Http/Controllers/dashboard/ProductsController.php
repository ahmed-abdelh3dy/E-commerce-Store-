<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate();
        return view('dashboard.products.index' , compact('products'));
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
    public function store(Request $request)
    {
        //
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
        $product = Product::findOrFail($id);

        $tags =implode(',' , $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('product' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        $tag_ids = [];

        $tags = explode(',', $request->post('tags'));
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag = tag::where('slug', $slug)->first();
            if (!$tag) {
                $tag = tag::create([
                        'name' => $t_name,
                        'slug' => $slug
                    ]);
            }
            $tag_ids  [] = $tag->id;
        }

        $product->tags()->sync($tag_ids);
        return redirect()->route('dashboard.products.index')
        ->with('success', 'product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
