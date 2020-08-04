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

        /* Jeugdlintje */
        $id = Uuid::fromString('f74294c8-f7af-4357-a819-738989e1da0b');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Jeugdlintje - neem contact met mij op');
        $requestType->setDescription('Gemeentelijke onderscheidingen (Jeugdlintje)');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7383ba2f-79e3-4419-8ba6-e959c708eb7a');
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

        $id = Uuid::fromString('5f2b3a7f-0c81-4f7a-baeb-7dafa453a23c');
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

        $id = Uuid::fromString('f8623f03-aa64-4a7b-809a-34996192e8e7');
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

        $id = Uuid::fromString('ca88b58c-e791-4b60-9d09-53bb69b64baf');
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

        $id = Uuid::fromString('b17119cc-303e-4f3a-a192-124821b71f3d');
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

        $id = Uuid::fromString('3bf1e76b-0cc7-4e5d-b7d9-1e963f7f7ff5');
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
        /* End Jeugdlintje */

        /* Vraag Stellen */
        //Omschrijving
        $id = Uuid::fromString('cf2482fd-5bed-4843-8f54-895cabdf6251');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
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
        $requestType->setOrganization('002220647');
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
        $property->setRequired(true);
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
        $property->setRequired(true);
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
        $property->setType('boolean');
        $property->setFormat('radio');
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
        $property->setType('boolean');
        $property->setFormat('radio');
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
    }
}
