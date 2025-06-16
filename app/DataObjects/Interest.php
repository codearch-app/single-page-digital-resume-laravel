<?php

declare(strict_types=1);

namespace App\DataObjects;

readonly class Interest
{
    /**
     * @param array<string> $keywords
     */
    public function __construct(
        public string $name = '',
        public array  $keywords = []
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name:     $data['name'] ?? '',
            keywords: $data['keywords'] ?? []
        );
    }
}
