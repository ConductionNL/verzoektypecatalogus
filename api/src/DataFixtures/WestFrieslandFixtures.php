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

class WestFrieslandFixtures extends Fixture
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
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        /*
         *  Begraven
         */

        $id = Uuid::fromString('c2e9824e-2566-460f-ab4c-905f20cddb6c');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
//        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc','type'=>'organizations','id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setIcon('fa fa-headstone');
        $requestType->setName('begrafenisplanner');
        $requestType->setDescription('Met dit verzoek kunt u een begrafenis plannen');
        $requestType->setCaseType('https://openzaak.dev.westfriesland.commonground.nu/catalogi/api/v1/zaaktypen/f4bc3fee-6b58-4e2a-856a-f0d5e9d15c3b');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $template = new \App\Entity\Template();
        $template->setName('HO Akte');
        $template->setDescription('Ho Akte test document');
        $template->setType('word');
        $template->setUri($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'3807993a-ed98-4570-8a05-09c9454bcac5']));
        $template->setRequestType($requestType);
        $manager->persist($template);
        $manager->flush();

        $template = new \App\Entity\Template();
        $template->setName('Ontvangs bevestiging');
        $template->setDescription('Ontvangs bevestiging voor verzoeken');
        $template->setType('pdf');
        $template->setUri($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'7a3d7d9a-269f-4699-a622-2ad0114d8e86']));
        $template->setRequestType($requestType);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('72fdd281-c60d-4e2d-8b7d-d266303bdc46');
        $property = new Property();
        $property->setTitle('Gemeente');
        $property->setIcon('fa fa-headstone');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('wrc/organizations');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('bdae2f7b-21c3-4d88-be6d-a35b31c13916');
        $property = new Property();
        $property->setTitle('Begraafplaats');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('grc/cemetery');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3b6a637d-19c6-4730-b322-c03d0d8301b6');
        $property = new Property();
        $property->setTitle('Soort graf');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'17c09fb9-a3a1-4fc9-9617-5ebcf73e06cc']);
        $property->setType('string');
        $property->setFormat('url');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('b1fd7b38-384b-47ec-a0f2-6f81949cdece');
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

        $id = Uuid::fromString('8f9adb13-d5e0-40de-a08c-a2ce5a648b1e');
        $property = new Property();
        $property->setTitle('Artikelen');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.id'=>'9f9a78cb-f708-447f-8795-23f6cf13c39d']);
        $property->setRequired(false);
        $property->setType('array');
        $property->setFormat('string');
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('24d3e05d-26c2-4adb-acd4-08bde88b4526');
        $property = new Property();
        $property->setTitle('Belanghebbende');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('irc/assent');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('db69ce35-4ae1-4aac-936f-bdb5d4d1ff18');
        $property = new Property();
        $property->setTitle('Overledene');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('brp/ingeschrevenpersoon');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queue worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Aaanmaken zaak');
        $task->setDescription('Deze task maakt bij het creaëren van een begravenis meteen een zaak aan');
        $task->setCode('start_zaak_begraven');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('create');
        $task->setTimeInterval('P0D'); // We zetten een vertraging van nul minuten zodat de taka meteen wordt uitgevoerd

        $manager->persist($task);

        $id = Uuid::fromString('5223c58e-75a5-4a9d-86ca-47b77b4656e8');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setIcon('fa fa-edit');
        $requestType->setName('Wijzigings verzoek');
        $requestType->setDescription('Met dit verzoek kunt u een reeds in behandeling zijnd verzoek wijzigen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('6c5e6a94-1b31-4db3-97a7-c9a0bb3e6eda');
        $property = new Property();
        $property->setTitle('Wijziging');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setDescription('wat wil u wijzigen aan uw verzoek');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('5013042b-ffab-4933-9fd8-edfbc0c82b22');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setIcon('fa fa-hand-paper');
        $requestType->setName('Bezwaar');
        $requestType->setDescription('Met dit verzoek kunt bezwaar maken tegen de uitkomst van een procedure');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('efc8430d-73b5-44ae-a217-d95b663b7d09');
        $property = new Property();
        $property->setTitle('Argumentatie');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setDescription('waarom maakt u bezwaar?');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
    }
}
