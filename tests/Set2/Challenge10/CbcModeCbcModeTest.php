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
namespace Welhott\Cryptopals\Tests\Set2\Challenge10;

use Welhott\Cryptopals\Set1\Challenge2\FixedXOR;
use Welhott\Cryptopals\Set1\Challenge7\Aes128Ecb;
use Welhott\Cryptopals\Set2\Challenge10\CbcMode;

/**
 * Class CbcModeTest
 * @package Welhott\Cryptopals\Tests\Set2\Challenge10
 */
class CbcModeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testChallenge()
    {
        $message = base64_decode(file_get_contents("challenge10.txt"));
        $iv = "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0";
        $key = 'YELLOW SUBMARINE';

        $challenge = new CbcMode($message);
        $decryptedMessage = $challenge->decrypt($iv, $key);

        $this->assertContains('It controls my mouth and I begin', $decryptedMessage);

    }

    /**
     *
     */
    public function testEnryptionAndDecryption()
    {
        $message = "These pretzels are making me thirsty";

        $iv = "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0";
        $key = 'YELLOW SUBMARINE';

        $challenge = new CbcMode($message);
        $encryptedMessage = $challenge->encrypt($iv, $key);

        $challenge = new CbcMode($encryptedMessage);
        $decryptedMessage = $challenge->decrypt($iv, $key);

        $this->assertEquals($message, $decryptedMessage);
    }
}
