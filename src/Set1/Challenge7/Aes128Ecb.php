<?php
/*
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Welhott\Cryptopals\Set1\Challenge7;

/**
 * Class Challenge7
 * @package Welhott\Cryptopals\Set1
 */
class Aes128Ecb
{
    /**
     * Encrypt a message using the OpenSSL library and AES-128-ECB algo.
     *
     * @param string $message The message to encrypt.
     * @param string $key The key to encrypt the message with.
     *
     * @return string The encrypted message or empty on failure.
     */
    public static function decrypt(string $message, string $key) : string
    {
        return openssl_decrypt($message, 'AES-128-ECB', $key, OPENSSL_RAW_DATA + OPENSSL_ZERO_PADDING);
    }

    /**
     * Decrypt a message using the OpenSSL library and AES-128-ECB algo.
     *
     * @param string $message The message to decrypt.
     * @param string $key The key to decrypt the message with.
     *
     * @return string The decrypted message or empty on failure.
     */
    public static function encrypt(string $message, string $key) : string
    {
        return openssl_encrypt($message, 'AES-128-ECB', $key, OPENSSL_RAW_DATA + OPENSSL_ZERO_PADDING);
    }
}
