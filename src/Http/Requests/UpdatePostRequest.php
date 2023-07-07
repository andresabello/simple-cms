<?php

namespace Piboutique\SimpleCMS\Http\Requests;

class UpdatePostRequest extends Request
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
            'title' => 'required',
            'body' => 'sometimes|string',
            'excerpt' => 'sometimes|string',
            'published_at' => 'date',
        ];
    }
}
