<?php

namespace Mr5\Bayes;

use Mr5\Bayes\Storage\StorageInterface;

/**
 * Classifier
 *
 * @category Mr5\Bayes
 * @package  Mr5\Bayes
 * @author   mr.5 <mr5.simple@gmail.com>
 * @license  MIT <http://github.com/mr5/bayes/LICENSE.md>
 * @link     http://github.com/mr5/bayes
 */
class Classifier
{
    /**
     * Array storage
     *
     * @var StorageInterface
     */
    protected $storage;


    /**
     * Constructor.
     *
     * @param StorageInterface $storage Storage for
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Calculate probability of feature in category.
     *
     * @param string $category category
     * @param string $feature  feature
     *
     * @return float
     */
    protected function featureProbability($category, $feature)
    {

        if ($this->storage->getCategoryFeaturesCount($category) == 0) {
            // avoid `0` probability
            return 0.01;
        }
        // P(category|feature) = P(feature|category) * P(category)  /
        // P(feature|category) * P(category) +
        // ( P(feature|otherCategories) * P(otherCategories))

        // P(feature|category)
        // = feature frequency in category / all features in category
        $featureCountInCategory
            = $this->storage->getFeatureCountInCategory($category, $feature);

        $categoryFeaturesCount = $this->storage->getCategoryFeaturesCount($category);
        // P(feature|category)
        $featureCategoryProbability
            = $this->storage->getFeatureDocumentsCountInCategory($category, $feature)
            / $this->storage->getCategoryDocumentsCount($category);


        if ($featureCategoryProbability == 0) {
            $featureCategoryProbability = 0.01;
        }
        // P(category)
        $categoryProbability
            = $this->storage->getCategoryDocumentsCount($category)
            / $this->storage->getDocumentsCount();

        // P(otherCategories)
        $categoryImprobability
            = ($this->storage->getFeatureCount($feature) - $featureCountInCategory)
            /
            ($this->storage->getFeaturesCount() - $categoryFeaturesCount);

        $categoryImprobability
            = $categoryImprobability == 0 ? 0.01 : $categoryImprobability;

        // P(category|feature)
        $probability
            = ($featureCategoryProbability * $categoryProbability)
            / (
                ($featureCategoryProbability * $categoryProbability)
                +
                $categoryImprobability * (1 - $categoryProbability)
            );

        return $probability;
    }

    /**
     * Calculate probability of given category.
     *
     * @param string $category Category
     * @param array  $features Features
     * @param int    $limit    Top {$limit} probability of features limited.
     *
     * @return float
     */
    public function categoryProbability($category, array $features, $limit = 0)
    {

        $probabilities = [];
        foreach ($features as $feature) {
            $probabilities[]
                = $this->featureProbability($category, $feature);
        }

        if ($limit > 0 && $limit < count($probabilities)) {
            arsort($probabilities, SORT_NUMERIC);
            $probabilities = array_slice($probabilities, 0, $limit);
        }

        $probabilitiesTotal = 1;
        $improbabilitiesTotal = 1;

        foreach ($probabilities as $probability) {
            $improbability = 1 - $probability;
            $probabilitiesTotal *= $probability;
            $improbabilitiesTotal *= $improbability;
        }

        return $probabilitiesTotal / ($probabilitiesTotal + $improbabilitiesTotal);
    }

    /**
     * Calculate probability of all categories
     *
     * @param array $features features array
     *
     * @return array
     */
    public function categoriesProbability(array $features)
    {
        $probabilities = [];
        foreach ($this->storage->getCategories() as $category) {
            $probabilities[$category]
                = round($this->categoryProbability($category, $features, 3), 4);
        }
        arsort($probabilities, SORT_NUMERIC);

        return $probabilities;
    }

    /**
     * Classify given features.
     *
     * @param array $features Features to classify
     *
     * @return array
     */
    public function classify(array $features)
    {
        $probabilities = $this->categoriesProbability($features);

        return array_keys(array_slice($probabilities, 0, 1))[0];
    }

    /**
     * Train classifier categorize given features to given category.
     *
     * @param string $category Category of features.
     * @param array  $features Features of category.
     *
     * @return void
     */
    public function learn($category, array $features)
    {
        $this->storage->increaseDocumentsCount();
        $this->storage->increaseCategoryDocumentsCount($category);
        $uniqueFeatures = array_unique($features);
        foreach ($uniqueFeatures as $uniqueFeature) {
            $this->storage->increaseFeatureDocumentsCountInCategory(
                $category,
                $uniqueFeature
            );
        }
        foreach ($features as $feature) {
            $this->storage->increaseFeaturesCount();
            $this->storage->increaseFeatureCount($feature);
            $this->storage->increaseCategoryFeaturesCount($category);
            $this->storage->increaseFeatureCountInCategory($category, $feature);
        }
    }
}
