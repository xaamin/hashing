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

The Hasher uses the Bcrypt hashing algorithm. It is a safe algorithm to use, however this hasher has been deprecated in favor of the native hasher as it provides a uniform API to whatever the chosen hashing strategy of the day is.

```
   Hash::setHasher(new Xaamin\Hashing\Strategies\NativeHash);

```