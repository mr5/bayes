<?php

namespace Mr5\Bayes\Tokenizer;

/**
 * WhitespaceAndPunctuationTokenizer
 *
 * @category Mr5\Bayes\Tokenizer
 * @package  Mr5\Bayes\Tokenizer
 * @author   mr.5 <mr5.simple@gmail.com>
 * @license  MIT <http://github.com/mr5/bayes/LICENSE.md>
 * @link     http://github.com/mr5/bayes
 */
class WhitespaceAndPunctuationTokenizer implements TokenizerInterface
{
    protected $pattern = "/[ ，。、；：？,.?!-:;\\n\\r\\t…_]/u";

    /**
     * {@inheritdoc}
     */
    public function tokenize($string)
    {
        $string = preg_split($this->pattern, mb_strtolower($string, 'utf8'));
        $string = array_filter($string, 'trim');

        return array_values($string);
    }
}
