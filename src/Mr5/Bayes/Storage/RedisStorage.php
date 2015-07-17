<?php

namespace Mr5\Bayes\Storage;

/**
 * Redis storage
 *
 * @category Mr5\Bayes\Storage
 * @package  Mr5\Bayes\Storage
 * @author   mr.5 <mr5.simple@gmail.com>
 * @license  MIT <http://github.com/mr5/bayes/LICENSE.md>
 * @link     http://github.com/mr5/bayes
 */
class RedisStorage implements StorageInterface
{
    /**
     * @var \Redis
     */
    protected $redis;
    protected $keyPrefix;

    /**
     * Constructor
     *
     * @param \Redis $redis     Redis instance
     * @param string $keyPrefix Redis key prefix
     */
    public function __construct(\Redis $redis, $keyPrefix = 'bayes:')
    {
        $this->redis = $redis;
        $this->keyPrefix = $keyPrefix;
    }

    /**
     * Generate key with prefix.
     *
     * @param string $name Redis key name.
     *
     * @return string
     */
    protected function key($name)
    {
        $keyPrefix = $this->keyPrefix;
        if (empty($keyPrefix)) {
            $keyPrefix = '';
        }

        return $keyPrefix . $name;
    }

    /**
     * {@inheritdoc}
     */
    public function increaseCategoryFeaturesCount($category)
    {
        $this->redis->hIncrBy($this->key('featuresCountPerCategory'), $category, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeatureCountInCategory($category, $feature)
    {
        $redisKey = $this->key('eachFeatureCountPerCategory:' . $category);
        $this->redis->hIncrBy($redisKey, $feature, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function increaseDocumentsCount()
    {
        $this->redis->incr($this->key('documentsCount'));
    }

    /**
     * {@inheritdoc}
     */
    public function increaseCategoryDocumentsCount($category)
    {
        $this->redis->hIncrBy($this->key('documentsCountPerCategory'), $category, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeaturesCount()
    {
        $this->redis->incr($this->key('featuresCount'));
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeatureCount($feature)
    {
        $this->redis->hIncrBy($this->key('eachFeatureCount'), $feature, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryFeaturesCount($category)
    {

        $redisKey = $this->key('featuresCountPerCategory');
        if (!$this->redis->hExists($redisKey, $category)) {
            return 0;
        }

        return $this->redis->hGet($redisKey, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureCountInCategory($category, $feature)
    {
        $redisKey = $this->key('eachFeatureCountPerCategory:' . $category);
        if (!$this->redis->hExists(
            $redisKey,
            $feature
        )
        ) {
            return 0;
        }

        return $this->redis->hGet($redisKey, $feature);
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentsCount()
    {
        $redisKey = $this->key('documentsCount');
        if (!$this->redis->exists($redisKey)) {
            return 0;
        }

        return $this->redis->get($redisKey);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryDocumentsCount($category)
    {
        $redisKey = $this->key('documentsCountPerCategory');
        if (!$this->redis->hExists($redisKey, $category)) {
            return 0;
        }

        return $this->redis->hGet($redisKey, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getFeaturesCount()
    {
        $redisKey = $this->key('featuresCount');
        if (!$this->redis->exists($redisKey)) {
            return 0;
        }

        return $this->redis->get($redisKey);

    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureCount($feature)
    {
        $redisKey = $this->key('eachFeatureCount');
        if (!$this->redis->hExists($redisKey, $feature)) {
            return 0;
        }

        return $this->redis->hGet($redisKey, $feature);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories()
    {
        return $this->redis->hKeys($this->key('featuresCountPerCategory'));
    }
}