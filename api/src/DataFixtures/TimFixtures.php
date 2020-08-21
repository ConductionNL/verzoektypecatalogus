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
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2b248c60-8449-4a41-ae2d-0dfa9d7cfd71');
        $property = new Property();
        $property->setTitle('aantal keer Afschriften Burgerlijke stand à € 13,80');
        $property->setType('string');
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
        $property->setType('string');
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
        $property->setTitle('bijlagen toevoegen');
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
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cc0ceb38-1273-4668-b750-c4f7da9121b4');
        $property = new Property();
        $property->setTitle('herhaal e-mailadres');
        $property->setType('string');
        $property->setFormat('email');
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
        $id = Uuid::fromString('74125607-0c91-4037-813e-43b87df15972');
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
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).naam.voornamen}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('858eedae-5cab-48ed-94fe-4607af1df047');
        $property = new Property();
        $property->setTitle('achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).naam.geslachtsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cad8e40a-ce4b-4c6d-a702-3d72f7910402');
        $property = new Property();
        $property->setTitle('adres');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.straatnaam}} ' and ' {{commonground_resource(app.user.persoon).verblijfplaats.huisnummer}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d3070f7f-2762-4d8e-b05b-f36183f60a1e');
        $property = new Property();
        $property->setTitle('postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.postcode}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bdd227ca-b2f9-4847-8e40-eaddc070545e');
        $property = new Property();
        $property->setTitle('woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.woonplaatsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6c8ade97-1281-42db-af85-eaeca7385df2');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $property->setRequired(true);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('8de289e5-e361-4639-9b9e-5c2e88493b6b');
        $property = new Property();
        $property->setTitle('herhaal E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $property->setRequired(true);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //section 3
        $id = Uuid::fromString('195c7e03-e3f5-4c71-bf66-b023d9f1bfe9');
        $property = new Property();
        $property->setTitle('maak uw keuze');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['mijn  persoonsgegevens bekijken', 'mijn persoonsgegevens aanpassen of aanvullen', 'mijn persoonsgegevens verwijderen', 'mijn toestemming intrekken', 'mijn persoongegevens overdragen']);
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
        $property->setTitle('bijlagen');
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
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['ja']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

// Aanvraagformulier mantelzorgwaardering

        $id = Uuid::fromString('b5007212-5a5d-4203-ba82-704111ed678a');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('aanvraagformulier mantelzorgwaardering ');
        $requestType->setDescription('Omring regelt de mantelzorgwaardering in opdracht van de gemeente Hoorn. Uw gegevens worden ook gebruikt om u te informeren over ondersteuning voor mantelzorgers. ');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1e pagina
        $id = Uuid::fromString('1fb54451-4622-4c44-93b0-5b47d0718f99');
        $property = new Property();
        $property->setTitle('voor en achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).naam.voornamen}}' and '{{commonground_resource(app.user.persoon).naam.geslachtsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $propberty = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d0322d63-d10f-4463-998e-09b569625c37');
        $property = new Property();
        $property->setTitle('postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.postcode}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f2b28f21-5e46-4221-995d-1db0fe68e307');
        $property = new Property();
        $property->setTitle('huisnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.huinummer}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c515f7b9-a4c9-4c2a-8edd-9d2ebc4afaf7');
        $property = new Property();
        $property->setTitle('huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.huisletter}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cb3f36fb-5d22-4332-bd70-001c5b46d9b4');
        $property = new Property();
        $property->setTitle('huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.huisnummertoevoeging}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('1e4bcf57-da6b-42fe-9a59-b05d6594b5d4');
        $property = new Property();
        $property->setTitle('straatnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.straatnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('19bedf4c-f4c5-4028-8d3d-3b2e8571edeb');
        $property = new Property();
        $property->setTitle('woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.woonplaatsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('8111d8c8-b926-45b0-9676-b62b8822cc30');
        $property = new Property();
        $property->setTitle('telefoonummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3c3d77c4-ebef-41ab-9b7e-8e27c5d57dcb');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // 2e pagina
        $id = Uuid::fromString('16dde21d-f1ee-44af-a3b5-ee9c8fe18da2');
        $property = new Property();
        $property->setTitle('voor en achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('25ff8ecc-2ac1-4fa5-8098-114997107092');
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

        $id = Uuid::fromString('5b5c484a-c0ce-4567-9679-391cc50c0bc4');
        $property = new Property();
        $property->setTitle('huisnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('5c6ee285-b370-4197-b065-51dc6f78548d');
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

        $id = Uuid::fromString('d56aa23a-827a-42e8-9156-8521bc5073d9');
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

        $id = Uuid::fromString('1e650eb8-df71-42f2-b986-02d4457c9c1c');
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

        $id = Uuid::fromString('3d4eede1-2607-4c50-839d-0f759137ae07');
        $property = new Property();
        $property->setTitle('woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3f83b803-ad8a-4788-b996-d163fad3b124');
        $property = new Property();
        $property->setTitle('telefoonummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d3fd1220-97a7-4b9c-a14a-ce1d234801fd');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e2db271d-349f-40f9-b2ef-b89c555a1416');
        $property = new Property();
        $property->setTitle('E-relatie met verzorger');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3e pagina
        $id = Uuid::fromString('86906596-ab1a-43bc-bd15-36cf3e71d78c');
        $property = new Property();
        $property->setTitle('aantal uur per week');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d001466a-660b-4132-bbce-190e542f4bd5');
        $property = new Property();
        $property->setTitle('omschrijving van de activiteiten');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //4e pagina
        $id = Uuid::fromString('1bebc7fc-ef67-4a2b-9999-628ea747a64d');
        $property = new Property();
        $property->setTitle('zijn de gegevens juist ingevult?');
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

        // formulier aanspraakelijk stellen
        $id = Uuid::fromString('60f392ca-fdf7-497c-baef-6dfb44f1a56d');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('formulier aanspraakelijk stellen');
        $requestType->setDescription('met dit formulier kunt u schade aanspraakelijk stellen voor de gemeente');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1e pagina
        //belangrijke informatie
        //Voor het invullen heeft u nodig:

        //DigiD.
        //Bijlage(n) om uw verhaal duidelijk te maken. Bijvoorbeeld: foto's, tekening van de situatie, offerte, nota of kassabon.
        //inloggen via digiD

        //2e pagina uw gegevens
        $id = Uuid::fromString('b93ed2e5-28ea-4ea6-af32-2ff4e6f588c9');
        $property = new Property();
        $property->setTitle('voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).naam.voornamen}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6442816e-4657-4eb2-9d1b-ace895d01bd0');
        $property = new Property();
        $property->setTitle('achternamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).naam.geslachtsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('0f7117f2-91bf-4718-99cf-f6334285e03e');
        $property = new Property();
        $property->setTitle('adres');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.straatnaam}}' and '{{commonground_resource(app.user.persoon).verblijfplaats.huisnummer}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7a64a89a-ed40-474f-bfda-2e597d55df4f');
        $property = new Property();
        $property->setTitle('postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.postcode}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e778b034-42fd-4675-a3de-98a557273d76');
        $property = new Property();
        $property->setTitle('woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDefaultValue('{{commonground_resource(app.user.persoon).verblijfplaats.woonplaatsnaam}}');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bd8e85ec-5f4d-4dcf-b5b4-3b808460ad3b');
        $property = new Property();
        $property->setTitle('telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('93dd4314-22a6-49e4-aab8-ee2ea6c07703');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d4686644-8093-47d3-b3f8-f32a6843c556');
        $property = new Property();
        $property->setTitle('herhaal E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3e pagina schade
        $id = Uuid::fromString('0aea6d71-cc37-4385-96aa-d0840ec98c63');
        $property = new Property();
        $property->setTitle('op welke datum is uw schade ontstaan?');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('76eef960-8900-4a48-8d4f-e713bf0482b9');
        $property = new Property();
        $property->setTitle('wat is het bedrag van de schade');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('b5d4615e-c4b6-46c4-961a-8bf3d603d8c5');
        $property = new Property();
        $property->setTitle('waar is de schade ontstaan');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('c6a5f469-33ed-45a1-ad97-12f0c8946247');
        $property = new Property();
        $property->setTitle('hoe is de schade ontstaan');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f0cc0767-987b-4aa4-8679-4ef46a8f7e2b');
        $property = new Property();
        $property->setTitle('omschrijf de schade');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7b128adb-c509-4758-83b9-73f4ed90d712');
        $property = new Property();
        $property->setTitle('waarom vind u dat de gemeente uw schade moet vergoeden?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bb217564-0cdc-4e4c-929d-540259eddfb2');
        $property = new Property();
        $property->setTitle('bijlagen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // 4e pagina
        $id = Uuid::fromString('1a195ef3-670b-40f6-8b69-c3f4e35a97d9');
        $property = new Property();
        $property->setTitle('controleren van gegevens');
        $property->setType('boolean');
        $property->setFormat('chechbox');
        $property->setEnum(['ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

    }
}
