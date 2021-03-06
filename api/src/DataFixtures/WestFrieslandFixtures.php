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
        $property->setQuery(['organization'=>'request.properties.gemeente']);
        $property->setFormat('uri');
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
        $property->setQuery(['audience'=>'public', 'products.groups.name'=>'Grafsoorten', 'products.groups.sourceOrganization'=>'{{ request.properties.gemeente }}']);
        $property->setType('string');
        $property->setFormat('uri');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('4153ca80-55df-4a0e-9053-79f7db01bf4a');
        $property = new Property();
        $property->setTitle('Kistmaat');
//        $property->setQuery(['audience'=>'public', 'products.groups.name'=>'Grafsoorten', 'products.groups.sourceOrganization'=>'{{ request.properties.gemeente }}']);
        $property->setType('string');
        $property->setEnum(['De kist valt binnen de standaard afmetingen van 55cm bij 200cm.', 'De kist is groter dan de standaard afmetingen van 55cm bij 200cm.']);
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('03d4460d-ce9b-4d5b-9063-e7856205273d');
        $property = new Property();
        $property->setTitle('Opmerkingen');
//        $property->setQuery(['audience'=>'public', 'products.groups.name'=>'Grafsoorten', 'products.groups.sourceOrganization'=>'{{ request.properties.gemeente }}']);
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(false);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

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
        $property->setMaxDate('P21D');
        $property->setConfiguration([
            'startingHour'  => 'P9H',
            'endingHour'    => 'P17H',
            'optionDuration'=> 'P2H',
        ]);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('8f9adb13-d5e0-40de-a08c-a2ce5a648b1e');
        $property = new Property();
        $property->setTitle('Artikelen');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.name'=>'Grafartikelen', 'products.groups.sourceOrganization'=>'{{ request.properties.gemeente }}']);
        $property->setType('array');
        $property->setFormat('uri');
        $property->setRequired(false);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('7c212e0e-46dc-4ce0-8cec-8fd0d2d2c99b');
        $property = new Property();
        $property->setTitle('Grafnummer of grafnaam');
        $property->setDescription('In het geval van een bijzetting dient u het graf waarin dient te worden bijgezet te identificeren met een grafnummer of naam van reeds geplaatste overledenen');
        $property->setRequired(false);
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('24d3e05d-26c2-4adb-acd4-08bde88b4526');
        $property = new Property();
        $property->setTitle('Aanvrager/Rechthebbende');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('irc/assents');
        $property->setMaxItems(1);
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('8110dc29-7b27-448e-8853-a8126c984ccb');
        $property = new Property();
        $property->setTitle('Contactpersoon');
        $property->setDescription('Wie is het  contact persoon voor deze begravenis? e.g. uitvaart ondernemer of begravenisleider');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('baf2d8a5-250a-44f8-9a05-55af004d5d4f');
        $property = new Property();
        $property->setTitle('Factuur persoon');
        $property->setDescription('Naar wie moet de factuur worden gestuurd voor deze begravenis');
        $property->setType('string');
        $property->setFormat('url');
        $property->setConfiguration(['email'=>true, 'telephone'=>true, 'givenName'=>true, 'familyName'=>true, 'address'=>true]);
        $property->setIri('cc/people');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('dfc4b51d-f1ea-4137-8451-e18f5b58bb80');
        $property = new Property();
        $property->setTitle('Factuur address');
        $property->setDescription('Naar wie moet de factuur worden gestuurd voor deze begravenis');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/addresses');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('db69ce35-4ae1-4aac-936f-bdb5d4d1ff18');
        $property = new Property();
        $property->setTitle('Overledene met bsn');
        $property->setName('OverledeneBsn');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('brp/ingeschrevenpersoon');
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('e532635f-70d2-4a4a-9245-b28d8a4a6ad6');
        $property = new Property();
        $property->setTitle('overledene zonder bsn');
        $property->setName('OverledeneNoBsn');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setConfiguration(['email'=>false, 'telephone'=>false, 'givenName'=>true, 'familyName'=>true, 'birthday'=>true, 'birthplace'=>true]);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queue worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Aanmaken zaak');
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
        $property->setIcon('fas fa-edit');
        $property->setType('string');
        $property->setDescription('');
        $property->setFormat('textarea');
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
