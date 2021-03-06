<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\ListingContextInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\SearchContextInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;

/**
 * Boxalino Search Request handler
 * Allows to set the nr of subphrases and products returned on each subphrase hit
 *
 * Available functions to rewrite:
 *  protected function addFilters(RequestInterface $request) : void
 *  public function addFacets(RequestInterface $request): ListingContextAbstract
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Request
 */
class SearchContext
    extends \Boxalino\RealTimeUserExperienceApi\Framework\Request\SearchContextAbstract
    implements SearchContextInterface, ListingContextInterface
{
    use ContextTrait;
    use RequestParametersTrait;

    protected function addFilters(RequestInterface $request): void
    {
        /**
         * do not set any default filters for search
         */
    }

    /**
     * @return array
     */
    public function getContextVisibility() : array
    {
        return [];
    }

    /**
     * @param RequestInterface $request
     * @return string
     */
    public function getContextNavigationId(RequestInterface $request): array
    {
        return [];
    }

}
