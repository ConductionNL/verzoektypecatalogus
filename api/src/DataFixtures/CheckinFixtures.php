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
        $property->setTitle('Contact gegevens');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('55dde78d-4a14-43c6-a0ff-d33b7b5f8bae');
        $property = new Property();
        $property->setTitle('Horeca onderneming contact');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/organizations');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('587babac-f23a-4fb0-8df8-ccd083a079cc');
        $property = new Property();
        $property->setTitle('KHN Nummer');
        $property->setName('khn');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Als u lid bent van koningklijke horeca nederland kunt u hier uw lidmaarschats nummer opvoeren voor korting');
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
        $property->setDescription('Als u het BTW nummer van uw onderneming opgeeft factureren wij zonder BTW');
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('fa79e0cd-2fcd-44bf-84e3-01e9253bdd7b');
        $property = new Property();
        $property->setTitle('Ik ga akkoord met de verwerkingsovereenkomst persoonsgegevens');
        $property->setName('akkoord');
        $property->setType('boolean');
        $property->setFormat('checkbox');
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
        $property->setType('boolean');
        $property->setFormat('checkbox');
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

        /*
      *  Opvragen gegevens door GGD (Checkin)
      */

        $id = Uuid::fromString('b816e7d8-f7e3-4fd4-9e6f-5c5b29072b94');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
        $requestType->setIcon('fa fa-user');
        $requestType->setName('Opvragen gegevens');
        $requestType->setDescription('Via dit process kunt een GGD aanvraag voor bezoekers gegevens aan ons doorgeven zodat wij deze gegevens bij de GGD kunnen aanleveren');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('5fe949b5-6ce7-4394-a4c9-6ae0297dad5d');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setName('datum');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Van welke dag moeten we de bezoekers gegevens overdragen?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $id = Uuid::fromString('7e536da6-cd5b-4141-9ef8-0c14fe5a238a');
        $property = new Property();
        $property->setTitle('GGD');
        $property->setName('ggd');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Welke GGD heeft bij u gegevens opgevraagd?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $id = Uuid::fromString('0e282256-ca2e-494c-8ebc-66839ec7534d');
        $property = new Property();
        $property->setTitle('Contact Persoon GGD');
        $property->setName('contact');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setDescription('Naar wie bij de GGD moeten wij deze gegevens versturen?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $id = Uuid::fromString('6035561c-8d93-40c2-82bb-1ddbf22b84cc');
        $property = new Property();
        $property->setTitle('Ik ga akkoord met de algemene voorwaarden');
        $property->setName('algemenevoorwaarden');
        $property->setIcon('fa fa-building');
        $property->setType('boolean');
        $property->setFormat('checkbox');
        $property->setDescription('Ik ga akkoord met de algemene voorwaarden');
        $property->setRequestType($requestType);
        $property->setRequired(true);

        $id = Uuid::fromString('86ef664f-7ab4-43d7-8bea-8eece272d4ef');
        $property = new Property();
        $property->setTitle('Ik geef opdracht tot het verstrekken van deze persoonsgegevens');
        $property->setName('opdrachtverstrekking');
        $property->setIcon('fa fa-building');
        $property->setType('boolean');
        $property->setFormat('checkbox');
        $property->setDescription('Ik ga akkoord met de algemene voorwaarden');
        $property->setRequestType($requestType);
        $property->setRequired(true);

        /*
       *  Opvragen gegevens door gebruiker (Checkin)
       */

        $id = Uuid::fromString('39fe2fed-b5dc-42ce-9f9e-64101351b566');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
        $requestType->setIcon('fa fa-user');
        $requestType->setName('Opvragen gegevens');
        $requestType->setDescription('Als u positief getest bent voor covid-19 zal de GGD bij u gegevens opvragen ivm een contact onderzoek. U kunt deze gegevens hier downloaden');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('79c03b9d-204c-4650-a974-6756c06638ea');
        $property = new Property();
        $property->setTitle('e-Mail addres');
        $property->setName('email');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Naar welk e-mail addres wilt u de gegevens uitdraai versturen?');
        $property->setRequestType($requestType);
        $property->setRequired(true);

        $id = Uuid::fromString('bf268ea7-4f08-4730-a5eb-fa6df870a24d');
        $property = new Property();
        $property->setTitle('Ik ga akkoord met de algemene voorwaarden');
        $property->setName('algemenevoorwaarden');
        $property->setIcon('fa fa-building');
        $property->setType('boolean');
        $property->setFormat('checkbox');
        $property->setDescription('Ik ga akkoord met de algemene voorwaarden');
        $property->setRequestType($requestType);
        $property->setRequired(true);
    }
}
