<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Listing;

use Boxalino\RealTimeUserExperienceApi\Framework\Content\Listing\ApiSortingModelInterface;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Listing\ApiSortingModelAbstract;

/**
 * Class ApiSortingModel
 * Mock of a sorting strategy
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Listing
 */
class ApiSortingModel extends ApiSortingModelAbstract
    implements ApiSortingModelInterface
{

    /**
     * The default sort field recommended with the Boxalino API is the "position" (label: "Relevance"/"Recommended")
     * because the product order is the recommended one
     *
     * @return string
     */
    public function getDefaultSortField(): string
    {
        return "score";
    }

    /**
     * @inherited from Magento2
     * @return string
     */
    public function getDefaultSortDirection() : string
    {
        return ApiSortingModelInterface::SORT_ASCENDING;
    }

}
