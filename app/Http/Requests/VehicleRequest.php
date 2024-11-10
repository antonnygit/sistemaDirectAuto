<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VehicleRequest extends FormRequest
{
    protected $colors = "vermelho,azul,branco,rosa,roxo,preto,cinza,prata,amarelo,marrom,laranja";

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
        // PRECISA VALIDAR IMAGEM QUANDO IMPLEMENTAR IMAGEM
        return [
            'release_model' => 'required|date_format:Y|before_or_equal:' . date('Y'),
            'release_year' => 'required|date_format:Y|before_or_equal:' . date('Y'),
            'color' => 'required|string|in:' . $this->colors,
            'km' => 'integer|min:0',
            'description' => 'string',
            'price' => 'required|float|min:0',
            'brand_id' => 'required|integer|exists:brands,id',
            'status_id' => 'required|integer|exists:vehicle_status,id'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]
        ));
    }

    public function messages(): array
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "string" => "O campo :attribute deve possuir texto",
            "max" => "O campo :attribute deve possuir no máximo 255 caracteres",
            "date_format" => "O campo :attribute deve possuir uma data válida",
            "color.in" => "O campo :attribute possui uma cor inválida",
            "float" => "O campo :attribute possui um valor inválido",
            "price.min" => "O campo valor deve possuir um valor igual ou maior que 0",
            "integer" => "O campo :attribute deve possuir apenas número inteiro",
            "brand_id" => "A marca selecionada não existe",
            "status_id" => "O status do veículo não existe"
        ];
    }
}
