<?php

namespace App\Providers\Customs;

use Illuminate\Support\Facades\Input;

class GalleryValidator
{
    public function validateEmptyWhen($attribute, $value, $parameters)
    {

        foreach ($parameters as $key)
        {
            if ( ! empty(Input::file($key)))
            {
                return false;
            }
        }

        return true;

    }
}
