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
namespace Welhott\Cryptopals\Set2\Challenge9;

/**
 * Class Pkcs7Padding
 * @package Welhott\Set2\Challenge9
 */
class Pkcs7Padding
{
    /**
     * Pad a message with a padding char up to a certain amount of bytes. This implements PKCS7 padding.
     * @param string $message The message we want to pad.
     * @param string $padChar The char we want to pad with.
     * @param int $bytes The amount of bytes we want to pad to.
     * @return string The padded message
     */
    public static function pad(string $message, string $padChar = '\0', int $bytes = 20) : string
    {
        return str_pad($message, $bytes, $padChar, STR_PAD_RIGHT);
    }
}