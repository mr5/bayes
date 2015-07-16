<?php

namespace Mr5\Bayes\Tokenizer;

/**
 * Tokenizer interface
 *
 * @category Mr5\Bayes\Tokenizer
 * @package  Mr5\Bayes\Tokenizer
 * @author   mr.5 <mr5.simple@gmail.com>
 * @license  MIT <http://github.com/mr5/bayes/LICENSE.md>
 * @link     http://github.com/mr5/bayes
 */
interface TokenizerInterface
{
    /**
     * Tokenize specific text;
     *
     * @param string $text Test to tokenize
     *
     * @return array
     */
    public function tokenize($text);
}