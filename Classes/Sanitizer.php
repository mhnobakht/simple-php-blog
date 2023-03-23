<?php

class Sanitizer {

    public static function sanitize($input) {

        $inputType = gettype($input);

        switch ($inputType) {

            case 'string':
                $sanitizedData = strip_tags($input);
                $sanitizedData = htmlspecialchars($sanitizedData);
                $sanitizedData = filter_var($sanitizedData, FILTER_SANITIZE_STRING);

                return $sanitizedData;
                break;
            case 'integer':
                $sanitizedData = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                return $sanitizedData;
                break;
            case 'array':
                $indexed = array_values($input) === $input;
                
                $sanitizedData = [];

                foreach($input as $key => $value) {
                    if($indexed) {

                        $sanitizedData[] = self::sanitize($value);

                    } else {

                        $sanitizedData[self::sanitize($key)] = self::sanitize($value);

                    }

                }

                return $sanitizedData;
                break;

        }

    }

}