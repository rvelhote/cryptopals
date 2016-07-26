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
class Challenge3
{
    /**
     * Wikipedia mentions that the punctuation characters and digits collectively occupy the fourth position so I have
     * given it 7% frequency. I only included some punctuation chars for good measure.
     * @see https://en.wikipedia.org/wiki/Letter_frequency
     * @var array
     */
    public static $FREQUENCY = [
        'a' => '8.167',
        'b' => '1.492',
        'c' => '2.782',
        'd' => '4.253',
        'e' => '12.702',
        'f' => '2.228',
        'g' => '2.015',
        'h' => '6.094',
        'i' => '6.966',
        'j' => '0.153',
        'k' => '0.772',
        'l' => '4.025',
        'm' => '2.406',
        'n' => '6.749',
        'o' => '7.507',
        'p' => '1.929',
        'q' => '0.095',
        'r' => '5.987',
        's' => '6.327',
        't' => '9.056',
        'u' => '2.758',
        'v' => '0.978',
        'w' => '2.361',
        'x' => '0.150',
        'y' => '1.974',
        'z' => '0.074',
        ' ' => '13.000',
        '.' => '7.000',
        ',' => '7.000',
        ';' => '7.000',
        '1' => '7.000',
        '2' => '7.000',
        '3' => '7.000',
        '4' => '7.000',
        '5' => '7.000',
        '6' => '7.000',
        '7' => '7.000',
        '8' => '7.000',
        '9' => '7.000',
        '0' => '7.000',
    ];

    /**
     * The encrypted input.
     * @var string
     */
    private $message;

    /**
     * Challenge3 constructor.
     * @param string $input The encrypted message.
     */
    public function __construct(string $input)
    {
        $this->message = $input;
    }

    /**
     * Obtain the encrypted input used in this instance.
     * @return string An encrypted string.
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Encrypts the message with a certain encryption key.
     * @param string $message The message to encrypt.
     * @param string $key The encryption key.
     * @return string The encrypted message
     */
    public static function encrypt(string $message, string $key) : string
    {
        return $message ^ str_repeat($key, mb_strlen($message));
    }

    /**
     * Decrypt the input with $key. It will XOR the raw bytes of the input with the $key passed as parameter.
     * @param string $key The key that we want to use for decryption.
     * @return string A XOR'd string with the decryption result.
     */
    public function decrypt(string $key) : string
    {
        $key = str_repeat($key, mb_strlen($this->message));
        return trim($this->message ^ $key);
    }

    /**
     * Beats the living hell out of the input string to discover the key that was used to encrypt the message.
     * @return string The key that was used to encrypt the message. A single character (hopefully ;))
     */
    public function bruteForceKey() : string
    {
        $scoreboard = $this->getScoreboard();
        return key($scoreboard);
    }

    /**
     * Obtain a full scoreboard of all attempts made to break the key. An array will be returned that contains the key
     * that was attempted, the result of applying that decryption key and the score it had after decryption.
     * @param bool $sorted If we want the scoreboard sorted or not.
     * @return array The array with the results.
     */
    public function getScoreboard(bool $sorted = true) : array
    {
        $scoreboard = [];

        for ($i = 0; $i < 255; $i++) {
            $char = chr($i);

            $scoreboard[$char] = [
                'attempt' => $this->decrypt($char),
                'score' => $this->score($this->decrypt($char)),
            ];
        }

        if ($sorted) {
            uasort($scoreboard, function ($a, $b) {
                if ($a['score'] == $b['score']) {
                    return 0;
                }
                return ($a['score'] > $b['score']) ? -1 : 1;
            });
        }

        return $scoreboard;
    }

    /**
     * Scores a piece of english text. If a char exists in the FREQUENCY table it gets its value, if it doesn't it gets
     * penalized big time.
     * @param string $decrypted A decrypted string. You should have already used the decrypt method.
     * @return float The score that this text had.
     *
     * TODO Improve this scoring method. It does not seem very trustworthy even though it works in this example.
     */
    public function score(string $decrypted) : float
    {
        $score = 0.0;

        $decryptedLength = mb_strlen($decrypted);
        $decrypted = mb_strtolower($decrypted);

        for ($i = 0; $i < $decryptedLength; $i++) {
            if(!isset($decrypted[$i])) {
                $score -= 100;
                continue;
            }

            $letter = $decrypted[$i];

            if (isset(static::$FREQUENCY[$letter])) {
                $score += static::$FREQUENCY[$letter];
            } else {
                $score -= 100;
            }
        }

        return $score;
    }
}
