<?php

namespace App\Transformers;

class CrcindTransformer
{    
    static function transform(object $data): object
    {
        $data = (array) $data;
        return (object)[
            'name' => $data['Name'],
            'img' => '',
            'type' => 'Personas',
            'source' => 'http://www.crcind.com/'
        ];
    }
}
