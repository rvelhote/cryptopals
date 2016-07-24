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
namespace Welhott\Cryptopals\Tests\Set1;

use PHPUnit_Framework_TestCase;
use Welhott\Cryptopals\Set1\Challenge6;

/**
 * Class Challenge5Test
 * @package Welhott\Cryptopals\Tests\Set1
 */
class Challenge6Test extends PHPUnit_Framework_TestCase
{
    public function testChallenge()
    {
    }

    public function testHammingDistance()
    {
        $challenge = new Challenge6();

        $string1 = 'this is a test';
        $string2 = 'wokka wokka!!!';

        $this->assertEquals(37, $challenge->hammingDistance($string1, $string2), "Distance is not 37");
    }

    public function testInvalidHammingDistance()
    {
        $challenge = new Challenge6();

        $string1 = 'these strings';
        $string2 = 'should be the same length';

        $this->assertEquals(-1, $challenge->hammingDistance($string1, $string2));
    }
}
