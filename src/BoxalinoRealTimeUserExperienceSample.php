<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration;

use BoxalinoClientProject\BoxalinoIntegration\DependencyInjection\SampleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class BoxalinoRealTimeUserExperienceSample
 *
 * @package BoxalinoClientProject\BoxalinoIntegration
 */
class BoxalinoRealTimeUserExperienceSample extends Bundle
{
    /**
     * @return Extension
     */
    public function getContainerExtension(): Extension
    {
        return new SampleExtension();
    }


}
