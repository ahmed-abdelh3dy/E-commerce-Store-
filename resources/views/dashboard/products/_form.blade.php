

<div class="form-group">
    <x-form.input label="Product Name" name="name" :value="$product->name"/>
</div>

<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Select Category</option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{$category->id}}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$product->description"/>
</div>

<div class="form-group">
    <x-form.label for="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" class="form-control"/>
    @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="" height="100">
    @endif
</div>

<div class="form-group">
    <x-form.input label="Price" name="price" :value="$product->price" />
</div>

<div class="form-group">
    <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
</div>

<div class="form-group">
    <x-form.input label="Tags" name="tags" :value="$tags" />
</div>

<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :value="$product->status" :options="['active' => 'active','draft'=> 'draft', 'archived' => 'archived']" />
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$buton_lable ?? 'Save'}}</button>
</div>
