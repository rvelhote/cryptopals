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

use Welhott\Cryptopals\Set1\Challenge3\SingleByteXOR;

/**
 * Class Challenge5
 * @package Welhott\Cryptopals\Set1
 */
class Challenge6
{
    private $message;

    /**
     * Challenge6 constructor.
     * @param string $message
     * @param bool $isHex
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Brute force the key.
     *
     * As usual with these Cryptopals challenge, I got stuck for a long long time due to the instructions being unclear.
     * For cracking the Keysize the challenge said that we should take the Hamming distance from a varying chunk of the
     * encrypted text and normalize it by dividing by the keysize.
     *
     * It turned out to be necessary to compare the chunks to each of the other chunks, count the number of
     * calculations done and divide not only by keysize but also by the ammount of Hamming Distance calculations.
     *
     * I only found this by looking up other PHP solutions :(
     *
     * @return string The key that was used to encrypt the message.
     *
     * FIXME Performance improvements are very necessary. More than 2 minutes to decrypt the file
     * TODO Organize this method better. Split and test.
     */
    public function bruteForceKey() {
        $keysizeCandidates = [];

        $maxKeysize = mb_strlen($this->message) / 10 > 40 ? 40 : intval(mb_strlen($this->message) / 10);

        for($keysize = 2; $keysize <= $maxKeysize; $keysize++) {
            $chunks = str_split($this->message, $keysize);
            $chunkLength = count($chunks);
            $hammingDistance = 0;
            $totalHammingCalculations = 0;

            for($i = 0; $i < $chunkLength; $i++) {
                for($j = $i + 1; $j < $chunkLength; $j++) {
                    $hammingDistance += $this->hammingDistance($chunks[$i], $chunks[$j]);
                    $totalHammingCalculations++;
                }
            }

            $keysizeCandidates[$keysize] = $hammingDistance / $keysize / $totalHammingCalculations;
        }

        asort($keysizeCandidates, SORT_ASC);
        $keysizeCandidates = array_keys($keysizeCandidates);
        $keysizeCandidates = array_splice($keysizeCandidates, 0, 3);

        foreach($keysizeCandidates as $keysize) {
            $blocks = str_split($this->message, $keysize);

            $transposedBlocks = [];
            for ($i = 0; $i < $keysize; $i++) {
                $newBlock = [];
                foreach ($blocks as $block) {
                    if (isset($block[$i])) {
                        $newBlock[] = $block[$i];
                    }
                }
                $transposedBlocks[] = $newBlock;
            }

            $transposedBlocks = array_map('implode', $transposedBlocks);

            $key = '';

            foreach ($transposedBlocks as $block) {
                $c = new SingleByteXOR($block);
                $key .= $c->bruteForceKey();
            }

            $keyCandidates[] = $key;
        }

        $scores = [];
        foreach($keyCandidates as $key) {
            $c = new SingleByteXOR($this->message);
            $scores[$key] = $c->score($c->decrypt($key));
        }

        // FIXME asort doesn't work with negative values? Really? :/
        uasort($scores, function($a, $b) {
            return $a < $b;
        });

        return array_keys($scores)[0];
    }

    public function decrypt(string $key)
    {
        $c = new SingleByteXOR($this->message);
        return $c->decrypt($key);
    }

    public function transpose(array $array)
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
