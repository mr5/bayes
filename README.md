# Naive Bayes Classifier

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
  
  $classifier->lean('english', $tokenizer->tokenize('This is english'));
  $classifier->lean('french', $tokenizer->tokenize('Je suis Hollandais'));
  
  $probabilities = $classifier->classify(
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
