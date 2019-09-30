<?php

declare(strict_types=1);

if (!function_exists('memory_limit')) {
    function memory_limit(): string
    {
        return trim(ini_get('memory_limit'));
    }
}

if (!function_exists('memory_limit_bytes')) {
    function memory_limit_bytes(): int
    {
        $memoryLimit = trim(ini_get('memory_limit'));

        if ('-1' === $memoryLimit) {
            return -1;
        }
        $memoryLimit = strtolower($memoryLimit);
        $max = strtolower(ltrim($memoryLimit, '+'));
        if (0 === strpos($max, '0x')) {
            $max = \intval($max, 16);
        } elseif (0 === strpos($max, '0')) {
            $max = \intval($max, 8);
        } else {
            $max = (int) $max;
        }
        switch (substr($memoryLimit, -1)) {
            case 't': $max *= 1024;
            case 'g': $max *= 1024;
            case 'm': $max *= 1024;
            case 'k': $max *= 1024;
        }
        return $max;
    }
}
