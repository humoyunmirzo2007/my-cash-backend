<?php

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

if (!function_exists("getPagination")) {

    function getPagination($collection): array
    {
        $paginator = $collection instanceof AnonymousResourceCollection
            ? $collection->resource
            : $collection;

        return [
            "links" => [
                "first" => $paginator->url(1),
                "last" => $paginator->url($paginator->lastPage()),
                "prev" => $paginator->previousPageUrl(),
                "next" => $paginator->nextPageUrl(),
            ],
            "meta" => [
                "current_page" => $paginator->currentPage(),
                "from" => $paginator->firstItem(),
                "path" => $paginator->path(),
                "per_page" => $paginator->perPage(),
                "to" => $paginator->lastItem(),
                "last_page" => $paginator->lastPage(),
            ]
        ];
    }
}
