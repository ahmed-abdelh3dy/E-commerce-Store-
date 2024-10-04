<?php

namespace App\Repositories\cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository{


    public function get() :Collection;

    public function update($id , $quantity);

    public function delete($id );

    public function add(Product $product );

    public function empty();

    public function total() :float ;
}