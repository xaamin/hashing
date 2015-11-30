# Password Hasher


### Installation

Require the package using composer

``` 
    composer require xaamin/hashing
```

### Usage

You may hash a password by calling the make method on Hash instance

```
    use Xaamin\Hashing\Hash;
    
    $password' => Hash::make('plain-text');

```

The check method allows you to verify that a given plain-text string corresponds to a given hash. 

```
    if (Hash::check('plain-text', $hashedValue)) 
    {
        // The passwords match...
    }

```

By defautl this package uses the default PHP native hash implementation, it's the most secure way to hashing passwords and requires PHP 5 >= 5.5.0. Anyway, if you have PHP 5 < 5.5.0 you can use Bcrypt hashing algorithm. I suggest enable mcrypt or openssl PHP extension to generate secure random salt.

```
   Hash::setHasher(new Xaamin\Hashing\Strategies\BcryptHash);

```