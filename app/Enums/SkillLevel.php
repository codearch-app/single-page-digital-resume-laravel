<?php

declare(strict_types=1);

namespace App\Enums;

enum SkillLevel: string
{
    case Beginner     = 'beginner';
    case Intermediate = 'intermediate';
    case Advanced     = 'advanced';
    case Expert       = 'expert';

    public static function fromString(string $level): ?SkillLevel
    {
        return match (strtolower($level)) {
            'beginner', 'novice', 'junior' => self::Beginner,
            'intermediate', 'mid-level'    => self::Intermediate,
            'advanced', 'senior'           => self::Advanced,
            'expert', 'master'             => self::Expert,
            default                        => null,
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::Beginner     => 'Beginner',
            self::Intermediate => 'Intermediate',
            self::Advanced     => 'Advanced',
            self::Expert       => 'Expert',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Beginner     => 'bg-gradient-to-r from-green-500 to-emerald-500',
            self::Intermediate => 'bg-gradient-to-r from-blue-500 to-cyan-500',
            self::Advanced     => 'bg-gradient-to-r from-purple-500 to-indigo-500',
            self::Expert       => 'bg-gradient-to-r from-orange-500 to-red-500',
        };
    }
}
