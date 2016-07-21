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
 * Class Challenge2
 * @package Cryptopals\Set1
 * @see http://cryptopals.com/sets/1/challenges/2
 */
class Challenge2
{
    /**
     * Produce the XOR combination of two hexadecimal strings.
     * @param string $input The input string.
     * @param string $against The string we want to combine the input agains.
     * @return string The result of the XOR combination in hexadecimal
     */
    public static function produceXorCombination(string $input, string $against) : string
    {
        $rawInput = hex2bin($input);
        $rawAgainst = hex2bin($against);

        return bin2hex($rawInput ^ $rawAgainst);
    }
}
