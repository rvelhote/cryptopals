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
namespace Welhott\Cryptopals\Tests\Set2\Challenge11;

use PHPUnit_Framework_TestCase;
use Welhott\Cryptopals\Set1\Challenge8\DetectAesInEcbMode;
use Welhott\Cryptopals\Set2\Challenge11\EcbCbcDetectionOracle;

/**
 * Class EcbCbcDetectionOracleTest
 * @package Welhott\Cryptopals\Tests\Set2\Challenge11
 */
class EcbCbcDetectionOracleTest extends PHPUnit_Framework_TestCase
{
    public function testChallenge()
    {
        $messages = [
            EcbCbcDetectionOracle::encrypt('Basketball is my favorite sport'),
            EcbCbcDetectionOracle::encrypt('I like the way they dribble up and down the court'),
            EcbCbcDetectionOracle::encrypt('Just like I\'m the king on the microphone'),
            EcbCbcDetectionOracle::encrypt('So is Dr. J and Moses Malone'),
            EcbCbcDetectionOracle::encrypt('I like slam dunks, take me to the hoop'),
            EcbCbcDetectionOracle::encrypt('My favorite play is the alley-oop'),
            EcbCbcDetectionOracle::encrypt('I like the pick-and-roll, I like the give-and-go'),
            EcbCbcDetectionOracle::encrypt('Cause it\'s basketball, uh, Mister Kurtis Blow'),
        ];

        foreach($messages as $oracle) {
            $detection = new DetectAesInEcbMode($oracle['message']);
            if($detection->getRepeatedBlocks() > 0) {
                $this->assertEquals('CBC', $oracle['algo']);
            } else {
                $this->assertEquals('ECB', $oracle['algo']);
            }
        }
    }
}
