<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class UtilsHelper
{
    public static function validateFields(array $dataResponse, array $dataRequired)
    {
        foreach ($dataRequired as $item) {
            if (array_key_exists($item, $dataResponse)) {
               continue;
            }

            throw new \Exception(sprintf('Possível quebra de contrato, %s é obrigatório.', $item), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function onlyLetters(string $field): string
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', "", $field);
    }

    public static function onlyDigits(string $field): string
    {
        return preg_replace('/[^0-9]/', "", $field);
    }
}
