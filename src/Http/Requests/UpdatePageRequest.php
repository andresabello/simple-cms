<?php

namespace Piboutique\SimpleCMS\Http\Requests;

class UpdatePageRequest extends Request
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
            'title' => ['required'],
            'url' => ['unique:pages,url,' . $this->route('page')],
            'name' => ['unique:pages,name,' . $this->route('page')],
            'rows' => ['required'],
            'rows.*.columns' => ['required'],
            'rows.*.columns.*.content' => [
                'required_unless:rows.*.columns.*.type,image,rows.*.columns.*.type,video,rows.*.columns.*.type,code,rows.*.columns.*.type,slider,rows.*.columns.*.type,form',
            ],
            'rows.*.columns.*.image_id' => [
                'required_unless:rows.*.columns.*.type,content, rows.*.columns.*.type,video,video,rows.*.columns.*.type,code,rows.*.columns.*.type,slider,rows.*.columns.*.type,form',
            ],
            'rows.*.columns.*.video_id' => [
                'required_unless:rows.*.columns.*.type,content, rows.*.columns.*.type,image,video,rows.*.columns.*.type,code,rows.*.columns.*.type,slider,rows.*.columns.*.type,form'
            ],
        ];
    }
}
