<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\FormRequest;

class CheckAvailabilityRequest extends FormRequest
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
            'date_time' => 'required|date_format:Y-m-d H:i',
            'table_id' => 'required|exists:tables,id',
        ];
    }
}
