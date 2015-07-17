<?php

namespace Mr5\Bayes\Tests\Tokenizer\Storage;

use Mr5\Bayes\Storage\ArrayStorage;
use Mr5\Bayes\Storage\StorageInterface;

abstract class AbstractStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    public function testCategoryFeaturesCount()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseCategoryFeaturesCount('testCategory');
            $this->assertEquals(
                $i,
                $this->storage->getCategoryFeaturesCount('testCategory')
            );
        }

        $this->storage->increaseCategoryFeaturesCount('testCategory2');
        $this->assertEquals(
            1,
            $this->storage->getCategoryFeaturesCount('testCategory2')
        );
    }

    public function testFeatureCountInCategory()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseFeatureCountInCategory(
                'testCategory',
                'testFeature'
            );
            $this->assertEquals(
                $i,
                $this->storage->getFeatureCountInCategory(
                    'testCategory',
                    'testFeature'
                )
            );
        }


        $this->storage->increaseFeatureCountInCategory(
            'testCategory',
            'testFeature2'
        );
        $this->assertEquals(
            1,
            $this->storage->getFeatureCountInCategory('testCategory', 'testFeature2')
        );

        $this->storage->increaseFeatureCountInCategory(
            'testCategory2',
            'testFeature'
        );
        $this->assertEquals(
            1,
            $this->storage->getFeatureCountInCategory('testCategory2', 'testFeature')
        );
    }

    public function testDocumentsCount()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseDocumentsCount();
            $this->assertEquals(
                $i,
                $this->storage->getDocumentsCount()
            );
        }
    }

    public function testCategoryDocumentsCount()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseCategoryDocumentsCount('testCategory');
            $this->assertEquals(
                $i,
                $this->storage->getCategoryDocumentsCount('testCategory')
            );
        }

        $this->storage->increaseCategoryDocumentsCount('testCategory2');
        $this->assertEquals(
            1,
            $this->storage->getCategoryDocumentsCount('testCategory2')
        );
    }

    public function testFeaturesCount()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseFeaturesCount();
            $this->assertEquals(
                $i,
                $this->storage->getFeaturesCount()
            );
        }
    }

    public function testFeatureCount()
    {
        for ($i = 1; $i < 4; $i++) {
            $this->storage->increaseFeatureCount('testFeature');
            $this->assertEquals(
                $i,
                $this->storage->getFeatureCount('testFeature')
            );
        }
        $this->storage->increaseFeatureCount('testFeature2');
        $this->assertEquals(
            1,
            $this->storage->getFeatureCount('testFeature2')
        );
    }
}