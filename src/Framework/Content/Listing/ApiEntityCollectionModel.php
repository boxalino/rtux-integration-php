<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample\Framework\Content\Listing;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Response\Accessor\AccessorInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Response\Accessor\AccessorModelInterface;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Listing\ApiEntityCollectionModelAbstract;

/**
 * Class ApiEntityCollectionModel
 *
 * Item refers to any data model/logic that is desired to be rendered/displayed
 * The integrator can decide to either use all data as provided by the Narrative API,
 * or to design custom data layers to represent the fetched content
 *
 * @package Boxalino\RealTimeUserExperienceSample\Service\Api\Content
 */
class ApiEntityCollectionModel extends ApiEntityCollectionModelAbstract
    implements AccessorModelInterface
{

    /**
     * @var null | \ArrayIterator
     */
    protected $collection = null;

    /**
     * Accessing collection of products based on the hits
     *
     * @return \ArrayIterator
     */
    public function getCollection() : \ArrayIterator
    {
        return $this->collection;
    }

    public function setCollection(\ArrayIterator $blocks, string $hitAccessor) : void
    {
        $products = array_map(function(AccessorInterface $block) use ($hitAccessor) {
            if(property_exists($block, $hitAccessor))
            {
                return $block->get($hitAccessor);
            }
        }, $blocks->getArrayCopy());

        $this->collection = $products;
    }

    /**
     * @param null | AccessorInterface $context
     * @return AccessorModelInterface
     */
    public function addAccessorContext(?AccessorInterface $context = null): AccessorModelInterface
    {
        parent::addAccessorContext($context);
        $this->setCollection($context->getBlocks(), $context->getAccessorHandler()->getAccessorSetter("bx-hit"));

        return $this;
    }

}
