<?php
namespace BoxalinoClientProject\BoxalinoIntegration;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/**
 * Base setup per Symfony documentation
 * https://symfony.com/doc/current/configuration/micro_kernel_trait.html
 *
 * @package BoxalinoClientProject\BoxalinoIntegration
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @param ContainerConfigurator $c
     */
    protected function configureContainer(ContainerConfigurator $c): void
    {
        /**
        $c->services()
            ->load('BoxalinoClientProject\\BoxalinoIntegration', __DIR__.'/*')
            ->autowire()
            ->autoconfigure()
        ;
         */
    }

    /**
     * @param RoutingConfigurator $routes
     */
    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // load the annotation routes
        $routes->import(__DIR__.'/Controller/', 'annotation');
    }

    /**
     * @return string
     */
    public function getCacheDir(): string
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    /**
     * @return string
     */
    public function getLogDir(): string
    {
        return __DIR__.'/../var/log';
    }

}