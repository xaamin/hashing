<?php namespace Itnovado\Hashing;

use Itnovado\Hashing\Strategies\BcryptHasher;
use Itnovado\Hashing\Contracts\HasherInterface;

class Hash
{
    /**
     * Sets a hasher strategy
     * 
     * @param Itnovado\Hashing\Contracts\HasherInterface $hasher
     */
    public static function setHasher(HasherInterface $hasher)
    {
        static::$hasher = $hasher;
    }

    /**
     * Get the hasher strategy used by this package
     * 
     * @return Itnovado\Hashing\Contracts\HasherInterface
     */
    public function getHasher()
    {
        if!(static::$hasher)
        {
            $this->setHasher(new BcryptHasher;);
        }

        return static::$hasher;
    }

    /**
     * Call missed methods
     * 
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __callStatic($method, $parameters)
    {
        return call_user_func_array([static::$getHasher(), $method], $parameters);
    }
}
