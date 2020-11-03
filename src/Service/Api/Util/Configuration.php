<?php
namespace BoxalinoClientProject\BoxalinoIntegration\Service\Api\Util;

use Boxalino\RealTimeUserExperienceApi\Service\Api\Util\ConfigurationInterface;

/**
 * Class Configuration
 * Configurations defined for the REST API requests
 * It reads the parameters configured
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\Service\Api\Util
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $apiSecret;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var bool
     */
    protected $isDev;

    /**
     * @var bool
     */
    protected $isTest;


    /**
     * Configuration constructor.
     *
     * @param string $username
     * @param string $apiKey
     * @param string $apiSecret
     * @param string $endpoint
     * @param bool $isDev
     * @param bool $isTest
     */
    public function __construct(string $username, string $apiKey, string $apiSecret, string $endpoint, bool $isDev = false, bool $isTest = true)
    {
        $this->setUsername($username);
        $this->setApiKey($apiKey);
        $this->setApiSecret($apiSecret);
        $this->setEndpoint($endpoint);
        $this->setIsDev($isDev);
        $this->setIsTest($isTest);
    }

    /**
     * The API endpoint depends on the testing conditionals and on the data index
     * @return string
     */
    public function getRestApiEndpoint() : string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
       return $this->username;
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret() : string
    {
        return $this->apiSecret;
    }

    /**
     * @return bool
     */
    public function getIsDev() : bool
    {
       return $this->isDev;
    }

    /**
     * @return bool
     */
    public function getIsTest() : bool
    {
       return $this->isTest;
    }

    /**
     * @param string $username
     * @return ConfigurationInterface
     */
    public function setUsername(string $username): ConfigurationInterface
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return ConfigurationInterface
     */
    public function setApiKey(string $apiKey): ConfigurationInterface
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @param string $apiSecret
     * @return ConfigurationInterface
     */
    public function setApiSecret(string $apiSecret): ConfigurationInterface
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return ConfigurationInterface
     */
    public function setEndpoint(string $endpoint): ConfigurationInterface
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param bool $isDev
     * @return ConfigurationInterface
     */
    public function setIsDev(bool $isDev): ConfigurationInterface
    {
        $this->isDev = $isDev;
        return $this;
    }

    /**
     * @param bool $isTest
     * @return ConfigurationInterface
     */
    public function setIsTest(bool $isTest): ConfigurationInterface
    {
        $this->isTest = $isTest;
        return $this;
    }

}
