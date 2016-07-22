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
    /**
     * @var array
     */
    private $secrets = [];

    /**
     * Challenge4 constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->secrets = preg_split('/\r\n|\r|\n/', file_get_contents($path));
    }

    /**
     * Decrypt all the lines in the file and return decryption information about them.
     * @return array Each of the lines decrypted
     */
    public function decrypt() : array
    {
        $candidates = [];

        foreach ($this->secrets as $secret) {
            $challenge = new Challenge3($secret);
            $key = $challenge->bruteForceKey();

            $candidates[] = [
                'key' => $key,
                'attempt' => $challenge->decrypt($key),
                'score' => $challenge->score($challenge->decrypt($key)),
            ];
        }

        return $candidates;
    }

    /**
     * Find the best candidate from all the decrypted lines.
     * @param $candidates The list of candidates
     * @return array Information about the candidate
     */
    public function findBestCandidate($candidates) : array
    {
        usort($candidates, function ($a, $b) {
            if ($a['score'] == $b['score']) {
                return 0;
            }
            return ($a['score'] > $b['score']) ? -1 : 1;
        });

        return reset($candidates);
    }
}
