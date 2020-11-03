<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\ParameterFactory;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\ParameterFactoryInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestTransformerInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\ParameterInterface;

/**
 * Trait ContextTrait
 * sets all the functions required for the Boxalino\RealTimeUserExperienceApi\Framework\Request\ContextAbstract
 * to be used for all other implicit contexts
 * Set the values for the generic filters : status, visibility, category
 * Edit the properties name here
 * The default filters are edited in individual contexts (ListingContext, SearchContext, etc)
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Request
 */
trait ContextTrait
{

    /**
     * @var string
     */
    protected $groupBy = "products_group_id";

    /**
     * @var RequestTransformerInterface
     */
    protected $requestTransformer;

    /**
     * @var ParameterFactory
     */
    protected $parameterFactory;

    /**
     * @param RequestInterface $request
     */
    public function validateRequest(RequestInterface $request) : void { }

    /**
     * @param RequestInterface $request
     * @return ParameterInterface
     */
    public function getVisibilityFilter(RequestInterface $request) : ParameterInterface
    {
        return $this->getParameterFactory()->get(ParameterFactoryInterface::BOXALINO_API_REQUEST_PARAMETER_TYPE_FILTER)
            ->add("products_visibility" , $this->getContextVisibility());
    }

    /**
     * @param RequestInterface $request
     * @return ParameterInterface
     */
    public function getCategoryFilter(RequestInterface $request) : ParameterInterface
    {
        return $this->getParameterFactory()->get(ParameterFactoryInterface::BOXALINO_API_REQUEST_PARAMETER_TYPE_FILTER)
            ->add("category_id", $this->getContextNavigationId($request));
    }

    /**
     * @param RequestInterface $request
     * @return ParameterInterface
     */
    public function getActiveFilter(RequestInterface $request) : ParameterInterface
    {
        return $this->getParameterFactory()->get(ParameterFactoryInterface::BOXALINO_API_REQUEST_PARAMETER_TYPE_FILTER)
            ->add("products_status", [1]);
    }

    /**
     * For the search context - generally the root category ID is the navigation filter (if needed)
     *
     * @param RequestInterface $request
     * @return array
     */
    public function getContextNavigationId(RequestInterface $request): array
    {
        $categoryId = (int)$request->getParam('id', false);
        if($categoryId)
        {
            return [$categoryId];
        }

        /** replace this value with your system`s root category ID -- if any; */
        return [2];
    }

    /**
     * The fields can also be configured in Boxalino Intelligence Admin as part of the TPO rules
     *
     * @return array
     */
    public function getReturnFields() : array
    {
        return ["id", "products_group_id", "title", "discountedPrice"];
    }

    /**
     * @return RequestTransformerInterface
     */
    public function getRequestTransformer()  : RequestTransformerInterface
    {
        return $this->requestTransformer;
    }

    /**
     * @return ParameterFactory
     */
    public function getParameterFactory() : ParameterFactory
    {
        return $this->parameterFactory;
    }

    /**
     * Set the range properties following the presented structure
     *
     * @return array
     */
    public function getRangeProperties() : array
    {
        return [
            "products_rating_average" => ['from' => 'products_rating_average', 'to' => "0"],
            "discountedPrice" => ['from' => 'min-price', 'to' => 'max-price']
        ];
    }

    /**
     * The filter values delimiter as to be used in your system for URLs requests
     *
     * @return string
     */
    public function getFilterValuesDelimiter(): string
    {
        return "|";
    }

}
