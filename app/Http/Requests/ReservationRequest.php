<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reservation.parking_lot_id' => ['required', Rule::exists('parking_lots', 'id')],
            'reservation.picture' => ['required'],
            'reservation.from' => ['required', 'date'],
            'reservation.to' => ['nullable'],
        ];
    }
}
