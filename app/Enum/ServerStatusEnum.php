<?php
declare(strict_types=1);

namespace App\Enum;

enum ServerStatusEnum: string
{
    case ACTIVE = 'active';
    case STOPPED = 'stopped';
    case TERMINATED = 'terminated';
    case PENDING = 'pending';
    case SCHEDULED = 'scheduled';
    case EXPIRED = 'expired';

    public function toString(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::STOPPED => 'Stopped',
            self::TERMINATED => 'Terminated',
            self::PENDING => 'Pending',
            self::SCHEDULED => 'Scheduled',
            self::EXPIRED => 'Expired',
        };
    }

}
