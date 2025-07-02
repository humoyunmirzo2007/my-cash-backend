<?php

function t(string $key, string $filename = "messages", array $replace = []): string
{
    return __("$filename.$key", $replace);
}
