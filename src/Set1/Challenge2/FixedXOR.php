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
namespace Welhott\Cryptopals\Set1\Challenge2;

/**
 * Class Challenge2
 * @package Cryptopals\Set1\Challenge2
 * @see http://cryptopals.com/sets/1/challenges/2
 */
class FixedXOR
{
    /**
     * The message that we want to handle.
     * @var string
     */
    private $message = '';

    /**
     * Challenge2 constructor.
     * @param string $message The message that we want to handle.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Produce a XOR combination of the the parameter with the string that was initialized in the constructor.
     * @param string $against The string we want to combine the input against.
     * @return string The result of the XOR combination in hexadecimal.
     */
    public function xor(string $against) : string
    {
        $rawInput = hex2bin($this->message);
        $rawAgainst = hex2bin($against);

        return bin2hex($rawInput ^ $rawAgainst);
    }
}
