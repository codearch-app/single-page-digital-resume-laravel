<?php

declare(strict_types=1);

namespace App\DataObjects;

use Carbon\Carbon;

readonly class Project
{
    /**
     * @param array<string> $highlights
     */
    public function __construct(
        public string  $name = '',
        public ?Carbon $startDate = null,
        public ?Carbon $endDate = null,
        public string  $description = '',
        public array   $highlights = [],
        public string  $url = ''
    ) {
    }

    public static function fromArray(array $data): self
    {
        $startDate = isset($data['startDate']) ? Carbon::parse($data['startDate']) : null;
        $endDate   = isset($data['endDate']) ? Carbon::parse($data['endDate']) : null;

        return new self(
            name:        $data['name'] ?? '',
            startDate:   $startDate,
            endDate:     $endDate,
            description: $data['description'] ?? '',
            highlights:  $data['highlights'] ?? [],
            url:         $data['url'] ?? ''
        );
    }
}
