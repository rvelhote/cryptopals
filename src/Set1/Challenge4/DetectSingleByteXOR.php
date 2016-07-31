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
namespace Welhott\Cryptopals\Set1\Challenge4;

use Welhott\Cryptopals\Set1\Challenge3\SingleByteXOR;

/**
 * Class DetectSingleByteXOR
 * @package Cryptopals\Set1\Challenge4
 * @see http://cryptopals.com/sets/1/challenges/4
 */
class DetectSingleByteXOR
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
        $this->secrets = array_map('hex2bin', preg_split('/\r\n|\r|\n/', file_get_contents($path)));
    }

    /**
     * Detect the line in the file that was encrypted with SingleByteXOR.
     * @return array Information about the line that was encrypted with SingleByteXOR.
     */
    public function detect() : array
    {
        return $this->findBestCandidate($this->getDecryptionCandidates());
    }

    /**
     * Brute-force the key in order to discover the best candidate key for each of the lines.
     * The returned array will return information about each line:
     * - key: The best key that was brute-forced
     * - attempt: The decryption attempt after using the brute-forced key
     * - score: The score that the key
     * @return array The list of candidates with information about each of the lines.
     */
    public function getDecryptionCandidates() : array
    {
        $candidates = [];

        foreach ($this->secrets as $secret) {
            $challenge = new SingleByteXOR($secret);
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
     * After all lines are brute-forced for the decryption key the one with the best score will be selected as the
     * correct one. You may find the full list of candidates by using getDecryptionCandidates().
     * @param array $candidates The list of candidates
     * @return array Information about the candidate
     */
    private function findBestCandidate(array $candidates) : array
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
