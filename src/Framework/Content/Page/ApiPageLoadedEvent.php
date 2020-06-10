<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample\Framework\Content\Page;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

class ApiPageLoadedEvent extends Event
{
    /**
     * @var ApiResponsePage
     */
    protected $page;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(ApiResponsePage $page, Request $request)
    {
        $this->page = $page;
        $this->request = $request;
    }

    public function getPage(): ApiResponsePage
    {
        return $this->page;
    }

    public function getRequest() : Request
    {
        return $this->request;
    }

}
