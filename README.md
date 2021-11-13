# bone-crypt
![build status](https://github.com/delboy1978uk/bone-crypt/actions/workflows/master.yml/badge.svg) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bone-crypt/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bone-crypt/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bone-crypt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bone-crypt/?branch=master) <br />
An openssl based encryption/decryption class
## installation
Install via composer
```php
composer require delboy1978uk/bone-crypt
```
## usage
To encrypt and decrypt a value
```php
use Bone\Crypt\Crypt;

$crypt = new Crypt();

// returns array with key, IV, tag, and ciphertext
$encrypted = $crypt->encrypt('Super secret data'); 

// Take the key out of the array and json encode
$key = $encrypted['key'];
unset($encrypted['key']);

// this is your payload. Save the key somewhere!
$json = \json_encode($encrypted); 

// To decrypt
$result = $this->crypt->decrypt($json, $key); // 'Super secret data'
```
