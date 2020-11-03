<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page;

use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiResponsePage;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Response\ApiResponseViewInterface;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Request\RequestParametersTrait;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiPageLoaderAbstract;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiResponsePageInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\ApiCallServiceInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Util\ConfigurationInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @package BoxalinoClientProject\BoxalinoIntegration\Service\Api\Content\Page
 */
class ApiPageLoader extends ApiPageLoaderAbstract
{
    use RequestParametersTrait;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(
        ApiCallServiceInterface $apiCallService,
        ConfigurationInterface $configuration,
        EventDispatcherInterface $eventDispatcher
    ) {
        parent::__construct($apiCallService, $configuration);
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return ApiResponseViewInterface
     */
    public function getApiResponsePage(): ?ApiResponseViewInterface
    {
        if(!$this->apiResponsePage)
        {
            $this->apiResponsePage = new ApiResponsePage();
        }

        return $this->apiResponsePage;
    }

    /**
     * @param RequestInterface $request
     * @param ApiResponsePageInterface $page
     */
    protected function dispatchEvent(RequestInterface $request, ApiResponsePageInterface $page)
    {
        $this->eventDispatcher->dispatch(
            new ApiPageLoadedEvent($page, $request)
        );
    }

    protected function _beforeApiCallService(): void  { }

}
