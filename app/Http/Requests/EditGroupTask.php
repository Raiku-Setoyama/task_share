<?php

namespace App\Http\Requests;

use App\GroupTask;
use Illuminate\Validation\Rule;

class EditGroupTask extends CreateGroupTask
{
    public function rules()
    {

        $status_rule = Rule::in(array_keys(GroupTask::STATUS));

        return [

            'title' => 'required|max:100',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|' . $status_rule,
            
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, GroupTask::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}