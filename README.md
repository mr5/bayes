# Naive Bayes Classifier

[![Build Status](https://travis-ci.org/mr5/bayes.svg)](https://travis-ci.org/mr5/bayes)
[![Quality score](https://scrutinizer-ci.com/g/mr5/bayes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mr5/bayes/) 
[![License](https://poser.pugx.org/mr5/bayes/license.svg)](https://packagist.org/packages/mr5/bayes)
[![Coverage Status](https://coveralls.io/repos/mr5/bayes/badge.svg?branch=master&service=github)](https://coveralls.io/github/mr5/bayes?branch=master)
## Usage

Add dependency to you composer.json.

```json
  "require": {
    "mr5/bayes":"dev-master"
  }
```

Training

```php
<?php
  use Mr5\Bayes\Classifier;
  use Mr5\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;
  use Mr5\Bayes\Storage\ArrayStorage;
  
  $storage = new ArrayStorage();
  $tokenizer = new WhitespaceAndPunctuationTokenizer();
  $classifier = new Classifier($storage);
  
  $classifier->learn('english', $tokenizer->tokenize('This is english'));
  $classifier->learn('french', $tokenizer->tokenize('Je suis Hollandais'));
  
  $probabilities = $classifier->categoriesProbability(
      $tokenizer->tokenize('This is a naive bayes classifier')
  );
  
  var_dump($probabilities);
```

Will output:

```
array(2) {
  ["english"]=>
  float(99.91)
  ["french"]=>
  float(50)
}
```
