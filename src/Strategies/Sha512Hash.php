<?php 
namespace Xaamin\Hashing\Strategies;

use Xaamin\Hashing\Random;
use Xaamin\Hashing\Traits\Hasher;
use Xaamin\Hashing\Contracts\HashInterface;

class Sha512Hash implements HashInterface
{
    use Hasher;

    /**
     * {@inheritDoc}
     */
    public function make($value)
    {
        $salt = Random::string($this->saltLength);

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
