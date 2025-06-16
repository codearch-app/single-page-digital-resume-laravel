<?php

declare(strict_types=1);

namespace App\DataObjects;

readonly class Reference
{
    public function __construct(
        public string $name = '',
        public string $reference = ''
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name:      $data['name'] ?? '',
            reference: $data['reference'] ?? ''
        );
    }
}
