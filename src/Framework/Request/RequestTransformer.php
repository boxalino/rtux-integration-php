<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestTransformerInterface;
use Symfony\Component\HttpFoundation\Request;
use Boxalino\RealTimeUserExperienceApi\Framework\Request\RequestTransformerAbstract as ApiRequestTransformer;

/**
 * Class RequestTransformer
 * Sets request variables dependent on the channel
 * (account, credentials, environment details -- language, dev, test, session, header parameters, etc)
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Service\Api
 */
class RequestTransformer extends ApiRequestTransformer
    implements RequestTransformerInterface
{
    use RequestParametersTrait;


    /**
     * @param Request $request
     * @return string
     */
    public function getCustomerId(Request $request) : string
    {
        return $this->getProfileId($request);
    }

    /**
     * Store ID
     * @return string
     */
    public function getContextId() : string
    {
        return "rtux-test";
    }

}
