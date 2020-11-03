<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Controller;

use BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page\ApiBaseLoader as ProductPageLoader;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page\ApiBaseLoader as AutocompletePageLoader;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page\ApiPageLoader as SearchPageLoader;
use BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page\ApiPageLoader as ListingPageLoader;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface as RequestWrapper;

/**
 * @package BoxalinoClientProject\BoxalinoIntegration\Controller
 */
class ApiIntegrationController extends AbstractController
{
    /**
     * @var SearchPageLoader
     */
    private $searchApiPageLoader;

    /**
     * @var ListingPageLoader
     */
    private $listingApiPageLoader;

    /**
     * @var ProductPageLoader
     */
    private $productApiPageLoader;

    /**
     * @var AutocompletePageLoader
     */
    private $autocompleteApiPageLoader;

    /**
     * @var RequestWrapper
     */
    private $requestWrapper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        SearchPageLoader $searchApiPageLoader,
        ListingPageLoader $listingApiPageLoader,
        ProductPageLoader $productApiPageLoader,
        AutocompletePageLoader $autocompleteApiPageLoader,
        RequestWrapper $requestWrapper,
        LoggerInterface $logger
    ){
        $this->searchApiPageLoader = $searchApiPageLoader;
        $this->listingApiPageLoader = $listingApiPageLoader;
        $this->productApiPageLoader = $productApiPageLoader;
        $this->autocompleteApiPageLoader = $autocompleteApiPageLoader;
        $this->requestWrapper = $requestWrapper;
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="frontend.home.page", methods={"GET"})
     */
    public function index(): ?Response
    {
        return $this->json(["Welcome to Boxalino Integration"]);
    }

    /**
     * @Route("/search", name="frontend.search.page", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        try {
            $this->requestWrapper->setRequest($request);
            $this->searchApiPageLoader->setRequest($this->requestWrapper)->load();

            if($this->requestWrapper->getParam("request", false))
            {
                return $this->getApiRequestJsonByContextResponse($this->searchApiPageLoader);
            }

            if($this->requestWrapper->getParam("response", false))
            {
                return $this->getApiResponseJsonByContextResponse($this->searchApiPageLoader);
            }

            $page = $this->searchApiPageLoader->getApiResponsePage();
            if($page->getRedirectUrl())
            {
                return $this->redirect($page->getRedirectUrl());
            }
            return $this->json([$page->getBlocks(), $page->getLeft(), $page->getVariantUuid()]);
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop search
        }
    }

    /**
     * @Route("/navigation/{id}", name="frontend.navigation.page", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function listing(Request $request): Response
    {
        try {
            $this->requestWrapper->setRequest($request);
            $this->listingApiPageLoader->setRequest($this->requestWrapper)->load();

            if($this->requestWrapper->getParam("request", false))
            {
                return $this->getApiRequestJsonByContextResponse($this->listingApiPageLoader);
            }

            if($this->requestWrapper->getParam("response", false))
            {
                return $this->getApiResponseJsonByContextResponse($this->listingApiPageLoader);
            }

            $page = $this->listingApiPageLoader->getApiResponsePage();
            return $this->json([$page->getBlocks(), $page->getLeft(), $page->getVariantUuid()]);
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop navigation
        }
    }

    /**
     * @Route("/autocomplete", name="frontend.autocomplete.page", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function autocomplete(Request $request): Response
    {
        try {
            $this->requestWrapper->setRequest($request);
            $this->autocompleteApiPageLoader->setRequest($this->requestWrapper)->load();

            if($this->requestWrapper->getParam("request", false))
            {
                return $this->getApiRequestJsonByContextResponse($this->autocompleteApiPageLoader);
            }

            if($this->requestWrapper->getParam("response", false))
            {
                return $this->getApiResponseJsonByContextResponse($this->autocompleteApiPageLoader);
            }

            $page = $this->autocompleteApiPageLoader->getApiResponsePage();
            return $this->json([$page->getBlocks(), $page->getVariantUuid()]);
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop navigation
        }
    }

    /**
     * Mock for a product recommendation request.
     * In an actual setup, the product ID for the context is to be accessed in the proper way
     *
     * @Route("/product/{id}", name="frontend.product.page", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function product(Request $request): Response
    {
        try {
            $this->requestWrapper->setRequest($request);
            $this->productApiPageLoader->getApiContext()->setProductId($this->requestWrapper->getParam("id"));
            $this->productApiPageLoader->setRequest($this->requestWrapper)->load();

            if($this->requestWrapper->getParam("request", false))
            {
                return $this->getApiRequestJsonByContextResponse($this->productApiPageLoader);
            }

            if($this->requestWrapper->getParam("response", false))
            {
                return $this->getApiResponseJsonByContextResponse($this->productApiPageLoader);
            }

            $page = $this->productApiPageLoader->getApiResponsePage();
            return $this->json($page->getBlocks());
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop product recommendations
        }
    }

    /**
     * Mock for a basket request.
     * In an actual setup, the last added product to cart & the other cart items should be accessed accordingly
     *
     * @Route("/cart", name="frontend.cart.page", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function basket(Request $request): Response
    {
        try {
            $this->requestWrapper->setRequest($request);
            $this->productApiPageLoader->getApiContext()
                ->setProductId($this->requestWrapper->getParam("product_id"))
                ->setSubProductIds(explode("|", $this->requestWrapper->getParam("other_cart_ids")))
                ->setWidget("basket");

            $this->productApiPageLoader->setRequest($this->requestWrapper)->load();

            if($this->requestWrapper->getParam("request", false))
            {
                return $this->getApiRequestJsonByContextResponse($this->productApiPageLoader);
            }

            if($this->requestWrapper->getParam("response", false))
            {
                return $this->getApiResponseJsonByContextResponse($this->productApiPageLoader);
            }

            $page = $this->productApiPageLoader->getApiResponsePage();
            return $this->json($page->getBlocks());
        } catch (\Throwable $exception) {
            /**
             * Fallback
             */
            $this->logger->alert("BoxalinoAPI: There was an issue with your request." . $exception->getMessage());
            //load your own system/e-shop basket recommendations
        }
    }

    /**
     * Return the API request JSON as response
     *
     * @param $loader
     * @return Response
     */
    protected function getApiRequestJsonByContextResponse($loader) : Response
    {
        $response = new Response($loader->getApiContext()->getApiRequest()->jsonSerialize());
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Return the API response JSON as response
     *
     * @param $loader
     * @return Response
     */
    protected function getApiResponseJsonByContextResponse($loader) : Response
    {
        $response = new Response($loader->getApiResponseJson());
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}