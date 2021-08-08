<?php

namespace App\Http\Requests;

use App\Models\UserAlert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserAlertRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_alert_edit');
    }

    public function rules()
    {
        return [];
    }
}
