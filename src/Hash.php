<?php namespace Itnovado\Hashing;

use Itnovado\Hashing\Strategies\NativeHash;
use Itnovado\Hashing\Contracts\HashInterface;

class Hash
{
    /**
     * Hasher strategy instance
     * 
     * @var \Itnovado\Hashing\Contracts\HasherInterface
     */
    protected static $hasher;

    /**
     * Sets a hasher strategy
     * 
     * @param Itnovado\Hashing\Contracts\HasherInterface $hasher
     */
    public static function setHasher(HashInterface $hasher)
    {
        static::$hasher = $hasher;
    }

    /**
     * Get the hasher strategy used by this package
     * 
     * @return Itnovado\Hashing\Contracts\HasherInterface
     */
    public static function getHasher()
    {
        if(!static::$hasher)
        {
            static::setHasher(new NativeHash);
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
    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array([static::getHasher(), $method], $parameters);
    }
}
