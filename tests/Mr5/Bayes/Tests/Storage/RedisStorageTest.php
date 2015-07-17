<?php

namespace Mr5\Bayes\Tests\Tokenizer\Storage;

use Mr5\Bayes\Storage\ArrayStorage;
use Mr5\Bayes\Storage\RedisStorage;

class RedisStorageTest extends AbstractStorageTest
{
    /**
     * @var \Redis
     */
    protected $redis;

    protected function setUp()
    {
        $this->redis = new \Redis();
        $this->redis->connect(REDIS_SERVER_HOST, REDIS_SERVER_PORT);
        $this->storage = new RedisStorage($this->redis, REDIS_NAMESPACE);
    }

    protected function tearDown()
    {
        foreach ($this->redis->keys(REDIS_NAMESPACE . '*') as $key) {
            $this->redis->delete($key);
        }
    }
}