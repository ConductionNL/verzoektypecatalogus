<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TimFixtures extends Fixture
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
        // formulier Inlichtingen BRP / Burgerlijke stand

        $id = Uuid::fromString('d6b1f1ab-82f5-4a0d-b808-b0a63c72a201');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('formulier Inlichtingen BRP / Burgerlijke stand');
        $requestType->setDescription('Advocaten, notarissen en gerechtsdeurwaarders gebruiken dit formulier voor een verzoek om inlichtingen uit de Basisregistratie Personen (BRP) of Burgerlijke stand');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        // wat vraagt u aan?
        $id = Uuid::fromString('898ba684-a579-4690-8a44-42f3bc7c132c');
        $property = new Property();
        $property->setTitle('aantal keer Uittreksels Basisregistratie personen (BRP) à € 8,77');
        $property->setType('integer');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2b248c60-8449-4a41-ae2d-0dfa9d7cfd71');
        $property = new Property();
        $property->setTitle('Afschriften Burgerlijke stand à € 13,80');
        $property->setType('integer');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('fba5b39d-6694-4c53-962a-28529fbbab1d');
        $property = new Property();
        $property->setTitle('aantal keer Nalatenschap / Erfgenamenonderzoek à € 25,64');
        $property->setType('integer');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //bijlage toevoegen
        $id = Uuid::fromString('9b72c217-3186-4378-99b1-48cb74438f81');
        $property = new Property();
        $property->setTitle('bijlage toevoegen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //uw gegevens
        $id = Uuid::fromString('497d75d0-ea61-4d19-b30f-5c60c005dbb8');
        $property = new Property();
        $property->setTitle('inschrijfnummer Kvk');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3805d5d9-4c97-4caf-9513-ddf542259f7c');
        $property = new Property();
        $property->setTitle('vestigingsnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('17e61185-a7eb-49f7-98ff-c88a5acd69a6');
        $property = new Property();
        $property->setTitle('bedrijfsnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2384f44d-4090-4029-b5c3-8c90680daeaf');
        $property = new Property();
        $property->setTitle('postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d4c02cd0-5b42-4351-861e-0cd6b4727bf7');
        $property = new Property();
        $property->setTitle('huisnummer');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6b0444bc-9d09-41c1-a72e-c25ebd5a2f10');
        $property = new Property();
        $property->setTitle('huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7f14b3b4-3e9c-4558-95ab-a6756ebc5326');
        $property = new Property();
        $property->setTitle('huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a6a61256-6ca1-44ef-b1b3-08c62a1a226f');
        $property = new Property();
        $property->setTitle('straatnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('938c3043-656e-4222-9030-a14ce72b3d62');
        $property = new Property();
        $property->setTitle('plaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2d8a9acb-653b-468e-8d0d-d5beb16e1c26');
        $property = new Property();
        $property->setTitle('voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2330c04a-c026-457d-9dc4-91570a14fd32');
        $property = new Property();
        $property->setTitle('tussenvoegsels');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e080e28c-69d0-4a45-be23-f0d8149c1d44');
        $property = new Property();
        $property->setTitle('achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cd93c04c-45f7-431e-9fcd-44006fcc9b5a');
        $property = new Property();
        $property->setTitle('telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('eb5ce9c9-5718-473d-8fc4-2896b1fb5ed5');
        $property = new Property();
        $property->setTitle('E-mail adres');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cc0ceb38-1273-4668-b750-c4f7da9121b4');
        $property = new Property();
        $property->setTitle('herhaal E-mail adres');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a32e1ed1-a03d-445d-a4c1-27d741a3329c');
        $property = new Property();
        $property->setTitle('functie');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cfb6ab81-a98f-4ccc-b96f-524aa4f103d4');
        $property = new Property();
        $property->setTitle('afdeling');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f423d067-1aba-44f3-ac77-3923a6c748c6');
        $property = new Property();
        $property->setTitle('akkoord verklaring');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['akkoord']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //controleren
        $id = Uuid::fromString('f423d067-1aba-44f3-ac77-3923a6c748c6');
        $property = new Property();
        $property->setTitle('naar waarheid ingevult');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // formulier gegevens inzien en aanpassen

        $id = Uuid::fromString('4dcf25f2-c2dc-4a82-8a78-33e4d3d7241d');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('formulier gegevens inzien en aanpassen');
        $requestType->setDescription('hier kunt u uw eigen gegevens aanpassen en/of bekijken');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);


        // section 1  inloggen met digiD

        // section 2
        $id = Uuid::fromString('07a5c63f-faa2-4a50-8d56-6ac29eb2a20e');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('858eedae-5cab-48ed-94fe-4607af1df047');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cad8e40a-ce4b-4c6d-a702-3d72f7910402');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d3070f7f-2762-4d8e-b05b-f36183f60a1e');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bdd227ca-b2f9-4847-8e40-eaddc070545e');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6c8ade97-1281-42db-af85-eaeca7385df2');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('8de289e5-e361-4639-9b9e-5c2e88493b6b');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setType('sting');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //section 3
        $id = Uuid::fromString('f44234ab-1e3e-403e-87a0-6b2945f84969');
        $property = new Property();
        $property->setTitle('maak uw keuze');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['mijn  persoonsgegevens bekijken', 'mijn persoonsgegevens aanpassen of aanvullen',
            'mijn persoonsgegevens verwijderen', 'mijn toestemming intrekken', 'mijn persoongegevens overdragen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // section 4
        $id = Uuid::fromString('a9c105be-3265-4ccb-bd48-c18a571d5fde');
        $property = new Property();
        $property->setTitle('redening voor product of dienst');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('fa528567-6f94-45f6-a2ca-bf8c2ba261a0');
        $property = new Property();
        $property->setTitle('zaaknummers');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1f4f5156-5528-4cdc-b8af-91ea7c60f771');
        $property = new Property();
        $property->setTitle('bijlage');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // section 5 controleren
        $id = Uuid::fromString('f44234ab-1e3e-403e-87a0-6b2945f84969');
        $property = new Property();
        $property->setTitle('maak uw keuze');
        $property->setType('boolian');
        $property->setFormat('checkbox');
        $property->setEnum(['ja']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
    }
}

