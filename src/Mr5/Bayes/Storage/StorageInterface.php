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
interface StorageInterface
{
    /**
     * Increase count of given category .
     *
     * @param string $category Category to count
     *
     * @return void
     */
    public function increaseCategoryFeaturesCount($category);

    /**
     * Get total count of all features in given category.
     *
     * @param string $category Category for counting.
     *
     * @return int
     */
    public function getCategoryFeaturesCount($category);

    /**
     * Increase count of given feature in given category.
     *
     * @param string $category Which category that feature included.
     * @param string $feature  Feature in category
     *
     * @return void
     */
    public function increaseFeatureCountInCategory($category, $feature);

    /**
     * Get count of given feature in given category.
     *
     * @param string $category Category for counting
     * @param string $feature  Feature for counting
     *
     * @return int
     */
    public function getFeatureCountInCategory($category, $feature);

    /**
     * Increase total count of documents.
     *
     * @return void
     */
    public function increaseDocumentsCount();

    /**
     * Get total count of all documents.
     *
     * @return int
     */
    public function getDocumentsCount();

    /**
     * Increase documents count of given category.
     *
     * @param string $category Category for documents counting.
     *
     * @return void
     */
    public function increaseCategoryDocumentsCount($category);

    /**
     * Get total count of documents with given category.
     *
     * @param string $category Category for counting
     *
     * @return int
     */
    public function getCategoryDocumentsCount($category);

    /**
     * Increase total count of all features.
     *
     * @return void
     */
    public function increaseFeaturesCount();

    /**
     * Get total count of all features.
     *
     * @return int
     */
    public function getFeaturesCount();

    /**
     * Increase count of given feature.
     *
     * @param string $feature Feature fo counting
     *
     * @return void
     */
    public function increaseFeatureCount($feature);

    /**
     * Get documents count of given feature in given category.
     *
     * @param string $category Category for counting
     * @param string $feature  Feature for counting
     *
     * @return int
     */
    public function getFeatureDocumentsCountInCategory($category, $feature);

    /**
     * Increase documents count of given feature in given category.
     *
     * @param string $category Category for counting
     * @param string $feature  Feature for counting
     *
     * @return void
     */
    public function increaseFeatureDocumentsCountInCategory($category, $feature);

    /**
     * Get count of given feature.
     *
     * @param string $feature Feature fo counting
     *
     * @return int
     */
    public function getFeatureCount($feature);

    /**
     * Get all categories.
     *
     * @return string[]
     */
    public function getCategories();
}