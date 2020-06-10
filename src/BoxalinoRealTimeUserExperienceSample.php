<?php declare(strict_types=1);
namespace Boxalino\RealTimeUserExperienceSample;

use Boxalino\RealTimeUserExperienceSample\DependencyInjection\SampleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class BoxalinoRealTimeUserExperienceSample
 *
 * @package Boxalino\RealTimeUserExperienceSample
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
