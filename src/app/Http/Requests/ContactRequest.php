<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContactRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'regex:/^[0-9]+$/', 'digits_between:2,5'],
            'tel2' => ['required', 'regex:/^[0-9]+$/', 'digits_between:2,5'],
            'tel3' => ['required', 'regex:/^[0-9]+$/', 'digits_between:2,5'],
            'address' => ['required'],
            'category_id' => ['required'],
            'content' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '2. 姓を入力してください',
            'first_name.required' => '3. 名を入力してください',

            'gender.required' => '1．性別を選択してください',

            'email.required' => '1．メールアドレスを入力してください',
            'email.email' => '2．メールアドレスはメール形式で入力してください',

            'tel.required' => '1．電話番号を入力してください',
            'tel.regex' => '2.電話番号は 半角英数字で入力してください',
            'tel.max' => '3.電話番号は 5桁まで数字で入力してください',

            'address.required' => '1．住所を入力してください',

            'category_id.required' => '1．お問い合わせの種類を選択してください',

            'content.required' => '1．お問い合わせ内容を入力してください',
            'content.max' => '2．お問い合わせ内容は120文字以内で入力してください'
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (
                empty($this->last_name) &&
                empty($this->first_name)
            ) {
                $validator->errors()->add('name', '1. お名前を入力してください');
            }

            if (
                $validator->errors()->has('tel1') ||
                $validator->errors()->has('tel2') ||
                $validator->errors()->has('tel3')
            ) {
                if (empty($this->tel1) || empty($this->tel2) || empty($this->tel3)) {
                    $validator->errors()->add('tel', '1．電話番号を入力してください');
                    return;
                }

                if (
                    !preg_match('/^[0-9]+$/', (string)$this->tel1) ||
                    !preg_match('/^[0-9]+$/', (string)$this->tel2) ||
                    !preg_match('/^[0-9]+$/', (string)$this->tel3)
                ) {
                    $validator->errors()->add('tel', '2．電話番号は 半角英数字で入力してください');
                    return;
                }

                $len1 = strlen((string)$this->tel1);
                $len2 = strlen((string)$this->tel2);
                $len3 = strlen((string)$this->tel3);

                if ($len1 < 2 || $len1 > 5 || $len2 < 2 || $len2 > 5 || $len3 < 2 || $len3 > 5) {
                    $validator->errors()->add('tel', '3．電話番号は 5桁まで数字で入力してください');
                    return;
                }
            }
        });
    }
}
