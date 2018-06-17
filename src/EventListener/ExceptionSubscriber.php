<?php

namespace Hmarinjr\TicTacToe\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Hmarinjr\TicTacToe\Kernel;

/**
 * Class ExceptionSubscriber
 * @package Hmarinjr\TicTacToe\EventListener
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    private $availablesErrorStatusCode = [500, 404, 400, 412];

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        $exceptionData = [
            'message' => $exception->getMessage(),
        ];

        if (getenv('APP_ENV') === 'dev') {
            $exceptionData['file'] = $exception->getFile();
            $exceptionData['line'] = $exception->getLine();
            $exceptionData['stacktrace'] = $exception->getTrace();
        }

        $statusCode = !in_array($exception->getCode(), $this->availablesErrorStatusCode) ? 500 : $exception->getCode();


        $response = new JsonResponse($exceptionData, $statusCode);
        $event->setResponse($response);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
