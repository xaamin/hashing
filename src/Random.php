<?php 
namespace Xaamin\Hashing;

class Random
{
    /**
     * Create a random string .
     * 
     * @param  int $length
     * @return string
     */
    public static function string($length)
    {
        if ($salt = static::openssl($length)) {
            return $salt;
        }

        if ($salt = static::mcrypt($length)) {
            return $salt;
        }

        return static::random($length);
    }

    /**
     * Open SSL random string generator
     * 
     * @param  int $length
     * @return string|null
     */
    protected static function openssl($length)
    {
        if(function_exists('openssl_random_pseudo_bytes'))
        {
            return substr(bin2hex(openssl_random_pseudo_bytes($length)), 0, $length);
        }

        return null;
    }

    /**
     * MCrypt random string generator
     * 
     * @param  int $length
     * @return string|null
     */
    protected static function mcrypt($length)
    {
        if(function_exists('mcrypt_create_iv'))
        {
            $salt = mcrypt_create_iv($length, static::getRandomizer());

            $salt = base64_encode($salt);
            $salt = substr(str_replace('+', '.', $salt), 0, $length);

            return $salt;
        }

        return null;
    }

    /**
     * Random string generator
     * 
     * @param  int $length
     * @return string
     */
    public function random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Get the most secure random number generator for the system.
     *
     * @return int
     */
    protected static function getRandomizer()
    {
        // There are various sources from which we can get random numbers
        // but some are more random than others. We'll choose the most
        // random source we can for this server environment.
        if (defined('MCRYPT_DEV_URANDOM'))
        {
            return MCRYPT_DEV_URANDOM;
        }
        elseif (defined('MCRYPT_DEV_RANDOM'))
        {
            return MCRYPT_DEV_RANDOM;
        }
        // When using the default random number generator, we'll seed
        // the generator on each call to ensure the results are as
        // random as we can possibly get them.
        else
        {
            mt_srand();

            return MCRYPT_RAND;
        }
    }
}
