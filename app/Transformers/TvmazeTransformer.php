<?php

namespace App\Transformers;

class TvmazeTransformer
{    
    static function transform(object $data): object
    {
        $img = '';

        if(isset($data->show->image->medium)){

            $img = $data->show->image->medium;

        }else if(isset($data->show->image->original)){

            $img = $data->show->image->original;
        }

        return (object)[
            'name' => $data->show->name,
            'img' => $img,
            'type' => 'Televisión',
            'source' => 'http://api.tvmaze.com/'
        ];
    }

}
