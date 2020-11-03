<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Framework\Request\AutocompleteContextAbstract;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\ParameterInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Request\ContextTrait;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Request\RequestParametersTrait;

/**
 * Autocomplete request
 *
 * The autocomplete request can have facets&filters set; predefined order, etc
 * These are used align response elements (of different types or under different facets)
 *
 * By default, in Shopware6, the autocomplete response is from
 * the route("/suggest", name="frontend.search.suggest", methods={"GET"}, defaults={"XmlHttpRequest"=true})
 *
 * Can be customized to also have facets set/pre-defined. Please consult with Boxalino on more advanced scenarios.
 *
 * @package Boxalino\RealTimeUserExperienceIntegration\Service\Api
 */
class AutocompleteContext extends AutocompleteContextAbstract
{
    use ContextTrait;
    use RequestParametersTrait;

    protected function addFilters(RequestInterface $request): void
    {
        $this->getApiRequest()
            ->addFilters(
                $this->getCategoryFilter($request),
                $this->getActiveFilter($request)
            );
    }

    /**
     * @return int
     */
    public function getContextVisibility() : array
    {
        return [];
    }

    /**
     * The return fields can not be set on autocomplete
     * They`re configured in the TPO in Boxalino Intelligence Admin
     *
     * @return array
     */
    public function getReturnFields() : array
    {
        return [];
    }

}
