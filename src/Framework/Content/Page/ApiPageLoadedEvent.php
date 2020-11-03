<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Response\ApiResponseViewInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ApiPageLoadedEvent
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page
 */
class ApiPageLoadedEvent extends Event
{
    /**
     * @var ApiResponseViewInterface
     */
    protected $page;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(ApiResponseViewInterface $page, RequestInterface $request)
    {
        $this->page = $page;
        $this->request = $request;
    }

    public function getPage(): ApiResponseViewInterface
    {
        return $this->page;
    }

    public function getRequest() : RequestInterface
    {
        return $this->request;
    }

}
