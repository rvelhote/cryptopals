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
 * Class Challenge3
 *
 * This exercise was quite difficult until the AHA! moment. I felt the wording of the exercise was confusing because it
 * said that the secret message was encrypted with a single character. This is true in a way but it's not A single
 * character, it's the same character
 *
 * @package Cryptopals\Set1
 * @see http://cryptopals.com/sets/1/challenges/3
 */
class Challenge4
{
    public function __construct(string $path)
    {
        $content = file_get_contents($path);

        // FIXME This is so dumb. I am trying to split by \r\n, \n\r, \n and \r Nothing is working!!! :(
        $lines = explode('<br>', nl2br($content, false));
        array_walk($lines, function(&$v) { $v = trim($v); });

        $solutions = [];

        foreach($lines as $line) {
            $challenge = new Challenge3($line);
            $solutions[] = $challenge->decrypt($challenge->bruteForceKey());
        }



    }
}
