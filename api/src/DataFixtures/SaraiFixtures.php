<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SaraiFixtures extends Fixture
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
        /*
         * Opdracht contact formulier
         */
        $id = Uuid::fromString('47e9675d-fd72-435b-93c9-32aea32815ed');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Contact formulier');
        $requestType->setDescription('Via dit formulier neemt u contact met ons op.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //beschrijving
        $id = Uuid::fromString('708dbd31-4365-47f1-85fa-facde400afcb');
        $property = new Property();
        $property->setTitle('Beschrijving');
        $property->setType('string');
        $property->setFormat('string');
        $property->setDescription('Een beschrijving');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //onderwerp
        $id = Uuid::fromString('0ab6b17e-4020-47f7-9b33-beb10275ba7b');
        $property = new Property();
        $property->setTitle('Onderwerp');
        $property->setType('text');
        $property->setFormat('string');
        $property->setDescription('Het onderwerp');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //email-adres
        $id = Uuid::fromString('91d4faea-2fec-4a48-85f1-4b03a261a56b');
        $property = new Property();
        $property->setTitle('Wat is uw email-adres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Wat is uw email-adres?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Telefoonnummer
        $id = Uuid::fromString('303b4bc2-198d-4fd7-9123-7c736fc45e80');
        $property = new Property();
        $property->setTitle('Wat is uw telefoonnummer?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw telefoonnummer?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         * issue #65
         * Aanmeldformulier: direct zorg aanvragen.
         */

        $id = Uuid::fromString('ffa22c00-6622-4cf3-8e97-682459a28d2d');
        $requestType = new RequestType();
        $requestType->setOrganization('1');
        $requestType->setName('Aanmeldformulier: direct zorg aanvragen');
        $requestType->setDescription('Dit formulier is voor bewoners van Zuid Drecht die zorg en/of ondersteuning nodig hebben.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //wie wilt u aanmelden?
        $id = Uuid::fromString('621a9799-0eb8-4242-b2d5-aa4c7ac5e62b');
        $property = new Property();
        $property->setTitle('Wie wilt u aanmelden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Mijzelf', 'Een ander']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //betreft het een verlinging van de huidige zorg?
        $id = Uuid::fromString('e5b77291-5ba1-49f3-a8c7-0e94a1df0dfe');
        $property = new Property();
        $property->setTitle('Betreft het een verlenging van de huidige zorg?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //hoe komt u bij zuiddrecht terecht
        $id = Uuid::fromString('5e286dc3-c7b8-4f09-8bd0-7daa0db21881');
        $property = new Property();
        $property->setTitle('Hoe komt u bij Zuid Drecht terecht?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Internet', 'Vrienden/Familie', 'Doorverwezen', 'Anders']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer
        $id = Uuid::fromString('56e115f6-aaa4-437f-80f6-252ff4ea0b84');
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

        //E-mailadres
        $id = Uuid::fromString('b8835509-40a0-4d7a-958d-f4c72f726bfe');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //herhaal e-mailardes
        $id = Uuid::fromString('2b22534f-7982-42b6-98d5-c91f5b93eddd');
        $property = new Property();
        $property->setTitle('Herhaal e-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //taal
        $id = Uuid::fromString('688a2e68-55c3-4dde-aaf6-339b918ae137');
        $property = new Property();
        $property->setTitle('Spreekt u Nederlands?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Naam huisarts
        $id = Uuid::fromString('5c3ba3db-bf7a-40d3-8f94-201a885f8df0');
        $property = new Property();
        $property->setTitle('Naam huisarts');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //schoolnaam en contactpersoon
        $id = Uuid::fromString('88f0d590-7fc4-4097-90fa-8406799ea13c');
        $property = new Property();
        $property->setTitle('Schoolnaam en contactpersoon');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //overig
        $id = Uuid::fromString('0d1ffdb0-23cf-4431-8c6e-1db2a88b7e4c');
        $property = new Property();
        $property->setTitle('Overig');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Omschrijf hier in het kort de situatie
        $id = Uuid::fromString('0a2ff1c2-0712-4c08-964e-524b1ad66513');
        $property = new Property();
        $property->setTitle('Omschrijf hier in het kort de situatie');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setDescription('U kunt in een volgend scherm (Overige opmerkingen) ook een bijlage toevoegen.');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Hoe kan Zuid Drecht hierin helpen?
        $id = Uuid::fromString('4276abce-e9b5-4360-a255-1d45a4a94bcc');
        $property = new Property();
        $property->setTitle('Hoe kan Zuid Drecht hierin helpen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Zijn er zorgen over de veiligheid van (één van) de gezinsleden?
        $id = Uuid::fromString('cc9d2eba-b050-46e2-bc90-407e0bde4baf');
        $property = new Property();
        $property->setTitle('Zijn er zorgen over de veiligheid van (één van) de gezinsleden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Bijlagen
        $id = Uuid::fromString('1cbd9f75-6689-405e-9d84-e6459870a941');
        $property = new Property();
        $property->setTitle('Bijlagen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setDescription('Wilt u foto(\'s) en- of document(en) digitaal meesturen naar de gemeente? Kies ‘Bladeren’ om een bestand van uw computer op te zoeken.');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //opmerkingen
        $id = Uuid::fromString('65002f0c-8b16-496f-9298-70e89c08b67f');
        $property = new Property();
        $property->setTitle('Wilt u tot slot nog iets kwijt?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         * Afschrift Burgerlijke Stand
         *
         */

        $id = Uuid::fromString('a535b49a-6a0c-4010-b14d-25b850b32380');
        $requestType = new RequestType();
        $requestType->setOrganization('1');
        $requestType->setName('Afschrift Burgerlijke Stand');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //van welke akte wilt u een afschrift aanvragen?
        $id = Uuid::fromString('c91562a2-87d2-48f2-8aff-acd045116314');
        $property = new Property();
        $property->setTitle('Van welke akte wilt u een afschrift aanvragen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['geboorteakte', 'huwelijksakte', 'partnerschapakte', 'echtscheidingsakte', 'ontbinding/beëindiging partnerschapsregistratie', 'overlijdensakte']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        // akte gemaakt in de gemeente?
        $id = Uuid::fromString('15c6173a-a826-4dae-a2e0-3ba91ec83aa5');
        $property = new Property();
        $property->setTitle('Is de akte gemaakt in de gemeente Zuid Drecht?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboorteakte + overleidingsakte
        $id = Uuid::fromString('f2b68e37-f6d2-447c-a374-0fd9cb68b93e');
        $property = new Property();
        $property->setTitle('Van wie vraagt u het afschrift aan?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['van mijzelf', 'van mijn kind', 'van mijn man, vrouw of partner', 'van mijn ouder']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //persoonsgegevens van de ander
        //voornaam
        $id = Uuid::fromString('eddf6606-e470-4a93-b1dd-00af4f7673c8');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //tussenvoegsel
        $id = Uuid::fromString('320a94f5-8d09-4386-ada8-d0e2b4b03a87');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //achternaam
        $id = Uuid::fromString('b9545eb0-8b83-42ef-84ba-d5f547826bde');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //datum
        $id = Uuid::fromString('d654a2aa-b0de-49e2-9c14-829356e05a59');
        $property = new Property();
        $property->setTitle('Geef de datum van de gebeurtenis op');
        $property->setType('string');
        $property->setFormat('calender');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //als het voor jezelf is.
        $id = Uuid::fromString('320b941f-d295-4fd9-bb50-69bba5b55f78');
        $property = new Property();
        $property->setTitle('Heeft u het afschrift in het buitenland nodig?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setDescription('Voor het buitenland ontvangt u een internationaal uittreksel. Dit is een actuele samenvatting (geen afschrift) van de akte met een toelichting in meerdere talen. Op de voorzijde Nederlands, Frans, Duits en Engels. Op de achterzijde in het Spaans, Italiaans, Turks, Portugees, Grieks en Esperanto.');
        $property->setRequired(true);
        $property->setEnum(['ja', 'nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //als je de afschrift nodig hebt in het buitenland
        $id = Uuid::fromString('4f096b36-23cb-4b29-ac97-08152563e920');
        $property = new Property();
        $property->setTitle('In welke taal heeft u het afschrift nodig?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Nederlands', 'Internationaal']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();


        // uw gegevens
        // telefoonnummer
        $id = Uuid::fromString('ed376dae-ef61-43f4-968f-9fa0f7be507b');
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

        //e-mailadres
        $id = Uuid::fromString('7db65c5a-1443-412e-9342-bfde7d0908ca');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //herhaal emailadres
        $id = Uuid::fromString('78e675c9-f5b0-438d-bc68-9b4edc48a354');
        $property = new Property();
        $property->setTitle('Herhaal e-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();


        /*
         * Leerlingen vervoer wijziging doorgeven
         */

        $id = Uuid::fromString('51665b5d-e727-442c-9b48-cf704d1f958c');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Leerlingen vervoer wijziging doorgeven');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //doorgeven
        //gegevens ouder/verzorger
        //voor- en achternaam
        $id = Uuid::fromString('31cfa8b3-96f2-4af2-8d36-166334f45875');
        $property = new Property();
        $property->setTitle('Voor- en achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer
        $id = Uuid::fromString('7c38580e-bb71-4259-b4dd-76a0e9d60a36');
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

        //e-mailadres
        $id = Uuid::fromString('8b403a94-f257-4664-8191-d72bfba4a9ee');
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

        //gegevens leerling
        //Naam
        $id = Uuid::fromString('bc2434be-bae8-4e5d-992a-522e1306c350');
        $property = new Property();
        $property->setTitle('Naam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum
        $id = Uuid::fromString('50385e5e-d172-467b-a88c-d23fea1381f3');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('calendar');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //school
        $id = Uuid::fromString('684d769d-8e54-4008-b788-a40bb35a98e9');
        $property = new Property();
        $property->setTitle('School');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //wat wilt u doorgeven
        $id = Uuid::fromString('9a59aa5b-c959-4611-b745-04965f1db214');
        $property = new Property();
        $property->setTitle('Wat wilt u doorgeven?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
