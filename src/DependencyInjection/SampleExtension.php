<?php declare(strict_types=1);
namespace BoxalinoClientProject\BoxalinoIntegration\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Class SampleExtension
 * Boxalino API Sample Bundle extension
 *
 * @package BoxalinoClientProject\BoxalinoIntegration\DependencyInjection
 */
class SampleExtension extends Extension
{
    private const ALIAS = 'boxalino_rtux_sample';

    public function getAlias() : string
    {
        return self::ALIAS;
    }

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
    }
}
