<?php
declare(strict_types=1);

namespace App\Enum;

enum PromptsStatusEnum: string
{
    case YES = 'yes';
    case NO = 'no';

    public function toString(): string
    {
        return match ($this) {
            self::YES => 'Yes',
            self::NO => 'No',
        };
    }

    public function toInt(): int
    {
        return match ($this) {
            self::YES => 1,
            self::NO => 0,
        };
    }

}
