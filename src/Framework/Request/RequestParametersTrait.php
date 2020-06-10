<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample\Framework\Request;

/**
 * Trait RequestParametersTrait
 * Describes the local e-shop request parameters
 *
 * @package Boxalino\RealTimeUserExperienceSample\Framework\Request
 */
trait RequestParametersTrait
{
    /**
     * @return string
     */
    public function getSortParameter() : string
    {
        return "order";
    }

    /**
     * @return string
     */
    public function getSearchParameter() : string
    {
        return 'search';
    }

    /**
     * @return string
     */
    public function getPageNumberParameter() : string
    {
        return "p";
    }

    /**
     * @return string
     */
    public function getPageLimitParameter() : string
    {
        return "limit";
    }

    /**
     * @return string
     */
    public function getDefaultLimitValue() : int
    {
        return 24;
    }

}