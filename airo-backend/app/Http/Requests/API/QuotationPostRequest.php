<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\ValidationRules\Rules\Currency;
use Spatie\ValidationRules\Rules\Delimited;

class QuotationPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => ['required', (new Delimited('int|min:18|max:70'))->min(1)],
            'currency_id' => ['required', new Currency()],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d'],
        ];
    }
}
