<?php

// Conduction/CommonGroundBundle/Service/RequestTypeService.php

/*
 * This file is part of the Conduction Common Ground Bundle
 *
 * (c) Conduction <info@conduction.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service;

use App\Entity\RequestType;
use Doctrine\ORM\EntityManagerInterface;

class RequestTypeService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function extendRequestType(RequestType $requestType)
    {
        $requestTypesProcessed = [(string) $requestType->getId()];
        $extendedRequest = $requestType->getExtends();
        $propertiesTitles = [];
        while ($extendedRequest) {
            if (in_array((string) $extendedRequest->getId(), $requestTypesProcessed)) {
                throw new \Exception('Request type '.$extendedRequest->getName().'(id:'.(string) $extendedRequest->getId().') has been referenced more then once in this extention, posible loop detected');
            }

            $requestTypesProcessed[(string) $extendedRequest->getId()] = true;

            foreach ($extendedRequest->getProperties() as $property) {
                $propertiesTitles[$property->getTitle()] = true;
                $requestType->extendProperty($property);
            }

            $extendedRequest = $extendedRequest->getExtends();
        }

        return $requestType;
    }
}
