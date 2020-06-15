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
            $this->params->get('app_domain') != "zuiddrecht.nl" && strpos($this->params->get('app_domain'), "zuiddrecht.nl") == false &&
            $this->params->get('app_domain') != "zuid-drecht.nl" && strpos($this->params->get('app_domain'), "zuid-drecht.nl") == false &&
            $this->params->get('app_domain') != "huwelijksplanner.online" && strpos($this->params->get('app_domain'), "huwelijksplanner.online") == false
        ) {
            return false;
        }

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

        $id = Uuid::fromString('0e52ed41-1ce6-4e95-add4-1f70a4d92231');
        $property = new Property();
        $property->setTitle('Ceremonie');
        $property->setName('type');
        $property->setIcon('fas fa-ring');
        $property->setType('string');
        $property->setFormat('string');
        $property->setMaxLength('12');
        $property->setMinLength('7');
        $property->setEnum(['trouwen', 'partnerschap', 'omzetten']);
        $property->setRequired(true);
        $property->setDescription('Selecteer een huwelijk of partnerschap?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('35e4e210-33a6-42a0-aff4-9bad5fcb685b');
        $property = new Property();
        $property->setTitle('Partners');
        $property->setIcon('fas fa-user-friends');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('irc/assent');
        $property->setMinItems(2);
        $property->setMaxItems(2);
        $property->setRequired(true);
        $property->setDescription('Wie zijn de getuigen van partner 2?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('e879671d-0b64-4fdf-9422-39896d5139c2');
        $property = new Property();
        $property->setTitle('Plechtigheid  ');
        $property->setIcon('fas fa-glass-cheers');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setRequired(true);
        $property->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('200c0302-b30b-40bf-a8e2-b4b4b033b3f9');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setIcon('fas fa-calendar-day');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Selecteer een datum voor de omzetting naar huwelijk');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b872204f-174a-4305-85f6-93ec7e6823d6');
        $property = new Property();
        $property->setTitle('Locatie');
        $property->setIcon('fas fa-building');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('pdc/offer');
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f569e850-83ea-4a92-a09a-fc18b1fa8b28');
        $property = new Property();
        $property->setTitle('Ambtenaar');
        $property->setIcon('fas fa-user-tie');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
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
        $property->setIri('irc/assent');
        $property->setMinItems(2);
        $property->setMaxItems(4);
        $property->setRequired(true);
        $property->setDescription('Wie zijn de getuigen van partner?');
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
        $property->setMinItems(1);
        $property->setRequired(true);
        $property->setDescription('Wie zijn de getuigen van partner?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('c95d2310-4fab-4a0c-9595-ee27ea88434c');
        $property = new Property();
        $property->setTitle('Overig');
        $property->setIcon('fal fa-file-alt');
        $property->setMinItems(3);
        $property->setMaxItems(3);
        $property->setType('array');
        $property->setMinItems(4);
        $property->setFormat('string');
        $property->setDescription('Graag zouden wij u om wat extra informatie vragen');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8a047a87-61fe-435c-95a8-ffc843a8e362');
        $property = new Property();
        $property->setTitle('Melding ');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('vrc/request');
        $property->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f6231405-373e-4477-9026-265db00601e1');
        $property = new Property();
        $property->setTitle('Betaling ');
        $property->setName('Betalen');
        $property->setIcon('fas fa-cash-register');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('bs/invoice');
        $property->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
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
        $property->setDescription('Zijn bijde parnters op de trouwdatum meerderjarig');
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
        $property->setDescription('Staan bijde partners niet onder curatele');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('3bdbb9f2-937f-4998-a335-ec3cf8901458');
        $property = new Property();
        $property->setTitle('Familiaregraad');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/familiaregraadhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Zijn bijde parnters geen fammilie dichter dan de 4e graad');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b817450a-1e20-4650-9c73-ca31e9153b8d');
        $property = new Property();
        $property->setTitle('schijnhuwelijk');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('ptc/schijnhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Hebben bijde partners aangegeven niet te trouwen onder dwang');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
