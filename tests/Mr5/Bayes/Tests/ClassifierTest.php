<?php
namespace Mr5\Bayes\Tests;

use Mr5\Bayes\Classifier;
use Mr5\Bayes\Storage\ArrayStorage;
use Mr5\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

class ClassifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Classifier
     */
    protected $classifier;

    public function setUp()
    {
//        $storage = new ArrayStorage();
//        $tokenizer = new WhitespaceAndPunctuationTokenizer();
//        $this->classifier = new Classifier(
//            $storage, $tokenizer
//        );
    }

    public function testClassify()
    {
        $tokenizer = new WhitespaceAndPunctuationTokenizer();
        $this->classifier = new Classifier(new ArrayStorage());

        $textsToLean = [
            '骂人' => [
                '你 就 是 个 傻逼， 傻屄。去 你妈逼 的'
            ],
            '政治敏感' => [
                '蛤蟆 出山',
                '九评 共产党， 退党 保 平安'
            ],
            '广告' => [
                '我 叫 大田金银，来自 香港，喜欢 黄金，喜欢 代理商，是 香港 金银 贸易场 202 号 AA 类 会员，我 会 给 代理商 最高 的 返佣，我 会 给 代理商 最快 的 返佣 速度，请 支持 我，想要 更好 的 了解 我 就 加 我 扣扣 QQ  ～ 123456'
            ],
            '正常' => [
                '这个 预期值 就 是 让 世界 各地 的 美元 准备 回流 美国'
            ],
            'positive' => [
                'amazing, awesome movie!! Yeah!! Oh boy.',
                'Sweet, this is incredibly, amazing, perfect, great!!'
            ],
            'negative' => [
                'terrible, shitty thing. Damn. Sucks!!'
            ],
            'english' => [
                'This is english',
            ],
            'french' => [
                'Je suis Hollandais'
            ]
        ];
        foreach ($textsToLean as $category => $texts) {
            foreach ($texts as $text) {
                $this->classifier->learn($category, $tokenizer->tokenize($text));
            }
        }
        $textsToClassify = [
            'This is a naive bayes classifier',
            'awesome, cool, amazing!! Yay.',
            '加息 这个 预期， 下跌 应该 是 套牢 想要 回流 的 美元',
            '你妈逼 喜欢 黄金， 加 我 扣扣 123456',
            '今天 我 买了 一个 蛤蟆，它 快 出山 了',
            '法轮 大法 好， 退党 保 平安',
            '黄金 会员 代理商 加 我 QQ 123456',
            '我 叫 大田金银，来自 香港，喜欢 黄金，喜欢 代理商，是 香港 金银 贸易场 202 号 AA 类 会员，我 会 给 代理商 最高 的 返佣，我 会 给 代理商 最快 的 返佣 速度，请 支持 我，想要 更好 的 了解 我 就 加 我 扣扣 QQ  ～ 123456'
        ];
        foreach ($textsToClassify as $text) {
            var_dump($text);
            var_dump(
                $this->classifier->categoriesProbability($tokenizer->tokenize($text))
            );
        }


    }
}