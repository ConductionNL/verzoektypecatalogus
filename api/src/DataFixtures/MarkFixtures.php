<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
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
        //JA/NEE sticker bestellen

        //reqeust type
        $id = Uuid::fromString('7e3998c0-4e9d-41e2-b9dc-f0840efc44d9');
        $requestType = new RequestType();
        $requestType->setName('Ja/Nee sticker bestellen');
        $requestType->setDescription('Bestel via dit formulier een JA/NEE of NEE/NEE sticker.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //type sticker
        $id = Uuid::fromString('c77cb790-7a93-46c6-a280-7f35bb29097f');
        $property = new Property();
        $property->setTitle('Welke sticker wilt u hebben?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['NEE/JA (u krijgt geen reclamedrukwerk, maar wel huis-aan-huisbladen)', 'NEE/NEE (u krijgt geen reclamedrukwerk en geen huis-aan-huisbladen)']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Postcode
        $id = Uuid::fromString('c9ed0d31-6296-4e65-9416-aa2a1c366ecd');
        $property = new Property();
        $property->setTitle('Postcode:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer
        $id = Uuid::fromString('f0ab2b61-2a98-48c0-b984-58ab5fa8568f');
        $property = new Property();
        $property->setTitle('Huisnummer:');
        $property->setType('integer');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer toevoeging
        $id = Uuid::fromString('afcf73a4-9d31-4104-baf2-039c0fae85e2');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //straatnaam
        $id = Uuid::fromString('a48ca6a1-0dbe-4497-9034-8760e407c662');
        $property = new Property();
        $property->setTitle('Straatnaam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Woonplaats
        $id = Uuid::fromString('5fc37fbe-14e8-48cf-ad32-0de22fa3bc57');
        $property = new Property();
        $property->setTitle('Woonplaats:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Emailadres
        $id = Uuid::fromString('825b1050-6dde-4d17-b180-6bde3204364f');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Contactformulier bijzondere bijstand

        //reqeust type
        $id = Uuid::fromString('2d39a167-ea2e-49d9-96aa-fc5d199bd57c');
        $requestType = new RequestType();
        $requestType->setName('Contactformulier bijzondere bijstand');
        $property->setTitle('Contactformulier bijzondere bijstand');
        $requestType->setDescription('Wilt u weten of u in aanmerking komt voor bijzondere bijstand? Dat kan via dit contactformulier.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //textarea reden bijstand
        $id = Uuid::fromString('8835b122-7a8a-4dfc-86d9-e12254e9f676');
        $property = new Property();
        $property->setTitle('Voor welke kosten wilt u bijzondere bijstand aanvragen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer
        $id = Uuid::fromString('52339b15-cd83-4710-b102-c06fc72cd727');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('telefoon nummer:');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Emailadres
        $id = Uuid::fromString('a0162fb5-bf38-4476-b834-dbb298b9ac9f');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //email adres heraald
        $id = Uuid::fromString('91284651-b7a5-4b47-9108-24a7840c035e');
        $property = new Property();
        $property->setTitle('Herhaal e-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        
        //ingevuld naar waarheid
        $id = Uuid::fromString('b2c127a1-c963-46dd-ae77-1a63de2c0b4c');
        $property = new Property();
        $property->setTitle('Zijn alle gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setDescription('Nee, wijzig uw bovenstaande gegevens');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
