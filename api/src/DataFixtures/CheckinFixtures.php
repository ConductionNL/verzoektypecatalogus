<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CheckinFixtures extends Fixture
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
         *  Deelname verzoek horeca ondernemer (Checkin)
         */

        $id = Uuid::fromString('c328e6b4-77f6-4c58-8544-4128452acc80');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
        $requestType->setIcon('fa fa-user');
        $requestType->setName('onboarding');
        $requestType->setDescription('Met dit verzoek kunt u als horeca ondernemer een verzoek tot deelname indienen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('5fe949b5-6ce7-4394-a4c9-6ae0297dad5d');
        $property = new Property();
        $property->setTitle('Naam ondernemer');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setDescription('Vul hier uw gegevens in');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('55dde78d-4a14-43c6-a0ff-d33b7b5f8bae');
        $property = new Property();
        $property->setTitle('Horeca firma contact');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/organization');
        $property->setDescription('Vul hier het adres van uw horeca firma in.');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9e5c34dc-99da-423d-9a88-a4a3875a66fb');
        $property = new Property();
        $property->setTitle('KVK Nummer');
        $property->setName('kvk');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Vul hier het KVK Nummer van uw horeca firma in.');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('41122a46-4788-4ba1-aba9-b48f7f640ef8');
        $property = new Property();
        $property->setTitle('BTW Nummer');
        $property->setName('btw');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Als u het BTW nummer van uw onderneming opgeeft facturen wij zonder BTW');
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3fbb0356-a362-4b70-b914-dd27919ff99c');
        $property = new Property();
        $property->setTitle('Abbonnement');
        $property->setIcon('fa fa-money-check');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('pdc/offer');
        $property->setQuery(['audience'=>'public', 'products.groups.name'=>'Checkin Producten', 'products.name'=>'Abbonnement']);
        $property->setDescription('Kies hier een abbonnement.');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('fa79e0cd-2fcd-44bf-84e3-01e9253bdd7b');
        $property = new Property();
        $property->setTitle('Ik ga akkoord met de verwerkingsovereenkomst persoonsgegevens');
        $property->setName('verwerkingsovereenkomst');
        $property->setIcon('fa fa-building');
        $property->setType('boolean');
        $property->setFormat('checkbox');
        $property->setDescription('Als u het BTW nummer van uw onderneming opgeeft facturen wij zonder BTW');
        $property->setRequestType($requestType);
        $property->setRequired(true);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('ce876e7e-8157-4468-b4ae-f72e04eabb74');
        $property = new Property();
        $property->setTitle('Ik ga akkoord met de algemene voorwaarden');
        $property->setName('algemenevoorwaarden');
        $property->setIcon('fa fa-building');
        $property->setType('boolean');
        $property->setFormat('checkbox');
        $property->setDescription('Als u het BTW nummer van uw onderneming opgeeft facturen wij zonder BTW');
        $property->setRequestType($requestType);
        $property->setRequired(true);

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
    }
}
