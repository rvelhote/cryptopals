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
namespace Welhott\Cryptopals\Tests\Set1\Challenge4;

use PHPUnit_Framework_TestCase;
use Welhott\Cryptopals\Set1\Challenge4\DetectSingleByteXOR;

/**
 * Class DetectSingleByteXORTest
 * @package Welhott\Cryptopals\Tests\Set1\Challenge4
 */
class DetectSingleByteXORTest extends PHPUnit_Framework_TestCase
{
    public function testChallenge()
    {
        $expected = 'Now that the party is jumping';
        $expectedKey = '5';

        $challenge = new DetectSingleByteXOR('challenge4.txt');
        $actual = $challenge->detect();

        $this->assertEquals($expectedKey, $actual['key']);
        $this->assertEquals($expected, $actual['attempt']);
    }
}
