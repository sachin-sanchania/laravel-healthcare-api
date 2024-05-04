<?php

if (! function_exists('error_processor')) {
    function error_processor($validator): array
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $err_keeper[] = ['name' => $index, 'message' => $error[0]];
        }
        return $err_keeper;
    }
}
