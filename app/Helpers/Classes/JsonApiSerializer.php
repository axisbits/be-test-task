<?php

namespace App\Helpers\Classes;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer;

class JsonApiSerializer extends DataArraySerializer
{
    /**
     * @param PaginatorInterface $paginator
     *
     * @return array<string,array<string,int>>
     */
    public function paginator(PaginatorInterface $paginator): array
    {
        return [
            'pagination' => [
                'current_page' => (int) $paginator->getCurrentPage(),
                'last_page' => (int) $paginator->getLastPage(),
                'per_page' => (int) $paginator->getPerPage(),
                'total' => (int) $paginator->getTotal(),
            ],
        ];
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array<mixed,mixed> $data
     *
     * @return array<mixed,mixed>
     */
    public function item($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array<mixed,mixed> $data
     *
     * @return array<mixed,mixed>
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize null resource.
     *
     * @return array<mixed,mixed>
     */
    public function null(): null|array
    {
        return null;
    }
}
