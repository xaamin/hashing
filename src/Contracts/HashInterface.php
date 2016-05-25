<?php 
namespace Xaamin\Hashing\Contracts;

interface HashInterface
{
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @return string
     * @throws \RuntimeException
     */
    public function make($value);

    /**
     * Checks the string against the hashed value.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     */
    public function check($value, $hashedValue);
}
