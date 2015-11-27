<?php namespace Itnovado\Hashing\Strategies;

use Itnovado\Hashing\Traits\Hasher;
use Itnovado\Hashing\Contracts\HasherInterface;

class BcryptHasher implements HasherInterface
{
    use Hasher;

    /**
     * The hash strength.
     *
     * @var int
     */
    public $strength = 10;

    /**
     * {@inheritDoc}
     */
    public function hash($value)
    {
        $salt = $this->createSalt();

        // Prefix "$2y$" fixes blowfish weakness
        $prefix = '$2y$';

        return crypt($value, $prefix.$this->strength.'$'.$salt.'$');
    }

    /**
     * {@inheritDoc}
     */
    public function check($value, $hashedValue)
    {
        return $this->safeHashComparison(crypt($value, $hashedValue), $hashedValue);
    }
}
