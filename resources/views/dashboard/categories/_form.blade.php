@if ($errors->any())
<div class="alert alert-danger">
    <h3>Eroores ocaured</h3>
    <ul>
    @foreach ($errors->all() as $error)
    
        <li>{{$error}}</li>
    
        
    @endforeach
</ul>
</div>
    
@endif
<div class="form-group">
    <x-form.input label="Category Name" type="text" name="name" value="{{ $categories->name }}" />
</div>

<div class="form-group">
    <label for="">category parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">category primary</option>
        @foreach ($parents as $parent)
            <option value="{{$parent->id  }}" @selected($categories->parent_id ==' parent_id')>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea t name="description"  :value="$categories->description"/>
</div>

<div class="form-group">
    <x-form.label for="image">image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" class="form-control"/>
    @if ($categories->image)
    <img src="{{ asset('storage/' . $categories->image) }}" alt="" height="100">
    @endif
</div>
<div class="form-group">
    <label for="">status</label>
    <div>
        <x-form.radio name="status" :value="$categories->status"  :options="['active' => 'active' , 'arcived' => 'arcived']" />
</div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$buton_lable ?? 'save'}}</button>
</div>