<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'first_name' => ['required', 'string', 'max:120'],
                'last_name' => ['required', 'string', 'max:120'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone1' => ['required', 'numeric', 'digits_between:1,5'],
                'phone2' => ['required', 'numeric', 'digits_between:1,5'],
                'phone3' => ['required', 'numeric', 'digits_between:1,5'],
                'address' => ['required', 'string', 'max:120'],
                'building' => ['max:120'],
                'category_id' => ['required'],
                'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'first_name.string' => '姓を文字列で入力してください',
            'first_name.max' => '姓を255文字以下で入力してください',
            'last_name.required' => '名を入力してください',
            'last_name.string' => '名を文字列で入力してください',
            'last_name.max' => '名を255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'phone1.required' => '電話番号を入力してください',
            'phone1.numeric' => '電話番号を数値で入力してください',
            'phone1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'phone2.required' => '電話番号を入力してください',
            'phone2.numeric' => '電話番号を数値で入力してください',
            'phone2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'phone3.required' => '電話番号を入力してください',
            'phone3.numeric' => '電話番号を数値で入力してください',
            'phone3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '住所を文字列で入力してください',
            'address.max' => '住所を120文字以下で入力してください',
            'building.max' => '建物名を255文字以下で入力してください',
            'category_id.required'=> 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以下で入力してください',
        ];
    }
}
