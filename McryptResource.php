<?php
/**
 * @author Alex Liebscher <alexliebscher@gmail.com>
 */

/**
 * Resource container for Mcrypt encryption
 *
 * @author Alex Liebscher <alexliebscher@gmail.com>
 * @version 1.0.0
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
class McryptResource {

    /**
     *
     * @var resource Encryption descriptor 
     */
    private $resource;

    /**
     *
     * @var string One of the MCRYPT_* ciphers
     */
    protected $cipher;

    /**
     *
     * @var string One of the MCRYPT_MODE_* modes
     */
    protected $mode;

    /**
     *
     * @var int Size of the initialization vector
     */
    protected $ivSize;

    /**
     *
     * @var int Size of the encryption key
     */
    protected $keySize;

    /**
     * Get the current encryption descriptor 
     * 
     * @since 1.0.0
     * @return resource Encryption descriptor
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * Create a new mcrypt module
     * 
     * @since 1.0.0
     * @param string $cipher Cipher to use
     * @param string $mode Mode to use
     * @throws InvalidArgumentException
     * @return void
     */
    public function createResource($cipher, $mode) {
        if (!in_array($cipher, mcrypt_list_algorithms())) {
            throw new InvalidArgumentException('Algorithm not supported.');
        }
        if (!in_array($mode, mcrypt_list_modes())) {
            throw new InvalidArgumentException('Mode not supported.');
        }
        $this->resource = mcrypt_module_open($cipher, '', $mode, '');
        $this->ivSize = mcrypt_enc_get_iv_size($this->resource);
        $this->keySize = mcrypt_enc_get_key_size($this->resource);
    }

    /**
     * Close the current resource
     * 
     * @since 1.0.0
     * @return void
     */
    public function freeResource() {
        if (isset($this->resource)) {
            mcrypt_generic_deinit($this->resource);
            mcrypt_module_close($this->resource);
        }
    }

    /**
     * Get the current key size
     * 
     * @since 1.0.0
     * @return int Key size
     */
    public function getKeySize() {
        return $this->keySize;
    }

    /**
     * Get the current IV size
     * 
     * @since 1.0.0
     * @return int IV size
     */
    public function getIVSize() {
        return $this->ivSize;
    }

    /**
     * Use createResource() instead to make a new resource
     * 
     * @since 1.0.0
     * @throws Exception
     * @return void
     */
    public function __clone() {
        throw new Exception('Clone not possible.');
    }

}
