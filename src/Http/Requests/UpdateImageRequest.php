<?php

namespace Piboutique\SimpleCMS\Http\Requests;

/**
 * Class StoreImageRequest
 * @package App\Http\Requests
 */
class UpdateImageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //todo only admin users
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
            'title' => 'string',
            'alt' => 'string',
            'description' => 'string'
        ];
    }
}
