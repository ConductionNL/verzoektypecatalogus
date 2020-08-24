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

        $id = Uuid::fromString('ff3a0263-350f-407a-84d4-bd12e89ce040');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
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

        /* Jeugdlintje */
        $id = Uuid::fromString('466e7a07-1388-40f7-964b-b9d8725d4a60');
        $requestType = new RequestType();
        $requestType->setName('Jeugdlintje aanvragen');
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setDescription('Doe hier een aanvraag voor een jeugdlintje voor iemand in de gemeenschap');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //naam nominee
        $id = Uuid::fromString('58240c06-894b-46b0-a1bf-bb7b1782b9c4');
        $property = new Property();
        $property->setTitle('Naam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //adres nominee
        $id = Uuid::fromString('f52be373-1cda-4361-80c8-e410200c3c70');
        $property = new Property();
        $property->setTitle('Adres:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Postcode en woonplaats
        $id = Uuid::fromString('5843033d-da97-487f-8415-92b3b524e7b3');
        $property = new Property();
        $property->setTitle('Postcode en woonplaats:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum jeugd
        $id = Uuid::fromString('198cc25b-1ce3-4e9b-a468-0796527574b8');
        $property = new Property();
        $property->setTitle('Geboortedatum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //School
        $id = Uuid::fromString('346727c4-2fb6-4fe5-bd5f-edcc209bad43');
        $property = new Property();
        $property->setTitle('School:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //klas
        $id = Uuid::fromString('909cb100-fb61-4829-ae40-de5bf0480746');
        $property = new Property();
        $property->setTitle('Groep/klas:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum aanmelder
        $id = Uuid::fromString('9cca2fd5-1f93-444d-938a-f801aea96e3a');
        $property = new Property();
        $property->setTitle('Geboortedatum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer
        $id = Uuid::fromString('4c268c2f-0a79-4c88-a0dc-beb4c389064b');
        $property = new Property();
        $property->setTitle('Telefoonnummer:');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Emailadres
        $id = Uuid::fromString('57c7dc2c-4ae4-47ef-97ad-af87ed5206a0');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //relatie tussen nomineerder en jeugdige
        $id = Uuid::fromString('fad0ad0c-6b56-4a52-bd65-db0fd630a3d7');
        $property = new Property();
        $property->setTitle('Wat is de relatie tussen de nomineerder en de jeugdige?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //motivatie jeugdlintje
        $id = Uuid::fromString('666f81ee-8ed5-4533-9789-ce68ac34b708');
        $property = new Property();
        $property->setTitle('De jeugdige komt in aanmerking voor een jeugdlintje omdat:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //naam ref1
        $id = Uuid::fromString('185e24de-1f32-4da3-a81c-0993941b8419');
        $property = new Property();
        $property->setTitle('Naam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum ref1
        $id = Uuid::fromString('a0602115-6d16-41c4-97ef-81de1d4a32d9');
        $property = new Property();
        $property->setTitle('Geboortedatum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer ref1
        $id = Uuid::fromString('580ff714-0ce6-4398-93a2-d5a036609c3f');
        $property = new Property();
        $property->setTitle('Telefoonnummer:');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //relatie tussen ref1 en jeugdige
        $id = Uuid::fromString('8f414746-89fe-440b-a3f0-6c920cab48de');
        $property = new Property();
        $property->setTitle('Relatie tot de genomineerde:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //naam ref2
        $id = Uuid::fromString('99fe1089-bdf4-4db1-be70-fcb85d19efdf');
        $property = new Property();
        $property->setTitle('Naam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum ref2
        $id = Uuid::fromString('5a6f7003-ec42-46fd-b595-ff05dbd01f2e');
        $property = new Property();
        $property->setTitle('Geboortedatum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer ref2
        $id = Uuid::fromString('6ee02cdf-b3df-484f-bf6d-d9a309f3f3b0');
        $property = new Property();
        $property->setTitle('Telefoonnummer:');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //relatie tussen ref2 en jeugdige
        $id = Uuid::fromString('313d1d67-20ef-4886-86b8-ca682099a0a4');
        $property = new Property();
        $property->setTitle('Relatie tot de genomineerde:');
        $property->setRequired(true);
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Datum
        $id = Uuid::fromString('e1df079b-22b1-4952-a333-b70384a93f01');
        $property = new Property();
        $property->setTitle('Datum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /* End Jeugdlintje */

        /* Vraag Stellen */
        //Omschrijving
        $id = Uuid::fromString('cf2482fd-5bed-4843-8f54-895cabdf6251');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setName('Vraag stellen');
        $requestType->setDescription('Algemene contactformulier');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3de7512b-1fe0-4c70-8667-d765ef6c1e88');
        $property = new Property();
        $property->setTitle('Uw vraag');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c9e351f1-41c1-4274-af38-ed9f18611cf5');
        $property = new Property();
        $property->setTitle('Upload een bijlage');
        $property->setType('string');
        $property->setFormat('file');
        $property->setMaxItems(10);
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d2dae617-12f2-41d4-b976-e78dd86c08ea');
        $property = new Property();
        $property->setTitle('Zaaknummer of kenmerk');
        $property->setDescription('Heeft u eerder contact gehad over dit onderwerp? Noteer dan het zaaknummer of kenmerk. Dit staat in de e-mail of brief van de gemeente');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
        //End omschrijving
        //Uw gegevens
        $id = Uuid::fromString('66df1173-ccb4-45f6-86e3-689f517a693c');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('147583a4-6a01-4422-9c60-fbe6e705bc3e');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('59d82428-0caf-47eb-a8df-2daf996b8f2f');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('fa4fb441-bc3e-4e4f-8ec0-df5386260917');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3f2a0ecb-5f4f-4519-abc1-857a9b36fe38');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e48c567d-c542-409e-b9dd-3f2934bc874f');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
        //End uw gegevens
        /* End Vraag Stellen */

        /* Kraskaartvergunning aanvragen */
        $id = Uuid::fromString('c64bb62c-670a-4cde-bd29-f50c220a6442');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setName('Kraskaarten');
        $requestType->setDescription('Aanvraag kraskaarten (parkeren voor uw bezoek');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('aa636080-5e9d-4909-80fd-0df8a6cb8754');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('87eec012-befe-45f8-b64d-62f3b2d26f11');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1ec4376e-c5e9-47cf-aa36-617615bf5b28');
        $property = new Property();
        $property->setTitle('Herhaal e-mailadres:');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // parkeertegoed kopen

        $id = Uuid::fromString('bed1d4f6-b16f-414d-a951-1ca7c41be66e');
        $property = new Property();
        $property->setTitle('Machtigingen incasso');
        $property->setDescription('Door ondertekening geek ik toestemming aan Parkeerdiesnten van de gemeente Amsterdam het volgende bedrag van mijn rekening af te schrijven.');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setRequired(true);
        $property->setEnum(['€ 15', '€ 30', '€ 45', '€ 60', '€ 75']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('19f3f27c-ae2f-41b2-874d-883020a7f472');
        $property = new Property();
        $property->setTitle('Automatisch opladen');
        $property->setDescription('Ik wil dat mijn parkeertegoed automatisch wordt verhoogd al is het lager dan.');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setRequired(true);
        $property->setEnum(['€ 15', '€ 30', '€ 45', '€ 60', '€ 75']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2762debf-a021-40c2-8f5b-83c29bb833cc');
        $property = new Property();
        $property->setTitle('Rekeningnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('eace7bd9-8bff-4f6c-badb-e028a338890f');
        $property = new Property();
        $property->setTitle('Naam rekeninghouder');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
        /* END DING */

        /* Starterslening */
        $id = Uuid::fromString('2f3f2c71-f9b0-463d-8cf3-8dc5cdfeeaeb');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $requestType->setName('Starterslening');
        $requestType->setDescription('Starterslening aanvragen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3770c5d1-8f65-4621-96d1-d48fd2edc1bb');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('0ddd501e-e027-425f-a244-fa56f25e2fe8');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('0f733b39-345e-4932-aae3-aac2db039fc2');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Uw aanvraag

        $id = Uuid::fromString('2c039392-2a56-44eb-bccd-abff50a738be');
        $property = new Property();
        $property->setTitle('Is dit uw eerste koopwoning?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3c202c35-e52f-4ff4-8b76-98ab89908453');
        $property = new Property();
        $property->setTitle('Wordt u de enige eigenaar van de woning?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Bestaand of nieuw
        $id = Uuid::fromString('56373990-5ec5-4b38-83ac-b01d8a803e54');
        $property = new Property();
        $property->setTitle('Is het een:');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Nieuwbouw woning', 'Bestaande woning']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Wat is het adres
        $id = Uuid::fromString('6f9aced9-6efe-40ff-b375-2d0b00681cc9');
        $property = new Property();
        $property->setTitle('Postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('9195fc6b-a88b-495e-94d0-ba592f42deaf');
        $property = new Property();
        $property->setTitle('Huisnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('13cfc0b4-c058-4f65-a249-aa0de1b8de1b');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7532c9c8-a1bb-483b-8d77-57756080f9fc');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bef59e64-9bad-41d0-b45d-f8c3dfa64e95');
        $property = new Property();
        $property->setTitle('Straatnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e0037ba7-84ce-4404-bd73-63fc5ce160f0');
        $property = new Property();
        $property->setTitle('Woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Informatie betalen
        $id = Uuid::fromString('50c04e5d-b834-4d52-af52-86f76707b022');
        $property = new Property();
        $property->setTitle('Heeft u een voorlopig koopcontract of voorloping koop/aanneemovereenkomst? Deze is ondertekend door alle partijen.');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('04676a04-a19f-4766-9ead-f01cced3e965');
        $property = new Property();
        $property->setTitle('Sluit u de hypotheek af met Nationale Hypotheek Garantie');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('28c62604-c111-44b2-aab2-9bf9372d4a82');
        $property = new Property();
        $property->setTitle('Kiest u voor een renteperiode van minimaal 10 jaar vast?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('01f523c7-d16b-406f-bae9-b08bab07fb4b');
        $property = new Property();
        $property->setTitle('Wat zijn de totale kosten van de woning?');
        $property->setType('string');
        $property->setExample('€');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6a7eb28c-ac99-4b9c-80d3-0b32c8fcf47d');
        $property = new Property();
        $property->setTitle('Maakt u gebruik van een andere regeling?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
    }
}
