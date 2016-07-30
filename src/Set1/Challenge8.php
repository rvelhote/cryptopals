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
 * Class Challenge7
 * @package Welhott\Cryptopals\Set1
 */
class Challenge8
{
    /**
     * @var string
     */
    private $message;

    /**
     *
     */
    const BITS = 128;

    /**
     * Challenge8 constructor.
     * @param string $message The message to check.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * AES-128-ECB works by encrypting data using 128-bit (16 bytes) blocks. The same 16 byte plaintext
     * block will always produce the same 16 byte ciphertext. We can split the string in block of length 16 and compare
     * them agains each other. A string encrypted with AES-128-ECB will have some repeated blocks.
     *
     * Immediately after commiting the last code I remembered that we are essencial just checking for the amount of
     * uniques in the message after splitting it in blocks. I left the previous code there too but this simpler
     * solution seems to fit properly,
     *
     * @return int The amount of unique 16-byte blocks in the message.
     */
    public function getRepeatedBlocks() : int
    {
        $blocks = str_split($this->message, self::BITS / 8);
        return count(array_unique($blocks));

//        $repeatedBlocks = [];
//
//        $blocks = str_split($this->message, self::BITS / 8);
//        $totalBlocks = count($blocks);
//
//        for ($i = 0; $i < $totalBlocks; $i++) {
//            for ($j = 0; $j < $totalBlocks; $j++) {
//                if ($i != $j && $blocks[$i] == $blocks[$j]) {
//                    $repeatedBlocks[] = $blocks[$i];
//                }
//            }
//        }
//
//        return array_unique($repeatedBlocks);
    }

    /**
     * Return the line with the most repeated blocks.
     * This will just sort the array and return the key of the first pos.
     * @param array $possibilities The list of possibilities generated by the getRepeatedBlocks method.
     * @return int The line number of the best match.
     */
    public static function findBestMatch(array $possibilities) : int
    {
        asort($possibilities);
        return key($possibilities);
    }
}
