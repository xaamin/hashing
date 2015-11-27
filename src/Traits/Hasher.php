<?php namespace Itnovado\Hashing\Traits;

trait Hasher
{
    /**
     * The salt length.
     *
     * @var int
     */
    protected $saltLength = 22;

    /**
     * Create a random string for a salt.
     *
     * @return string
     */
    protected function createSalt()
    {
        if(function_exists('mcrypt_create_iv'))
        {
            return mcrypt_create_iv($this->saltLength, $this->getRandomizer());
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $this->saltLength);
    }

    /**
     * Get the most secure random number generator for the system.
     *
     * @return int
     */
    protected function getRandomizer()
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

    /**
     * Compares two strings using the same time whether they're equal or not.
     *
     * @param  string  $a
     * @param  string  $b
     * @return boolean
     */
    protected function safeHashComparison($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);

        for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) 
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }

        return $diff === 0;
    }
}
