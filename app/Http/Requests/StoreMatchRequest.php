<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchRequest extends FormRequest
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
            'played_at' => 'required|date_format:d/m/Y H:i',
            'home-team' => 'required|exists:teams,slug|different:away-team',
            'home-team-goals' => 'required|integer|min:0',
            'away-team' => 'required|exists:teams,slug',
            'away-team-goals' => 'required|integer|min:0',
            'tournament' => 'required|exists:tournaments,id',
        ];
    }
}
