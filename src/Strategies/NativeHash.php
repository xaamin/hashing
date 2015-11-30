<?php namespace Itnovado\Hashing\Strategies;

use RuntimeException;
use Itnovado\Hashing\Contracts\HashInterface;

class NativeHash implements HashInterface
{
    /**
     * {@inheritDoc}
     */
    public function make($value)
    {
        if (!$hash = password_hash($value, PASSWORD_DEFAULT)) 
        {
            throw new RuntimeException('Error hashing value. You need PHP 5 >= 5.5.0. Check system compatibility with password_hash().');
        }

        return $hash;
    }

    /**
     * {@inheritDoc}
     */
    public function check($value, $hashedValue)
    {
        return password_verify($value, $hashedValue);
    }
}
