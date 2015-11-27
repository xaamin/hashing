<?php namespace Itnovado\Hashing;

use Itnovado\Hashing\Strategies\BcryptHasher;
use Itnovado\Hashing\Contracts\HasherInterface;

class Hash
{
    /**
     * Class constructor
     * 
     * @param Itnovado\Hashing\Contracts\HasherInterface|null $hasher
     */
    public function __construct(HasherInterface $hasher = null)
    {
        $hasher = $hasher ? : new BcryptHasher;

        $this->setHasher($hasher);
    }

    /**
     * Sets a hasher strategy
     * 
     * @param Itnovado\Hashing\Contracts\HasherInterface $hasher
     */
    public function setHasher(HasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * Get the hasher strategy used by this package
     * 
     * @return Itnovado\Hashing\Contracts\HasherInterface
     */
    public function getHasher()
    {
        return $this->hasher;
    }

    /**
     * Call missed methods
     * 
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->getHasher(), $method], $parameters);
    }
}
