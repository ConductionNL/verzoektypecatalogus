<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuiddrechtFixtures extends Fixture
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
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false &&
            $this->params->get('app_domain') != 'huwelijksplanner.online' && strpos($this->params->get('app_domain'), 'huwelijksplanner.online') == false
        ) {
            return false;
        }

        /*
         * Parkeer Vergunning
         */

        $id = Uuid::fromString('f86591ef-6964-412b-84de-261fd47c3288');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-parking processIcon');
        $requestType->setOrganization('002220647');
        $requestType->setName('Parkeer vergunning');
        $requestType->setDescription('Met dit procces start u de aanvraag voor een parkeer vergunning');
        $requestType->setCaseType('https://openzaak.dev.zuid-drecht.nl/catalogi/api/v1/zaaktypen/1fd3595c-8964-4b15-806a-7349e1edb3b1');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('0ab3fbc1-ee3c-40d6-881b-84b5b331710f');
        $property = new Property();
        $property->setTitle('Wat is uw kenteken?');
        $property->setIcon('fas fa-parking');
        $property->setType('string');
        $property->setFormat('rdw');
        $property->setRequired(true);
        $property->setDescription('Wat is uw kenteken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('92461726-dc0a-4132-a466-4968a37f4620');
        $property = new Property();
        $property->setTitle('Parkeergelegenheid');
        $property->setIcon('fas fa-parking');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setDescription('Is er een eigen parkeergelegenheid bij uw woning?');
        $property->setEnum(['Ik heb een eigen parkeergelegenheid', 'Alle parkeergelegenheden zijn in gebruik', 'Ik heb geen eigen parkeergelegenheid bij mijn woning']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3539cb5f-6801-4f45-838f-9c592946a592');
        $property = new Property();
        $property->setTitle('Vergunning oud adres');
        $property->setIcon('fas fa-parking');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setDescription('Ik heb een vergunning op mijn oude adres en wil ook een vergunning op mijn nieuwe adres:');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('a719f9c2-4565-488e-b0dd-f153fb6f4756');
        $property = new Property();
        $property->setTitle('einddatum vergunning oud adres');
        $property->setIcon('fas fa-parking');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setDescription('Gewenste einddatum vergunning op het oude adres:');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('c3102b38-b07c-4392-8a31-e57d81b39d70');
        $property = new Property();
        $property->setTitle('naam kentekenbewijs');
        $property->setIcon('fas fa-parking');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setDescription('Staat uw naam op het kentenbewijs?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b3ebaedc-578b-43bd-bc7e-91e5a5235de4');
        $property = new Property();
        $property->setTitle('betalen');
        $property->setIcon('fas fa-parking');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setDescription('Hoe wilt u betalen?');
        $property->setEnum(['Automatische incasso', 'Acceptgiro']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('ee8acd31-8a5e-48e9-ac16-0f73543d18c5');
        $property = new Property();
        $property->setTitle('type voertuig');
        $property->setIcon('fas fa-parking');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setDescription('U vraagt een parkeervergunning aan voor een:');
        $property->setEnum(['Huur- of lease-auto', 'BedrijfsAuto', 'Eigen auto']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8f21de59-5c54-4878-a485-6dbb13864619');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw voornaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f39233ba-4a68-4289-856d-ab880d085505');
        $property = new Property();
        $property->setTitle('achternaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw achternaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('415bc891-2d21-42b7-b57e-299038d67eb2');
        $property = new Property();
        $property->setTitle('organisatie');
        $property->setIcon('fas fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de naam van uw organisatie?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3825f835-9880-4022-b6d3-3b322d9a7176');
        $property = new Property();
        $property->setTitle('email');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Wat is uw e-mail adres?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('a10044be-2fde-470c-a705-994ca4b87548');
        $property = new Property();
        $property->setTitle('telefoon');
        $property->setIcon('fas fa-phone');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Wat is uw telefoonnummer?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('c9328302-d02c-4c00-ae7d-c16abef833c5');
        $property = new Property();
        $property->setTitle('geef toestemming');
        $property->setIcon('fas fa-check');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setDescription('Ik geef toestemming voor het eenmalig gebruiken van deze gegevens om contact met mij op te nemen');
        $property->setEnum(['geef toestemming']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         *  Contact Formulier
         */

        $id = Uuid::fromString('3b76447e-1b4b-4b86-a582-8f6b4a5a8c6f');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-question');
        $requestType->setOrganization('002220647');
        $requestType->setName('Contact Formulier');
        $requestType->setDescription('Via dit formulier neemt u contact met ons op');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('4f34ac1b-8c0c-4f3d-b1c4-07e086be43fd');
        $property = new Property();
        $property->setTitle('Onderwerp');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setDescription('waarover gaat uw vraag');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('54b86107-aa93-45ce-a02f-8516390fd92b');
        $property = new Property();
        $property->setTitle('Beschrijving');
        $property->setIcon('fal fa-map-marked');
        $property->setType('text');
        $property->setDescription('Om schrrijv uw vraag');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('78ede193-a0b4-4851-af0d-84252b1903d1');
        $property = new Property();
        $property->setTitle('Product of dienst');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'bbc03703-27b5-442a-9b20-57dfff95be9b']);
        $property->setDescription('Heeft uw vraag betrekking op een product of dienst?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('beb0f9c5-fe0d-4826-84a6-6c91429f3235');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk E-Mail adders kunnen we u bereiken?');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1eb5f485-4e26-489f-a65d-9cf035e5da43');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Op welk telefoon nummer kunnen we u bereiken?');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         *  Balie Afspraak
         */

        $id = Uuid::fromString('32293766-8b3a-43ee-9f16-ed67234ac309');
        $requestType = new RequestType();
        $requestType->setIcon('fas calendar-check');
        $requestType->setOrganization('002220647');
        $requestType->setName(' Balie Afspraak');
        $requestType->setDescription('Via dit formulier kunt u een balie afspraak bij ons inplannen');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('bb4fd6ee-5dce-4b9f-a28a-c566d5542d07');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setIcon('fal fa-calendar-day');
        $property->setType('string');
        $property->setFormat('calendar');
        $property->setDescription('Wanneer wilt u uw afspraak');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1db8bb40-aa1d-4ddd-b4d7-d43c987869cb');
        $property = new Property();
        $property->setTitle('Beschrijving');
        $property->setIcon('fal fa-map-marked');
        $property->setType('text');
        $property->setFormat('textarea');
        $property->setDescription('Om schrrijv uw vraag');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('b90265da-379e-4254-b6df-14f962a68212');
        $property = new Property();
        $property->setTitle('Onderwerp');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'1baea858-1512-454b-ad58-0d30ac5ef10e']);
        $property->setDescription('Heeft uw vraag betrekking op een product of dienst?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3ed36d5b-349f-42f2-a084-f2feb20899be');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setDescription('Op welk E-Mail adders kunnen we u bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c4e88952-bd02-4832-886f-316bcbaf6ed4');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setRequired(true);
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Op welk telefoon nummer kunnen we u bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f20dc701-f24d-428c-865e-8d42aba36224');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw voornaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('488c044f-6263-40ce-b066-1e7ec3c67a59');
        $property = new Property();
        $property->setTitle('achternaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw achternaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('951b9db6-9b13-4188-b583-4b54139b6085');
        $property = new Property();
        $property->setTitle('organisatie');
        $property->setIcon('fas fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de naam van uw organisatie?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8bb40fa5-811b-42ea-8fb9-4a229d81a214');
        $property = new Property();
        $property->setTitle('e-mail');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Wat is uw e-mail adres?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8be2f5a7-e165-45c8-8cae-0969dd314b8d');
        $property = new Property();
        $property->setTitle('telefoonnummer');
        $property->setIcon('fas fa-phone');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Wat is uw telefoonnummer?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('90d34056-b0a4-47a7-bc8b-29501155efd3');
        $property = new Property();
        $property->setTitle('geef toesteming');
        $property->setIcon('fas fa-check');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setDescription('Ik geef toestemming voor het eenmalig gebruiken van deze gegevens om contact met mij op te nemen');
        $property->setEnum(['geef toestemming']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         *  Melding openbare ruimte
         */

        $id = Uuid::fromString('6541d18b-1666-4600-98e3-6f5df1a67423');
        $requestType = new RequestType();
        $requestType->setIcon('fas calendar-check');
        $requestType->setOrganization('002220647');
        $requestType->setName('Melding openbare ruimte');
        $requestType->setDescription('Via dit formulier doet u een melding openbare ruimte');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('67201efb-73e1-4aab-b28f-28ce5c9b5014');
        $property = new Property();
        $property->setTitle('Waar is het:');
        $property->setIcon('fal fa-calendar-day');
        $property->setType('string');
        $property->setFormat('location');
        $property->setDescription('Wat is de locatie van de melding');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2f09a068-410e-4053-983a-604220c4facc');
        $property = new Property();
        $property->setTitle('Waar gaat het om:');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('text-area');
        $property->setDescription('waarover gaat uw vraag');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

//        $id = Uuid::fromString('a6d1c29b-90dc-43de-824b-f0673db3893b');
//        $property = new Property();
//        $property->setTitle('Afbeelding');
//        $property->setIcon('far fa-images');
//        $property->setType('string');
//        $property->setFormat('file');
//        $property->setDescription('Upload een foto waar deze melding over gaat');
//        $property->setRequired(true);
//        $property->setRequestType($requestType);
//        $manager->persist($property);
//        $property->setId($id);
//        $manager->persist($property);
//        $manager->flush();
//        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e7ffde88-60cc-41a7-a670-42ec4e8d17b8');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setDescription('Op welk E-Mail adres kunnen we u bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('b82581b4-04d5-4d9a-8b3f-90646505bf80');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setRequired(true);
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Op welk telefoon nummer kunnen we u bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         *  Geboorte aangifte
         */

        $id = Uuid::fromString('504b2a88-223f-4e35-8043-f061ea8a6623');
        $requestType = new RequestType();
        $requestType->setIcon('fal fa-baby');
        $requestType->setOrganization('002220647');
        $requestType->setName('Geboorte aangifte');
        $requestType->setDescription('Het aangeven van een nieuw geboren kind');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('2c4446ed-1b3a-42c4-86bd-2587f010895b');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setIcon('fal fa-calendar-day');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de geboorte datum?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('467d0c0e-6533-46fa-8ff5-2508e40cca65');
        $property = new Property();
        $property->setTitle('Ouders');
        $property->setIcon('fal fa-user-friends');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('irc/assents');
        $property->setDescription('Wie zijn de ouders');
        $property->setMinItems(2);
        $property->setMaxItems(2);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c00cacae-1edd-44dc-bda2-9eb0c970318e');
        $property = new Property();
        $property->setTitle('Naam');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de naam van het kind?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         *  Huwelijk
         *
         *  Dit is het opgeschoonde en iets samengetrokken huwelijks verzoek van west-friesland
         */

        $id = Uuid::fromString('d0badfff-1c90-4ddb-80fc-49842d806eaa');
        $requestType = new RequestType();
        $requestType->setIcon('fal fa-rings-wedding');
        $requestType->setOrganization('002220647');
        $requestType->setName('Huwelijk / Partnerschap');
        $requestType->setDescription('Met dit procces start u de reservering voor een huwelijk of partnerschap');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Verlopen reservering');
        $task->setDescription('Deze task controleerd na 5 dagen het verlopen van de reservering');
        $task->setCode('start_huwelijk');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('update');
        $task->setTimeInterval('P5D');

        $manager->persist($task);

        $id = Uuid::fromString('81ea285b-41c1-43ae-80f6-a8dc3c6825ff');
        $property = new Property();
        $property->setTitle('Ceremonie');
        $property->setName('type');
        $property->setIcon('fas fa-ring');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setMaxLength('12');
        $property->setMinLength('7');
        $property->setEnum(['trouwen', 'partnerschap']);
        $property->setRequired(true);
        $property->setDescription('Wat wilt u doen?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('963162eb-c4b7-42f2-9b37-b8bcbf84117a');
        $property = new Property();
        $property->setTitle('Partners');
        $property->setIcon('fas fa-user-friends');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('irc/assents');
        $property->setMinItems(2);
        $property->setDefaultValue('{{ app.user.person }}');
        $property->setMaxItems(2);
        $property->setRequired(true);
        $property->setDescription('Wie zijn de partners binnen dit huwelijk / partnerschap?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('d16e3c3b-564b-4d8d-bad2-adb5ffac26ad');
        $property = new Property();
        $property->setTitle('plechtigheid');
        $property->setIcon('fas fa-glass-cheers');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'ea494037-773c-4a32-a363-76857e5f0c46']);
        $property->setRequired(true);
        $property->setDescription('Welke plechtigheid wenst u?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('e85fdb66-f8b6-4ca0-a3fb-32b11aaebcb2');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setIcon('fas fa-calendar-day');
        $property->setType('string');
        $property->setFormat('calendar');
        $property->setDescription('Selecteer een datum voor de voltrekking');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('7a59202e-c830-4a2e-839c-c11a1ce62a6a');
        $property = new Property();
        $property->setTitle('Locatie');
        $property->setIcon('fas fa-building');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'170788e7-b238-4c28-8efc-97bdada02c2e']);
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('Waar wilt u de voltrekking laten plaatsvinden');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('c9937faf-ebc2-438c-b3bb-5590a3c63464');
        $property = new Property();
        $property->setTitle('Ambtenaar');
        $property->setIcon('fas fa-user-tie');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'7f4ff7ae-ed1b-45c9-9a73-3ed06a36b9cc']);
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('Door wie wilt u de plechtigheid laten voltrekken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3a3b2d0e-7d93-4c4b-b313-30f7cdef0c06');
        $property = new Property();
        $property->setTitle('Getuigen');
        $property->setIcon('fas fa-users');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('irc/assents');
        $property->setMinItems(2);
        $property->setMaxItems(4);
        $property->setRequired(true);
        $property->setDescription('Wie zijn de getuigen van de voltrekking?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('e6a8c45c-eae2-48a2-b215-81c3b5bf82df');
        $property = new Property();
        $property->setTitle('Extras');
        $property->setIcon('fas fa-gift');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'f8298a12-91eb-46d0-b8a9-e7095f81be6f']);
        $property->setMinItems(1);
        $property->setRequired(true);
        $property->setDescription('Zijn er nog extra producten of diensten waar u gebruik van wilt maken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('492f4687-71f3-48f0-aad8-70a2f1f3cd1a');
        $property = new Property();
        $property->setTitle('Naamgebruik');
        $property->setIcon('fas fa-ring');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setMaxLength('12');
        $property->setMinLength('7');
        $property->setEnum(['geen wijziging', 'naam partner 1', 'naam partner 2']);
        $property->setRequired(true);
        $property->setDescription('Welke achternaam wilt u gebruiken na de huwelijksvoltrekking');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('d07d6fd3-7118-4e75-9ee6-407d494e1613');
        $property = new Property();
        $property->setTitle('Taal');
        $property->setIcon('fas fa-ring');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setMaxLength('12');
        $property->setMinLength('7');
        $property->setEnum(['nederlands', 'frans', 'engels']);
        $property->setRequired(true);
        $property->setDescription('In welke taal wilt u de plechtigheid voltrekken');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8a047a87-61fe-435c-95a8-ffc843a8e362');
        $property = new Property();
        $property->setTitle('Opmerkingen ');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setDescription('Heeft u nog opmerking die u graag wil meegeven');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('d46c0a9c-b6db-40da-af77-09f0037def57');
        $property = new Property();
        $property->setTitle('Melding');
        $property->setIcon('fas fa-envelope');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setDescription('Wilt u met deze reservering tevens uw melding voorgenomen huwelijk (her) indienen?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('c6e36d7e-90fc-4da0-9acb-7932e3b956ae');
        $property = new Property();
        $property->setTitle('Betaling');
        $property->setName('Betalen');
        $property->setIcon('fas fa-cash-register');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('bs/invoice');
        $property->setDescription('Heeft er reeds een betaling plaatsgevonden');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3f88d380-60a8-4ff1-a805-833f6fc2046c');
        $property = new Property();
        $property->setTitle('Reserveren ');
        $property->setIcon('fas fa-calendar-check');
        $property->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('2b609e92-6e6e-4897-b9e5-4c93b94470b6');
        $property = new Property();
        $property->setTitle('Bestelling');
        $property->setName('order');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('orc/order');
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b78aa4a3-e3f1-4b42-aeb8-31ccc6e65e39');
        $property = new Property();
        $property->setTitle('Leeftijd');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/leeftijdscheckhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Zijn beide partners op de trouwdatum meerderjarig');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('a2950dbb-8c93-485b-af9d-885cd721a971');
        $property = new Property();
        $property->setTitle('Curatele');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/curatelecheckhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Staan beide partners niet onder curatele');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3bdbb9f2-937f-4998-a335-ec3cf8901458');
        $property = new Property();
        $property->setTitle('Familiare graad');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/familiaregraadhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Zijn beide partners geen familie dichter dan de 4e graad');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b817450a-1e20-4650-9c73-ca31e9153b8d');
        $property = new Property();
        $property->setTitle('Schijnhuwelijk');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('ptc/schijnhuwelijk');
        $property->setMinItems(2);
        $property->setMaxItems(2);
        $property->setRequired(true);
        $property->setDescription('Hebben beide partners aangegeven niet te trouwen onder dwang');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);

        /*
         *  Chatbot Fixtures
         */

        /*
         *  Vermissingsformulier reisdocument
         */
        $id = Uuid::fromString('4695d430-6cc2-4499-add4-a5e45ee84761');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-id-card');
        $requestType->setOrganization('002220647');
        $requestType->setName('Vermissingsformulier reisdocument');
        $requestType->setDescription('Via dit formulier kunt u bij ons aangeven wanneer u uw reisdocument verloren bent');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('1d92bc85-7e4c-4468-9588-44b7de598d8c');
        $property = new Property();
        $property->setTitle('Het verloren document');
        $property->setName('type');
        $property->setIcon('fas fa-id-card');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setMaxLength('8');
        $property->setMinLength('7');
        $property->setEnum(['Id kaart', 'paspoort']);
        $property->setRequired(true);
        $property->setDescription('Welk document bent u verloren?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f37dad7b-d7f4-4493-b9ba-814b0b0b2a8d');
        $property = new Property();
        $property->setTitle('Contact');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setDescription('Vul hier uw gegevens in');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        /*
         *  Toestemmingsformulier voor reisdocument kind
         */
        $id = Uuid::fromString('2d353bec-54a2-4a3b-81f3-cee6e5a06c99');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-id-card');
        $requestType->setOrganization('002220647');
        $requestType->setName('Toestemmingsformulier voor reisdocument kind');
        $requestType->setDescription('Via dit formulier kunt u toestemming geven voor een reisdocument van een kind');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3daf4dbb-d8e2-4ced-a51e-0f6bf293e410');
        $property = new Property();
        $property->setTitle('Naam familie/accomodatie');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de naam van de familie of accomodatie van het verblijf?');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2942fcd0-84f8-444e-ad12-b668b9c17f8f');
        $property = new Property();
        $property->setTitle('Postcode');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de postcode van het verblijf?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('878be633-f3af-4b4a-a885-a35f54bd49cc');
        $property = new Property();
        $property->setTitle('Plaats');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de plaats van het verblijf??');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('0964c49a-f640-4e2c-a5b8-21060f59d258');
        $property = new Property();
        $property->setTitle('Land');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is het land van het verblijf?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c36b3fed-afed-4e04-80c1-c11d1a04ce7c');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Wat is de de telefoonnummer van het verblijf?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('9411c48c-587c-4b86-b56d-d3241daa9cd5');
        $property = new Property();
        $property->setTitle('Vluchtnummer');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is het vluchtnummer van de vlucht?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('82246844-9a3c-4b35-96d4-e0a843992d3e');
        $property = new Property();
        $property->setTitle('Reisperiode van');
        $property->setIcon('fas fa-calendar-day');
        $property->setType('string');
        $property->setFormat('calendar');
        $property->setDescription('Wat is de startdatum van dit verblijf?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c07374e9-404c-42fa-a62d-e27072a01cd9');
        $property = new Property();
        $property->setTitle('Reisperiode tot');
        $property->setIcon('fas fa-calendar-day');
        $property->setType('string');
        $property->setFormat('calendar');
        $property->setDescription('Wat is de einddatum van dit verblijf?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
                 *  Emigreren naar het buitenland
                 */
        $id = Uuid::fromString('0567df58-aca0-44f7-9efa-3b4585e03fc5');
        $requestType = new RequestType();
        $requestType->setIcon('fal fa-truck-moving');
        $requestType->setOrganization('0000');
        $requestType->setName('Emigratie');
        $requestType->setDescription('Het doorgeven van een emigratie aan een gemeente');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('fc470862-7bf3-41e9-9b98-5f3a7ae9b3bd');
        $property = new Property();
        $property->setStart(true);
        $property->setTitle('Datum');
        $property->setIcon('fal fa-calendar-day');
        $property->setSlug('datum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de emigratie datum?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);

        $id = Uuid::fromString('222d82c9-e281-4cd6-9f5b-b6feaa4e86f3');
        $property = new Property();
        $property->setTitle('Postcode');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de postcode van het land waarnaar u emigreert?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1ee404c5-003d-422c-a061-fd89bc4c47ea');
        $property = new Property();
        $property->setTitle('Plaats');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is de plaats van het land waarnaar u emigreer??');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a0d53f41-5f19-4d5c-b8f0-284e83d78e68');
        $property = new Property();
        $property->setTitle('Land');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is het land waarnaar u emigreer?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('75eefbc2-b628-42f3-9c96-4a7ba10dbc28');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Wat is uw email adres waarop wij u kunnen bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('72c1bd35-f385-4a88-8bb1-0fcd628b2f4c');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Wat is het telefoon nummer waarop wij u kunnen bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1972409b-1262-43c8-ba31-833ab283d171');
        $property = new Property();
        //$property->setId('');
        $property->setTitle('Wie');
        $property->setIcon('fal fa-users');
        $property->setSlug('Emigrerende');
        $property->setType('array');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Wie gaan er emigreren?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);

        /*$id = Uuid::fromString('9d76fb58-0711-4437-acc4-9f4d9d403cdf');
        $verhuizenDenBosh = new RequestType();
        $verhuizenDenBosh->setName('Verhuizen');
        $verhuizenDenBosh->setIcon('fal fa-truck-moving');
        $verhuizenDenBosh->setDescription('Het doorgeven van een verhuizing aan de gemeente \'s-Hertogenbosch');
        $verhuizenDenBosh->setOrganization('001709124');
        $verhuizenDenBosh->setExtends($requestType);
        $manager->persist($verhuizenDenBosh);
        $verhuizenDenBosh->setId($id);
        $manager->persist($verhuizenDenBosh);
        $manager->flush();
        $verhuizenDenBosh = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        //$requestType->setId('');
        $stage1->setTitle('Email');
        $stage1->setIcon('fal fa-envelope');
        $stage1->setSlug('email');
        $stage1->setDescription('Het e-mail addres dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage1->setType('string');
        $stage1->setFormat('email');
        $stage1->setRequired(true);
        $stage1->setRequestType($verhuizenDenBosh);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        //$requestType->setId('');
        $stage2->setTitle('Telefoon');
        $stage2->setIcon('fal fa-phone');
        $stage2->setSlug('telefoon');
        $stage2->setDescription('Het telefoon nummer dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage2->setType('string');
        $stage2->setFormat('string');
        $stage2->setRequired(true);
        $stage2->setRequestType($verhuizenDenBosh);
        $manager->persist($stage2);*/

        /*
         *  BRP-uittreksel aanvragen
         */
        $id = Uuid::fromString('9aa0fcf5-ad95-4e2d-b272-d36656e72a82');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-file-alt');
        $requestType->setOrganization('002220647');
        $requestType->setName('BRP-uittreksel aanvragen');
        $requestType->setDescription('Via dit formulier kunt u bij ons een BRP-uittreksel aanvragen');
        $requestType->setUnique(true);
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('fce828db-1110-4ee7-a828-291517b6bad7');
        $property = new Property();
        $property->setTitle('Contact');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setDescription('Vul hier uw gegevens in');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3c1c8517-03c2-43f1-9ef4-86136ee3aecd');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Wat is uw email adres waarop wij u kunnen bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1d21a50d-dd29-4051-80cd-970d6e793f15');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user-friends');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Wat is het telefoon nummer waarop wij u kunnen bereiken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('fb77df2e-d33e-4956-8aa4-5bb2ba5e75c3');
        $property = new Property();
        $property->setTitle('Opties voor BRP-uittreksel');
        $property->setName('type');
        $property->setIcon('fas fa-id-card');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setMaxLength('50');
        $property->setMinLength('13');
        $property->setEnum(['Internationaal uittreksel BRP', 'Uitreksel BRP',
            'Uitreksel BRP + Adres historie', 'Uitreksel BRP + BSN', 'Uitreksel BRP + Gezinssamenstelling',
            'Uitreksel BRP + Nationaliteit', 'Uitreksel BRP met burgelijke staat en natinaliteit',
            'Uitreksel BRP met vestigingsdatum', 'Uitreksel BRP ouderlijk gezag', ]);
        $property->setRequired(true);
        $property->setDescription('Welke optie van de BRP-uittreksel wilt u?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $manager->flush();
    }
}
