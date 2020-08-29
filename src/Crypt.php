<?php

namespace Bone\Crypt;

class Crypt
{
    /** @var string $cipher */
    private $cipher = 'aes-128-gcm';

    /** @var int $options */
    private $options = 0;

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomBytes(int $length): string
    {
        $strong = false;

        do {
            $bytes = \openssl_random_pseudo_bytes($length, $strong);
        } while ($strong === false || $bytes === false);

        return $bytes;
    }

    /**
     * @param string $plaintext
     * @return array
     */
    public function encrypt(string $plaintext): array
    {
        $key = $this->generateRandomBytes(16);
        $ivLength = \openssl_cipher_iv_length($this->cipher);
        $iv = $this->generateRandomBytes($ivLength);
        $cipherText = \openssl_encrypt($plaintext, $this->cipher, $key, $this->options, $iv,$tag);

        return [
            'key' => \bin2hex($key),
            'iv' => \bin2hex($iv),
            'tag' => \bin2hex($tag),
            'ciphertext' => $cipherText,
        ];
    }

    /**
     * @param string $json
     * @param string $key
     * @return string
     */
    public function decrypt(string $json, string$key): string
    {
        $data = \json_decode($json);
        $result = \openssl_decrypt($data->ciphertext, $this->cipher, \hex2bin($key), $this->options, \hex2bin($data->iv), \hex2bin($data->tag));

        return $result;
    }
}
