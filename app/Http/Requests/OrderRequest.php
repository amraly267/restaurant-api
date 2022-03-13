<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'reservation_id' => 'required|exists:reservations,id',
            'meals' => 'required|array',
            'meals.*' => 'required|exists:meals,id',
            'waiter_id' => 'required|integer',
        ];
    }
}
