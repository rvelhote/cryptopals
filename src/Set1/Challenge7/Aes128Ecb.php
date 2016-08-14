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
     * @var string
     */
    private $message;

    /**
     * Challenge7 constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param string $key
     * @return string
     */
    public function decrypt(string $key) : string
    {
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $this->message, MCRYPT_MODE_ECB);
    }

    /**
     * @param string $key
     * @return string
     */
    public function encrypt(string $key) : string
    {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $this->message, MCRYPT_MODE_ECB);
    }
}
