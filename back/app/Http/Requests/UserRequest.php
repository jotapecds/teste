<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;


class UserRequest extends FormRequest
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
        if($this->isMethod('POST')) {
            return [
                'name' => 'required|string',
                'birth_date' => 'required|string',
                'phone_number' => 'celular_com_ddd',
                'gender' => 'required|string|max:1',
                'email' => 'required|email|unique:Users,email',
                'password' => 'required',
                'is_admin' => 'required|boolean|digits:1',
            ];
        }
        if($this->isMethod('PUT')) {
            return [
                'name' => 'string',
                'phone_number' => 'string',
                'gender' => 'string|max:1'
            ];
        }
    }

    public function messages() 
    {
        return [
            'name.required' => 'O nome não pode ser nulo',
            'birth_date.required' => 'A data de nascimento não pode ser nula',
            'phone_number.celular_com_ddd' => 'O formato do número de telefone está incorreto',
            'gender.required' => 'O gênero não pode ser nulo',
            'gender.max' => 'O gênero recebe apenas 1 caractere',
            'email.required' => 'O email não pode ser nulo',
            'email.email' => 'O email está no formato errado',
            'email.unique' => 'Esse email já existe na base de dados',
            'password.required' => 'A senha não pode ser nula',
            'is_admin.required' => 'O atributo is_admin não pode ser nulo',
            'is_admin.boolean' => 'O atributo is_admin tem que ter um valor booleano',
            'is_admin.digits' => 'O atributo is_admin recebe apenas 0 (false) ou 1 (true)'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

}
