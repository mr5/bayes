<?php

namespace Mr5\Bayes\Storage;

/**
 * Array storage
 *
 * @category Mr5\Bayes\Storage
 * @package  Mr5\Bayes\Storage
 * @author   mr.5 <mr5.simple@gmail.com>
 * @license  MIT <http://github.com/mr5/bayes/LICENSE.md>
 * @link     http://github.com/mr5/bayes
 */
class ArrayStorage implements StorageInterface
{
    /**
     * Total features count in per category.
     *
     * @var array
     */
    protected $featuresCountPerCategory = [];
    /**
     * Count of each feature in per category.
     *
     * @var array
     */
    protected $eachFeatureCountPerCategory = [];
    /**
     * Total count of all documents.
     *
     * @var int
     */
    protected $documentsCount = 0;
    /**
     * Count of documents with per category.
     *
     * @var array
     */
    protected $documentsCountPerCategory = [];
    /**
     * Total count of all features.
     *
     * @var int
     */
    protected $featuresCount = 0;
    /**
     * Count of each feature.
     *
     * @var array
     */
    protected $eachFeatureCount = [];
    protected $documentsCountPerFeatureInCategory = [];

    /**
     * {@inheritdoc}
     */
    public function increaseCategoryFeaturesCount($category)
    {
        if (!isset($this->featuresCountPerCategory[$category])) {
            $this->featuresCountPerCategory[$category] = 0;
        }
        $this->featuresCountPerCategory[$category]++;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryFeaturesCount($category)
    {
        if (!isset($this->featuresCountPerCategory[$category])) {
            return 0;
        }

        return $this->featuresCountPerCategory[$category];
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeatureCountInCategory($category, $feature)
    {
        if (!isset($this->eachFeatureCountPerCategory[$category][$feature])) {
            $this->eachFeatureCountPerCategory[$category][$feature] = 0;
        }

        $this->eachFeatureCountPerCategory[$category][$feature]++;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureCountInCategory($category, $feature)
    {
        if (!isset($this->eachFeatureCountPerCategory[$category][$feature])) {
            return 0;
        }

        return $this->eachFeatureCountPerCategory[$category][$feature];
    }

    /**
     * {@inheritdoc}
     */
    public function increaseDocumentsCount()
    {
        $this->documentsCount++;
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentsCount()
    {
        return $this->documentsCount;
    }

    /**
     * {@inheritdoc}
     */
    public function increaseCategoryDocumentsCount($category)
    {
        if (!isset($this->documentsCountPerCategory[$category])) {
            $this->documentsCountPerCategory[$category] = 0;
        }
        $this->documentsCountPerCategory[$category]++;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryDocumentsCount($category)
    {
        if (!isset($this->documentsCountPerCategory[$category])) {
            return 0;
        }

        return $this->documentsCountPerCategory[$category];
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeaturesCount()
    {
        $this->featuresCount++;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeaturesCount()
    {
        return $this->featuresCount;
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeatureCount($feature)
    {
        if (!isset($this->eachFeatureCount[$feature])) {
            $this->eachFeatureCount[$feature] = 0;
        }
        $this->eachFeatureCount[$feature]++;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureCount($feature)
    {
        if (!isset($this->eachFeatureCount[$feature])) {
            return 0;
        }

        return $this->eachFeatureCount[$feature];
    }

    /**
     * {@inheritdoc}
     */
    public function increaseFeatureDocumentsCountInCategory($category, $feature)
    {
        if (!isset($this->documentsCountPerFeatureInCategory[$category][$feature])) {
            $this->documentsCountPerFeatureInCategory[$category][$feature] = 0;
        }

        $this->documentsCountPerFeatureInCategory[$category][$feature]++;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureDocumentsCountInCategory($category, $feature)
    {
        if (!isset($this->documentsCountPerFeatureInCategory[$category][$feature])) {
            return 0;
        }

        return $this->documentsCountPerFeatureInCategory[$category][$feature];
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories()
    {
        return array_keys($this->featuresCountPerCategory);
    }
}
