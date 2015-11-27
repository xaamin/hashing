<?php namespace Itnovado\Hashing\Strategies;

use Itnovado\Hashing\Traits\Hasher;
use Itnovado\Hashing\Contracts\HasherInterface;

class Sha512Hasher implements HasherInterface
{
    use Hasher;

    /**
     * {@inheritDoc}
     */
    public function hash($value)
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
