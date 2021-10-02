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

namespace Nek\Bundle\BotmanBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Nek\Bundle\BotmanBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    public function testEmptyConfigurationIsValid(): void
    {
        $this->assertConfigurationIsValid([
            []
        ]);
    }

    public function testDefaultController(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
            [],
        ],
            ['controller' => 'App\Controller\WebhookController'],
            'controller'
        );
    }

    public function testConfigureController(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
            ['controller' => 'App\Controller\AlternativeWebhookController'],
        ],
            ['controller' => 'App\Controller\AlternativeWebhookController'],
            'controller'
        );
    }

    public function testDefaultPath(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
        ],
            ['path' => '/botman'],
            'path'
        );
    }

    public function testConfigurePath(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
            ['path' => '/webhook'],
        ],
            ['path' => '/webhook'],
            'path'
        );
    }
}
