<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if(Gate::denies('categories.view')){
            abort(403);
        }

        $categories = category::with('parent')
        // leftJoin('categories as parents',  'parents.id' , '=', 'categories.parent_id')
        // ->select(['categories.*', 'parents.name as parent_name'])
        // ->select('categories.*')
        // ->selectRaw(('(select count(*) from products where category_id = categories.id) as products_number '))
        ->withCount([
            'products' => function ($query) {
                $query->where('status', '=', 'active');
            }
        ])
            ->orderby('categories.name')
            ->filter($request->query())->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('categories.create');
        $parents =category::all();
        $categories = new category();
        return view('dashboard.categories.create',compact('categories','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('categories.create');
        // $request->validate(category::rules(),[
        //     'unique' => ' write new name ',
        // ]);

        $request ->merge([
            'slug'=>str::slug($request->post('name'))
        ]);

        $data =$request ->except('image');


        // if($request->hasFile('image')){
        //     $file = $request->file('image');
        //     $path = $file->store('categories','public');
        //     $data ['image'] = $path;
        //             }

        $data['image'] = $this->uploadimage($request);
                    


      
        $category =category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        Gate::authorize('categories.view');
        return view('dashboard.categories.show', [
           'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('categories.update');
        
        $parents = category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                ->orwhere('parent_id', '<>', $id);
            })->get();
        $categories = category::findorfail($id);
        return view('dashboard.categories.edit', compact('categories', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,  $id)
    {
        Gate::authorize('categories.update');
        $categories = category::findorfail($id);

        // $request->validate(category::rules($id));

        $old_image = $categories->image;
        $data = $request->except('image');


        
            $data['image'] = $this->uploadimage($request);
        
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }


        $categories->update($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('categories.destroy');
        // category::destroy($id);


        $categories = category::findorfail($id);
        $categories->delete();
        if($categories->image){
            storage::disk('public')->delete($categories->image);
        }


        return redirect()->route('dashboard.categories.index');
    }

    protected function uploadimage(Request $request){
        if (!$request->hasFile('image')) {
            return ;

        }
            $file = $request->file('image');
            $path = $file->store('categories', 'public');
            return $path;
        
    }

    public function trash()
    {
        $categories = category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $categories = category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', ' success restore');
    }


    public function forceDelete($id)
    {
        $categories = category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();
        return redirect()->route('dashboard.categories.trash')->with('success', ' category deleted  forever');
    }
}
