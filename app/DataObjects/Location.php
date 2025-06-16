<?php

declare(strict_types=1);

namespace App\DataObjects;

readonly class Location
{
    public function __construct(
        public string $address = '',
        public string $postalCode = '',
        public string $city = '',
        public string $countryCode = '',
        public string $region = ''
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            address:     $data['address'] ?? '',
            postalCode:  $data['postalCode'] ?? '',
            city:        $data['city'] ?? '',
            countryCode: $data['countryCode'] ?? '',
            region:      $data['region'] ?? ''
        );
    }
}
