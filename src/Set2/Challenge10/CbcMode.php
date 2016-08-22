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
namespace Welhott\Cryptopals\Set2\Challenge10;

use Welhott\Cryptopals\Set1\Challenge2\FixedXOR;
use Welhott\Cryptopals\Set1\Challenge7\Aes128Ecb;
use Welhott\Cryptopals\Set2\Challenge9\Pkcs7Padding;

/**
 * Class CbcMode
 * @package Welhott\Cryptopals\Set2\Challenge10
 */
class CbcMode
{
    /**
     * Implement CBC Mode 128bit.
     *
     * Messages are split into 16 byte chunks and each chunk is padded as necessary using
     * PKCS7-padding. Each of the chunks is XOR'ed against the IV (for the first chunk) and against the previously
     * encrypted chunk for the remaining chunks. Chunks are encrypted using AES-128bit in ECB mode.
     *
     * @param string $message The message that we want to encrypt.
     * @param string $iv The initialization vector for the encryption operation.
     * @param string $key The key that the message will be encrypted with.
     *
     * @return string The encrypted message.
     */
    public static function encrypt(string $message, string $iv, string $key) : string
    {
        $blocks = str_split($message, 16);
        $encrypted = [];

        for($i = 0; $i < count($blocks); $i++) {
            if(mb_strlen($blocks[$i]) < 16) {
                $blocks[$i] = Pkcs7Padding::pad($blocks[$i], '\0', 16);
            }

            if($i == 0) {
                $encrypted[$i] = hex2bin(FixedXOR::xor($blocks[$i], $iv));
            } else {
                $encrypted[$i] = hex2bin(FixedXOR::xor($blocks[$i], $encrypted[$i - 1]));
            }

            $encrypted[$i] = Aes128Ecb::encrypt($encrypted[$i], $key);
        }

        return implode('', $encrypted);
    }

    /**
     * Decrypt messages encrypted by the encrypt method of this class. 128bit CBC mode.
     *
     * The decryption operation is the reverse of the encryption operation and follows the same pattern. The encrypted
     * message is split into 16byte chunks. Each chunk is decrypted with the decryption key. After decryption, the
     * first chunk is XOR'ed against the IV and the remaining chunks are decrypted and XOR'ed against the previously
     * decrypted chunk.
     *
     * The final message is trimmed and cleaned from padding.
     *
     * @param string $message The message that we wish to decrypt.
     * @param string $iv The IV that encrypted the message.
     * @param string $key The decryption key.
     *
     * @return string A decrypted message.
     */
    public static function decrypt(string $message, string $iv, string $key) {
        $blocks = str_split($message, 16);
        $decrypted = [];

        for($i = 0; $i < count($blocks); $i++) {
            $decrypted[$i] = Aes128Ecb::decrypt($blocks[$i], $key);

            if($i == 0) {
                $decrypted[$i] = hex2bin(FixedXOR::xor($decrypted[$i], $iv));
            } else {
                $decrypted[$i] = hex2bin(FixedXOR::xor($decrypted[$i], $blocks[$i - 1]));
            }
        }

        return trim(implode('', $decrypted), ' \t\n\r\0\x0B');
    }
}
