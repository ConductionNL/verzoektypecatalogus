<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LucasFixtures extends Fixture
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
        /* Documenten Inleveren */

        $id = Uuid::fromString('ff3a0263-350f-407a-84d4-bd12e89ce040');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Documenten Inleveren');
        $requestType->setDescription('Heeft u al contact met de gemeente gehad en wilt u aanvullende informatie geven of documenten inleveren? Gebruik dan dit formulier.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('d1ef9c92-06ed-4f2c-9c6d-86247da1edf1');
        $property = new Property();
        $property->setTitle('Kenmerk of zaaknummer en uw toelichting');
        $property->setType('string');
        $property->setDescription('Het kenmerk of zaaknummer vindt u op de brief of in de e-mail van de gemeente.');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1f36f5c1-5b69-4c07-91d9-dd1eac0e18fc');
        $property = new Property();
        $property->setTitle('Document(en) uploaden');
        $property->setType('string');
        $property->setDescription('Maximaal 10 documenten en in totaal maximaal 24 MB.');
        $property->setFormat('file');
        $property->setMaxItems(10);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3df6b0e8-ca2b-4767-add9-72f37f103089');
        $property = new Property();
        $property->setTitle('Voor- en achternaam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('4b570558-9aff-4a96-9304-0b1f1aa933fc');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setDescription('U ontvangt een bevestiging op dit e-mailadres. Dit adres kan gebruikt worden om contact met u op te nemen.');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /* End Documenten Inleveren */
    }
}
