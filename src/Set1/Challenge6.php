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
class Challenge6
{
    /**
     * Challenge6 constructor.
     */
    public function __construct()
    {

    }

    /**
     * Calculate the Hamming Distance between two strings. This code is using the GMP PHP library. I was confused by
     * the wording of the exercise as I assumed the Hamming Distance would be calculated for the whole string and not
     * individually for each character (and then summed). I guess I should have learned my lesson from Challenge3 ;)
     *
     * @param string $string1 One string to verify
     * @param string $string2 Another string to verify against.
     *
     * @return int The Hamming Distance betwen $string1 and $string2. Returns -1 if the they don't have the same size.
     * @see https://en.wikipedia.org/wiki/Hamming_distance
     */
    public function hammingDistance(string $string1, string $string2) : int
    {
        $distance = 0;
        $lengthString1 = mb_strlen($string1);
        $lengthString2 = mb_strlen($string2);

        if($lengthString1 != $lengthString2) {
            return -1;
        }

        for($i = 0; $i < $lengthString1; $i++) {
            $ham1 = gmp_init(ord($string1[$i]), 10);
            $ham2 = gmp_init(ord($string2[$i]), 10);
            $distance += gmp_hamdist($ham1, $ham2);
        }

        return $distance;
    }
}
