<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\Framework\Request;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestInterface;
use Boxalino\RealTimeUserExperienceApi\Service\Api\Request\RequestTransformerInterface;
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
     * @param RequestInterface $request
     * @return string
     */
    public function getCustomerId(RequestInterface $request) : string
    {
        return $this->getProfileId($request);
    }

}
