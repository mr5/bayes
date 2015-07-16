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
class ArrayStorage
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

    /**
     * Increase count of given category .
     *
     * @param string $category Category to count
     */
    public function increaseCategoryFeaturesCount($category)
    {
        if (!isset($this->featuresCountPerCategory[$category])) {
            $this->featuresCountPerCategory[$category] = 0;
        }
        $this->featuresCountPerCategory[$category]++;
    }

    /**
     * Increase count of given feature in given category.
     *
     * @param string $category
     * @param string $feature
     */
    public function increaseFeatureCountInCategory($category, $feature)
    {
        if (!isset($this->eachFeatureCountPerCategory[$category][$feature])) {
            $this->eachFeatureCountPerCategory[$category][$feature] = 0;
        }

        $this->eachFeatureCountPerCategory[$category][$feature]++;
    }

    /**
     * Increase total count of documents.
     */
    public function increaseDocumentsCount()
    {
        $this->documentsCount++;
    }

    /**
     * Increase documents count of given category.
     *
     * @param string $category Category for documents counting.
     */
    public function increaseCategoryDocumentsCount($category)
    {
        if (!isset($this->documentsCountPerCategory[$category])) {
            $this->documentsCountPerCategory[$category] = 0;
        }
        $this->documentsCountPerCategory[$category]++;
    }

    /**
     * Increase total count of all features.
     */
    public function increaseFeaturesCount()
    {
        $this->featuresCount++;
    }

    /**
     * Increase count of given feature.
     *
     * @param string $feature Feature fo counting
     */
    public function increaseFeatureCount($feature)
    {
        if (!isset($this->eachFeatureCount[$feature])) {
            $this->eachFeatureCount[$feature] = 0;
        }
        $this->eachFeatureCount[$feature]++;
    }

    /**
     * Get total count of all features in given category.
     *
     * @param string $category Category for counting.
     *
     * @return int
     */
    public function getCategoryFeaturesCount($category)
    {
        if (!isset($this->featuresCountPerCategory[$category])) {
            return 0;
        }

        return $this->featuresCountPerCategory[$category];
    }

    /**
     * Get count of given feature in given category.
     *
     * @param string $category Category for counting
     * @param string $feature  Feature for counting
     *
     * @return int
     */
    public function getFeatureCountInCategory($category, $feature)
    {
        if (!isset($this->eachFeatureCountPerCategory[$category][$feature])) {
            return 0;
        }

        return $this->eachFeatureCountPerCategory[$category][$feature];
    }

    /**
     * Get total count of all documents.
     *
     * @return int
     */
    public function getDocumentsCount()
    {
        return $this->documentsCount;
    }

    /**
     * Get total count of documents with given category.
     *
     * @param string $category Category for counting
     *
     * @return int
     */
    public function getCategoryDocumentsCount($category)
    {
        if (!isset($this->documentsCountPerCategory[$category])) {
            return 0;
        }

        return $this->documentsCountPerCategory[$category];
    }

    /**
     * Get total count of all features.
     *
     * @return int
     */
    public function getFeaturesCount()
    {
        return $this->featuresCount;
    }

    /**
     * Get count of given feature.
     *
     * @param string $feature Feature fo counting
     *
     * @return int
     */
    public function getFeatureCount($feature)
    {
        if (!isset($this->eachFeatureCount[$feature])) {
            return 0;
        }

        return $this->eachFeatureCount[$feature];
    }

    /**
     * Get all categories.
     *
     * @return string[]
     */
    public function getCategories()
    {
        return array_keys($this->featuresCountPerCategory);
    }
}