<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\ListingContextInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;

/**
 * Boxalino Listing Request handler
 *
 * Available functions to rewrite:
 *  protected function addFilters(RequestInterface $request) : void
 *  public function addFacets(RequestInterface $request): ListingContextAbstract
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Request
 */
class ListingContext
    extends \Boxalino\RealTimeUserExperienceApi\Framework\Request\ListingContextAbstract
    implements ListingContextInterface
{
    use ContextTrait;
    use RequestParametersTrait;

    /**
     * @return array
     */
    public function getContextVisibility() : array
    {
        return [];
    }

    /**
     * By default it sets the visibility, status and category filter
     * @param RequestInterface $request
     */
    protected function addFilters(RequestInterface $request): void
    {
        $this->getApiRequest()
            ->addFilters(
                $this->getCategoryFilter($request)
            );
    }

}
