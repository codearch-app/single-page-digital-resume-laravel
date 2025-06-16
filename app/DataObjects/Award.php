<?php

declare(strict_types=1);

namespace App\DataObjects;

use Carbon\Carbon;

readonly class Award
{
    public function __construct(
        public string $title = '',
        public ?Carbon $date = null,
        public string $awarder = '',
        public string $summary = ''
    ) {
    }

    public static function fromArray(array $data): self
    {
        $date = isset($data['date']) ? Carbon::parse($data['date']) : null;

        return new self(
            title: $data['title'] ?? '',
            date: $date,
            awarder: $data['awarder'] ?? '',
            summary: $data['summary'] ?? ''
        );
    }
} 