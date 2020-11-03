<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Content\Page;

use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiBaseLoaderAbstract;
use Boxalino\RealTimeUserExperienceApi\Framework\Content\Page\ApiResponsePage;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Response\ApiResponseViewInterface;

/**
 * @package BoxalinoClientProject\BoxalinoIntegration\Service\Api\Content\Page
 */
class ApiBaseLoader extends ApiBaseLoaderAbstract
{

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
     * add validations, checks or extra-parameters, per context
     */
    protected function _beforeApiCallService(): void  { }

}
