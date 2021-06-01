<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Service\RequestTypeService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class RequestTypeSubscriber implements EventSubscriberInterface
{
    private $params;
    private $requestTypeService;
    private $serializer;

    public function __construct(ParameterBagInterface $params, RequestTypeService $requestTypeService, SerializerInterface $serializer)
    {
        $this->params = $params;
        $this->requestTypeService = $requestTypeService;
        $this->serializer = $serializer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['getRequestType', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function getRequestType(ViewEvent $event)
    {
        $requestType = $event->getControllerResult();
        $route = $event->getRequest()->get('_route');
        $method = $event->getRequest()->getMethod();
        $extend = $event->getRequest()->query->get('extend');

        if ($extend != 'true' || $route != 'api_request_types_get_item') {
            return $requestType;
        }

        $requestType = $this->requestTypeService->extendRequestType($requestType);

        return $requestType;
    }
}
