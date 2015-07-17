<?php

namespace Mr5\Bayes\Tests\Tokenizer\Storage;

use Mr5\Bayes\Storage\ArrayStorage;

class ArrayStorageTest extends AbstractStorageTest
{
    protected function setUp()
    {
        $this->storage = new ArrayStorage();
    }
}