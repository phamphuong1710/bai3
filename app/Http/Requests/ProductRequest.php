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
            'sale_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'price' => 'required',
            'list_image' => 'required',
            'user_id' => 'required',
            'store_id' => 'required'
         ];
    }

    public function messages()
    {
        return [
            'logo_id.required' => 'Logo is required',
            'category_id.required' => 'Category is required',
            'name.required' => 'Name isrequired',
            'price.required' => 'Price is required',
            'sale_price.required' => 'Sale price is required',
            'quantity.required' => 'Quantity is required',
            'description.required' => 'Description required',
            'price.required' => 'Price is required',
            'list_image.required' => 'Image is required',
            'user_id.required' => 'required',
            'store_id.required' => 'required'
        ];
    }
}
