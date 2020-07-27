<?php


namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class MarkFixtures extends Fixture
{

    private $commonGroundService;
    private $params;

    public function __construct(CommonGroundService $commonGroundService, ParameterBagInterface $params)
    {
        $this->commonGroundService = $commonGroundService;
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        $id = Uuid::fromString('e0db78d8-8324-46e1-bad8-991bfb11c8f2');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName("Contact formulier");
        $requestType->setDescription('Neem via dit formulier contact met ons op');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //onderwerp contact
        $id = Uuid::fromString('d7d1bd3c-ac1b-4816-8a50-d06f0d5f914f');
        $property = new Property();
        $property->setTitle('Onderwerp');
        $property->setType('string');
        $property->setFormat('string');
        $property->setDescription("Waar gaat uw vraag over?");
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //beschrijving contact
        $id = Uuid::fromString('541240d2-1760-4377-b3bb-f25278c0b09e');
        $property = new Property();
        $property->setTitle('beschrijving');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setDescription("Beschrijf uw vraag");
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //email contact
        $id = Uuid::fromString('825b1050-6dde-4d17-b180-6bde3204364f');
        $property = new Property();
        $property->setTitle('email');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription("wat is uw email adres");
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoon contact
        $id = Uuid::fromString('6aed6cf9-86d5-48fe-af41-57a84e159ffe');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('string');
        $property->setDescription("Uw email adres");
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

    }
}
