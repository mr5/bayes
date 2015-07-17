<?php

namespace Mr5\Bayes\Tests\Tokenizer;

use Mr5\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

class WhitespaceAndPunctuationTokenizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @dataProvider tokenizeProvider
     *
     * @param string $text     Text for tokenize
     * @param array  $expected Expected of tokenized
     *
     * @return void
     */
    public function testTokenize($text, $expected)
    {
        $tokenizer = new WhitespaceAndPunctuationTokenizer();
        $actualValue = $tokenizer->tokenize($text);
        $this->assertEquals($expected, $actualValue);
    }

    public function tokenizeProvider()
    {
        return [
            [
                'Tokenize some words that split with whitespace.',
                [
                    'tokenize',
                    'some',
                    'words',
                    'that',
                    'split',
                    'with',
                    'whitespace'
                ]
            ],
            [
                'Sentence includes punctuations and whitespaces, just like this.',
                [
                    'sentence',
                    'includes',
                    'punctuations',
                    'and',
                    'whitespaces',
                    'just',
                    'like',
                    'this'
                ]
            ],
            [
                '包含 一些 常见 的 中文，和 全角 标点符号 看看，are you ok？',
                [
                    '包含',
                    '一些',
                    '常见',
                    '的',
                    '中文',
                    '和',
                    '全角',
                    '标点符号',
                    '看看',
                    'are',
                    'you',
                    'ok'
                ]
            ]
        ];
    }
}