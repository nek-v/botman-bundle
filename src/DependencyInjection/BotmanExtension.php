<?php

declare(strict_types=1);

/*
 * This file is part of the `botman-bundle` project.
 *
 * (c) Sergio Góemz <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nek\Bundle\BotmanBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

final class BotmanExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('botman.controller', $mergedConfig['controller']);
        $container->setParameter('botman.path', $mergedConfig['path']);

        $this->createHttplugClient($mergedConfig, $container);

        if (!isset($mergedConfig['drivers'])) {
            $mergedConfig['drivers'] = [];
        }

        $drivers = [];
        foreach ($mergedConfig['drivers'] as $driver => $options) {
            $drivers[$driver] = $options;

            foreach ($options['parameters'] as $parameter => $value) {
                $container->setParameter(sprintf('botman.driver.%s.%s', $driver, $parameter), $value);
            }

            $loader->load($driver . '.xml');
        }

        $container->setParameter('botman.drivers', $drivers);
    }

    private function createHttplugClient(array $config, ContainerBuilder $container): void
    {
        $httpClientId = $config['http']['client'];
        $httpMessageFactoryId = $config['http']['message_factory'];
        $bundles = $container->getParameter('kernel.bundles');

        if ('httplug.client.default' === $httpClientId && !isset($bundles['HttplugBundle'])) {
            throw new InvalidConfigurationException(
                'You must setup php-http/httplug-bundle to use the default http client service.'
            );
        }
        if ('httplug.message_factory.default' === $httpMessageFactoryId && !isset($bundles['HttplugBundle'])) {
            throw new InvalidConfigurationException(
                'You must setup php-http/httplug-bundle to use the default http message factory service.'
            );
        }

        $container->setAlias('botman.http.client', new Alias($config['http']['client'], true));
        $container->setAlias('botman.http.message_factory', new Alias($config['http']['message_factory'], true));
    }
}
