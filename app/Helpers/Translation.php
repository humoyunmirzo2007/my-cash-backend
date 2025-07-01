<?php

if (!function_exists("t")) {
    function t(string $key, ?string $itemKey, array $replace = [], ?string $filename = "messages"): string
    {
        if ($itemKey) {
            $replace["item"] = __("$filename.$itemKey");
        }

        return __("$filename.$key", $replace);
    }
}
