<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration;

use BoxalinoClientProject\BoxalinoIntegration\DependencyInjection\BoxalinoIntegrationExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class BoxalinoRealTimeUserExperienceIntegration
 *
 * @package BoxalinoClientProject\BoxalinoIntegration
 */
class BoxalinoRealTimeUserExperienceIntegration extends Bundle
{
    /**
     * @return Extension
     */
    public function getContainerExtension(): Extension
    {
        return new BoxalinoIntegrationExtension();
    }


}
