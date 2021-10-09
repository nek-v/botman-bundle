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

namespace App\BotMan\Drivers\Generic;

use BotMan\BotMan\Interfaces\DriverInterface;
use BotMan\BotMan\Interfaces\UserInterface;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Symfony\Component\HttpFoundation\Response;

class GenericDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function matchesRequest(): bool
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getMessages(): array
    {
    }

    /**
     * {@inheritdoc}
     */
    public function isConfigured(): bool
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(IncomingMessage $matchingMessage): UserInterface
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getConversationAnswer(IncomingMessage $message): Answer
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = []): self
    {
    }

    /**
     * {@inheritdoc}
     */
    public function sendPayload($payload): Response
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
    }

    /**
     * {@inheritdoc}
     */
    public function hasMatchingEvent(): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function types(IncomingMessage $matchingMessage): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function serializesCallbacks(): bool
    {
    }
}
