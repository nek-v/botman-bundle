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

namespace Nek\Bundle\BotmanBundle\Routing;

use RuntimeException;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class WebhookControllerLoader extends Loader
{
    /**
     * @var bool
     */
    private $loaded = false;
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $params;

    /**
     * WebhookControllerLoader constructor.
     * @param ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @param mixed $resource
     * @param string|null $type
     * @return mixed|RouteCollection
     */
    public function load($resource, string $type = null)
    {
        if (true === $this->loaded) {
            throw new RuntimeException('Do not add the "extra" laoder twice');
        }

        $routes = new RouteCollection();

        if ($this->params->has('botman.controller')) {
            $controller = $this->params->get('botman.controller');
            $path = $this->params->get('botman.path');

            $route = new Route($path, ['_controller' => $controller]);
            $routes->add(
                'botman_webhook',
                $route
            );
        }

        $this->loaded = true;

        return $routes;
    }

    /**
     * @param mixed $resource
     * @param string|null $type
     * @return bool
     */
    public function supports($resource, string $type = null)
    {
        return 'extra' === $type;
    }
}
