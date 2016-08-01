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
namespace Welhott\Cryptopals\Set1;

/**
 * Class Challenge5
 * @package Welhott\Cryptopals\Set1
 */
class Challenge5
{
    /**
     * @var string
     */
    private $message = '';

    /**
     * @var string
     */
    private $key = '';

    /**
     * Challenge5 constructor.
     * @param string $message The message we want to encrypt.
     * @param string $key The key we want to encrypt the message with.
     */
    public function __construct(string $message, string $key)
    {
        $this->message = $message;
        $this->key = $key;
    }

    /**
     * Encrypt the message with the key using repeating-key XOR.
     * @return string The encrypted message
     */
    public function encrypt() : string
    {
        $encrypted = '';
        $messageLength = mb_strlen($this->message);
        $keyLength = mb_strlen($this->key);

        for ($i = 0; $i < $messageLength; $i++) {
            $encrypted[] = $this->message[$i] ^ $this->key[$i % $keyLength];
        }

        return bin2hex(implode('', $encrypted));
    }
}
