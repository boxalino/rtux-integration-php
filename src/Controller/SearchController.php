<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample\Controller;

use Boxalino\RealTimeUserExperienceSample\Framework\Content\Page\ApiPageLoader as SearchPageLoader;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Search
 * Sample search request
 *
 * @package Boxalino\RealTimeUserExperienceSample\Controller
 */
class SearchController extends AbstractController
{
    /**
     * @var SearchPageLoader
     */
    private $searchApiPageLoader;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        SearchPageLoader $searchApiPageLoader,
        LoggerInterface $logger
    ){
        $this->searchApiPageLoader = $searchApiPageLoader;
        $this->logger = $logger;
    }

    /**
     * @HttpCache()
     * @Route("/search", name="frontend.search.page", methods={"GET"})
     */
    public function search(Request $request): Response
    {
        try {
            $page = $this->searchApiPageLoader->load($request);
            if($page->getRedirectUrl())
            {
                return $this->redirect($page->getRedirectUrl());
            }

            /**
             * the render template is a narrative page
             */
            return new Response(json_encode($page));
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop search
        }
    }

}