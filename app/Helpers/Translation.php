<?php

function t(string $key, string $filename = "messages", array $replace = []): string
{
    if (isset($replace[0])) {
        $replace = ["item" => __("attributes." . $replace[0])];
    }

    return __("$filename.$key", $replace);
}
