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
     * @var string
     */
    public $message = '';

    /**
     * CbcMode constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function encrypt(string $iv, string $key) : string
    {
        $blocks = str_split($this->message, 16);
        $encrypted = [];

        for($i = 0; $i < count($blocks); $i++) {
            if(mb_strlen($blocks[$i]) < 16) {
                $blocks[$i] = Pkcs7Padding::pad($blocks[$i], '\0', 16);
            }

            $xored = new FixedXOR($blocks[$i]);

            if($i == 0) {
                $encrypted[$i] = hex2bin($xored->xor($iv));
            } else {
                $encrypted[$i] = hex2bin($xored->xor($encrypted[$i - 1]));
            }

            $aes = new Aes128Ecb($encrypted[$i]);
            $encrypted[$i] = substr($aes->encrypt($key), 0, 16);
        }

        return implode('', $encrypted);
    }

    public function decrypt(string $iv, string $key) {
        $blocks = str_split($this->message, 16);
        $decrypted = [];

        for($i = 0; $i < count($blocks); $i++) {
            $aes = new Aes128Ecb($blocks[$i]);
            $decrypted[$i] = $aes->decrypt($key);

            $xored = new FixedXOR($decrypted[$i]);
            if($i == 0) {
                $decrypted[$i] = hex2bin($xored->xor($iv));
            } else {
                $decrypted[$i] = hex2bin($xored->xor($blocks[$i - 1]));
            }
        }

        return trim(implode('', $decrypted), ' \t\n\r\0\x0B');
    }
}