<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionRequest extends Request
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
            'transaction_date' => 'required',
            'transaction_date_submit' => 'required|date',
            'payment_date_submit'   => 'date',
            'company_id'    => 'required|exists:companies,id',
            'category_id'   => 'required|exists:categories,id',
            'account_id'    => 'required|exists:accounts,id',
            'amount'        => 'required|min:0',
            'tax'           => 'numeric',
        ];
    }
}
