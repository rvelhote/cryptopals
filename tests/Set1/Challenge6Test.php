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
        $message = base64_decode(implode('', preg_split('/\r\n|\r|\n/', file_get_contents("../../dataset/set1/challenge6.txt"))));

        $expectedKey = 'Terminator X: Bring the noise';

        $challenge = new Challenge6($message);
        $actualKey = $challenge->bruteForceKey();
//        $actualMessage = $challenge->decrypt($actualKey);

        $this->assertEquals($expectedKey, $actualKey);

    }

    public function testMessageFromChallenge5()
    {
        $message = hex2bin('0b3637272a2b2e63622c2e69692a23693a2a3c6324202d623d63343c2a26226324272765272a282b2f20430a65'.
                    '2e2c652a3124333a653e2b2027630c692b20283165286326302e27282f');

        $expectedKey = 'ICE';
        $expectedMessage = "Burning 'em, if you ain't quick and nimble\nI go crazy when I hear a cymbal";

        $challenge = new Challenge6($message);
        $actualKey = $challenge->bruteForceKey();
        $actualMessage = $challenge->decrypt($actualKey);

        $this->assertEquals($expectedKey, $actualKey);
        $this->assertEquals($expectedMessage, $actualMessage);
    }

    public function testHammingDistance()
    {
        $challenge = new Challenge6('FIXME ;)');

        $string1 = 'this is a test';
        $string2 = 'wokka wokka!!!';

        $this->assertEquals(37, $challenge->hammingDistance($string1, $string2), "Distance is not 37");
    }

    public function testInvalidHammingDistance()
    {
        $challenge = new Challenge6('FIXME ;)');

        $string1 = 'these strings';
        $string2 = 'should be the same length';

        $this->assertEquals(-1, $challenge->hammingDistance($string1, $string2));
    }
}
