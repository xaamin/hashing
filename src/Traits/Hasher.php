<?php 
namespace Xaamin\Hashing\Traits;

trait Hasher
{
    /**
     * The salt length.
     *
     * @var int
     */
    protected $saltLength = 22;

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
