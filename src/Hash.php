<?php 
namespace Xaamin\Hashing;

use Xaamin\Hashing\Strategies\BcryptHash;
use Xaamin\Hashing\Strategies\NativeHash;
use Xaamin\Hashing\Contracts\HashInterface;

class Hash
{
    /**
     * Hasher strategy instance
     * 
     * @var \Xaamin\Hashing\Contracts\HasherInterface
     */
    protected static $hasher;

    /**
     * Sets a hasher strategy
     * 
     * @param Xaamin\Hashing\Contracts\HasherInterface $hasher
     */
    public static function setHasher(HashInterface $hasher)
    {
        static::$hasher = $hasher;
    }

    /**
     * Get the hasher strategy used by this package
     * 
     * @return Xaamin\Hashing\Contracts\HasherInterface
     */
    public static function getHasher()
    {
        if (!static::$hasher) { 
            if (function_exists('password_hash')) {
                static::setHasher(new NativeHash);
            } else {
                static::setHasher(new BcryptHash);
            }
            
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
