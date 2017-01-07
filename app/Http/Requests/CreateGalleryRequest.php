<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGalleryRequest extends FormRequest
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
            'img' => 'required_without:vid|empty_when:vid|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vid' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/3gpp',
        ];
    }
}
