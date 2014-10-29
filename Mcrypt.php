<?php
/**
 * @author Alex Liebscher <alexliebscher@gmail.com>
 * @uses McryptResource.php Unless autoloading, this file must be included
 */
require 'McryptResource.php';

/**
 * Mcrypt encryption container
 *
 * @author Alex Liebscher <alexliebscher@gmail.com> 
 * @version 1.0.0
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
class Mcrypt {
    /**
     * Encrypt data using an McryptResource and a key
     * 
     * @param McryptResource $source Initialized resource to encrypt with
     * @param string $key Key to encrypt data with
     * @param string $data Data to encrypt
     * @uses Mcrypt::newSalt Creates a new salt to hash the key
     * @uses Mcrypt::newIV Creates a new IV for encryption
     * @uses Mcrypt::newKey Create a hashed key based on the user-supplied key and the new salt
     * @uses mcrypt_generic Encrypts the data
     * @return string Released ciphertext. Suitable for storage
     */
    public static function encrypt(McryptResource $source, $key, $data) {

        $salt = static::newSalt($source);
        $iv = static::newIV($source);

        mcrypt_generic_init($source->getResource(), static::newKey($source, $key, $salt), $iv);

        $ciphertext = mcrypt_generic($source->getResource(), $data);

        $source->freeResource();

        return base64_encode($salt . $iv . $ciphertext);
    }

    /**
     * Decrypt data using an McryptResource and a key
     * 
     * @param McryptResource $source Initialized resource to decrypt with
     * @param string $key The key used to encrypt the data
     * @param string $ciphertext Encrypted data to decrypt
     * @uses Mcrypt::getResourceParts Break apart the ciphertext into usable parts
     * @uses Mcrypt::newKey Create a hashed key based on the user-supplied key and the new salt
     * @uses mdecrypt_generic Decrypts the data
     * @return string Decrypted plaintext
     */
    public static function decrypt(McryptResource $source, $key, $ciphertext) {

        $parts = static::getResourceParts($source, base64_decode($ciphertext));

        mcrypt_generic_init($source->getResource(), static::newKey($source, $key, $parts['salt']), $parts['iv']);

        $plaintext = mdecrypt_generic($source->getResource(), $parts['data']);

        $source->freeResource();

        return $plaintext;
    }

    /**
     * Break apart ciphertext into the key's salt, the IV, and the actual data
     * 
     * @param McryptResource $resource Initialized resource to reference
     * @param string $ciphertext Ciphertext to break apart
     * @return array Parts of ciphertext needed to decrypt
     */
    protected static function getResourceParts(McryptResource $resource, $ciphertext) {
        return [
            'salt' => substr($ciphertext, 0, $resource->getKeySize()),
            'iv' => substr($ciphertext, $resource->getKeySize(), $resource->getIVSize()),
            'data' => substr($ciphertext, $resource->getKeySize() + $resource->getIVSize())
        ];
    }

    /**
     * Create a new salt to hash the key
     * 
     * @param McryptResource $resource Initialized resource to reference
     * @uses openssl_random_pseudo_bytes Utilize PHP's CSPRNG
     * @return string New salt
     */
    protected static function newSalt(McryptResource $resource) {
        return openssl_random_pseudo_bytes($resource->getKeySize());
    }

    /**
     * Hash the user-supplied key to generate a new key
     * 
     * @param McryptResource $resource Initialized resource to reference
     * @param string $key User-supplied key
     * @param string $salt Random salt
     * @uses crypt Crypographically secure hash using SHA-256
     * @return string New key as long as the encryption methods allowed key size
     */
    protected static function newKey(McryptResource $resource, $key, $salt) {
        $hashed = hash('SHA256', $key . $salt);

        return substr($hashed, 0, $resource->getKeySize());
    }

    /**
     * Create a cryptographically secure initialization vector
     * 
     * @param McryptResource $resource Initialized resource to reference
     * @uses mcrypt_create_iv Create and IV using MCRYPT_DEV_URANDOM 
     * @return string New initialization vector
     */
    protected static function newIV(McryptResource $resource) {
        return mcrypt_create_iv($resource->getIVSize(), MCRYPT_DEV_URANDOM);
    }

}
