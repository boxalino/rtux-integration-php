<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample\Framework\Content\Page;

use Boxalino\RealTimeUserExperienceSample\Framework\Request\RequestParametersTrait;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiPageLoaderAbstract;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiResponsePageInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\ApiCallServiceInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Util\ConfigurationInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package Boxalino\RealTimeUserExperienceSample\Service\Api\Content\Page
 */
class ApiPageLoader extends ApiPageLoaderAbstract
{
    use ApiLoaderTrait;
    use RequestParametersTrait;

    /**
     * @return ApiResponsePageInterface
     */
    public function getApiResponsePage(Request $request): ApiResponsePageInterface
    {
        return new ApiResponsePage();
    }

    /**
     * @param Request $request
     * @param ApiResponsePageInterface $page
     */
    protected function dispatchEvent(Request $request, ApiResponsePageInterface $page)
    {
        $this->eventDispatcher->dispatch(
            new ApiPageLoadedEvent($page, $request)
        );
    }

}
