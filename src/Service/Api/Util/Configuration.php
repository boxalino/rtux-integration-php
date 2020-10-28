<?php
namespace BoxalinoClientProject\BoxalinoIntegration\Service\Api\Util;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Util\ConfigurationInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Configuration
 * Configurations defined for the REST API requests
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Service\Api\Util
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @var null | string
     */
    protected $contextId = null;

    /**
     * @param string $contextId
     * @return $this
     */
    public function setContextId(string $contextId) : self
    {
        $this->contextId = $contextId;
        return $this;
    }


    /**
     * The API endpoint depends on the testing conditionals and on the data index
     * @param string $contextId
     * @return string
     */
    public function getRestApiEndpoint(string $contextId) : string
    {
        return "https://main.bx-cloud.com/narrative/". $this->getUsername($contextId) . "/api/1";
    }

    /**
     * @param string $contextId
     * @return string
     */
    public function getUsername(string $contextId) : string
    {
       return "dana_shopware_06";
    }

    /**
     * @param string $contextId
     * @return string
     */
    public function getApiKey(string $contextId) : string
    {
        return "dana_shopware_06";
    }

    /**
     * @param string $contextId
     * @return string
     */
    public function getApiSecret(string $contextId) : string
    {
        return "dana_shopware_06";
    }

    /**
     * @param string $contextId
     * @return bool
     */
    public function getIsDev(string $contextId) : bool
    {
       return false;
    }

    /**
     * @param string $contextId
     * @return bool
     */
    public function getIsTest(string $contextId) : bool
    {
       return false;
    }

}
