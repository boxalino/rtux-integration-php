<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\ListingContextInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\Context\SearchContextInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Boxalino Search Request handler
 * Allows to set the nr of subphrases and products returned on each subphrase hit
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Request
 */
class SearchContext
    extends \Boxalino\RealTimeUserExperienceApi\Framework\Request\SearchContextAbstract
    implements SearchContextInterface, ListingContextInterface
{
    use ContextTrait;
    use RequestParametersTrait;

    /**
     * Product visibility on a search context
     * @return int
     */
    public function getContextVisibility() : int
    {
        return 2;
    }

    /**
     * For the search context - generally the root category ID is the navigation filter (if needed)
     *
     * @param Request $request
     * @return string
     */
    public function getContextNavigationId(Request $request): array
    {
        return [6];
    }

    /**
     * Other fields can be: products_seo_url, products_image, discountedPrice, etc
     * @return array
     */
    public function getReturnFields() : array
    {
        return ["id", "products_group_id", "title"];
    }

}
