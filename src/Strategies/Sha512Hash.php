<?php namespace Itnovado\Hashing\Strategies;

use Itnovado\Hashing\Traits\Hasher;
use Itnovado\Hashing\Contracts\HashInterface;

class Sha512Hash implements HasherInterface
{
    use Hasher;

    /**
     * {@inheritDoc}
     */
    public function make($value)
    {
        $salt = $this->createSalt();

        return $salt.hash('sha512', $salt.$value);
    }

    /**
     * {@inheritDoc}
     */
    public function check($value, $hashedValue)
    {
        $salt = substr($hashedValue, 0, $this->saltLength);

        return $this->safeHashComparison($salt.hash('sha512', $salt.$value), $hashedValue);
    }
}
