<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory , SoftDeletes ;
    
    protected $fillable=([
        'name' , 'image','slug' ,'status', 'description', 'parent_id'
    ]);

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function parent(){
        return $this->belongsTo(category::class , 'parent_id' , 'id')
        ->withDefault([
            'name' => 'main Category'
        ]);
    }

    public function children(){
        return $this->hasMany(category::class , 'parent_id' , 'id');
    }

    public function scopefilter(Builder $builder, $filter)
    {
        // if($name = $request->query('name')){
        //     $query->where('name' , 'LIKE' ,$name);
        // }
        if ($filter['status'] ?? false) {
            $builder->where('categories.status', '=', $filter['status']);
        }
    }


    public static function rules($id = 0 )

    {
        return [
            // 'name' => [
            //     'required|string|min:3|max:255',
            //     "unique:categories,name,$id",
            //     function ($attribute, $value, $fails) {
            //         if (strtolower($value) === 'laravel') {
            //             $fails('The ' . $attribute . ' is not allowed to contain the word "laravel". Please choose another name.');
            //         }
            //     }
            // ],
            // // Rule::unique('categories' , 'name')->ignore("$id"),
            'name' => [
            'required',
            'string',
            'min:3',
            'max:255',
            "unique:categories,name,$id",
            // function ($attribute, $value, $fails) {
            //     if (strtolower($value) === 'laravel') {
            //         $fails('The ' . $attribute . ' is not allowed to contain the word "laravel". Please choose another name.');
            //     }
            // },
            // new Filter(['php','laravel','root','html']),
            'Filter:php,html',
        ],
            'parent__id' => 'int|exists:categories,id',
            'status' => 'in:active,archived',
            'image' => 'image|max:1048576|dimensions:min_width=100,min_height=100'
        ];
    }
}
