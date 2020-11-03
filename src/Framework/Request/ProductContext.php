<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\ItemContextInterface;

/**
 * Boxalino Product Request handler
 *
 * Available functions to rewrite:
 *  protected function addFilters(RequestInterface $request) : void
 *  public function addFacets(RequestInterface $request): ListingContextAbstract
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Request
 */
class ProductContext
    extends \Boxalino\RealTimeUserExperienceApi\Framework\Request\ItemContextAbstract
    implements ItemContextInterface
{
    use ContextTrait;
    use RequestParametersTrait;

    /**
     * It should match the field based on which the ID is set as item
     *
     * @return string
     */
    public function getGroupBy(): string
    {
        return "id";
    }

    /**
     * @return array
     */
    public function getContextVisibility() : array
    {
        return ["2", "3", "4"];
    }
}
