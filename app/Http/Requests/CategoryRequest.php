<?php

namespace App\Http\Requests;

use App\Models\category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::authorize('categories.create') || Gate::authorize('categories.update') ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id =$this->route('category');

        return category::rules($id);
    }

    public function messages()
    {
        return[
        //   'unique' => ' write new name ',
        ];
    }
}
