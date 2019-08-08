<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sale_price' => 'required|numeric',
            'quantity' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'list_image' => 'required',
            'user_id' => 'required',
            'store_id' => 'required',
            'on_sale' => 'numeric'
         ];
    }

}
