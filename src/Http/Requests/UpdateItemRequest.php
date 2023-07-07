<?php

namespace Piboutique\SimpleCMS\Http\Requests;

class UpdateItemRequest extends Request
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
            'url' => 'sometimes|string',
            'slug' => 'sometimes|string',
            'description' => 'sometimes|string',
            'client' => 'sometimes|string',
            'website' => 'sometimes|string',
            'image_id' => 'sometimes|string',
        ];
    }
}
