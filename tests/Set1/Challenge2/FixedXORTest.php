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
namespace Welhott\Cryptopals\Tests\Set1\Challenge2;

use PHPUnit_Framework_TestCase;
use Welhott\Cryptopals\Set1\Challenge2\FixedXOR;

/**
 * Class Challenge1Test
 * @package Welhott\Cryptopals\Tests\Set1
 */
class FixedXORTest extends PHPUnit_Framework_TestCase
{
    public function testChallenge()
    {
        $input = hex2bin('1c0111001f010100061a024b53535009181c');
        $against = hex2bin('686974207468652062756c6c277320657965');
        $expected = '746865206b696420646f6e277420706c6179';

        $challenge = new FixedXOR($input);
        $actual = $challenge->xor($against);

        $this->assertEquals($expected, $actual);
    }
}
