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
        $property->setRequired(true);
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
        $property->setRequired(true);
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
        $requestType->setDescription('Vraag hier een afschrift aan');
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
        $property->setFormat('text');
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
        $property->setFormat('text');
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
        $property->setFormat('text');
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
        $property->setFormat('date');
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
        $requestType->setDescription('Geef hier uw leerlingen vervoer wijziging door');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //gegevens doorgeven
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
        $property->setExample('0612345678');
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
        $property->setFormat('date');
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

        /*
         * Buurtbudget aanvragen
         *
         */

        $id = Uuid::fromString('50c4032e-b2d2-4e54-a07a-610832d16252');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Buurtbudget aanvragen');
        $requestType->setDescription('Vraag hier een buurtbudget aan');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //uw gegevens
        //telefoonnummer
        $id = Uuid::fromString('19e542a4-65dd-43fe-b985-e96c71b061a6');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //emailadres
        $id = Uuid::fromString('0f48762c-d6c6-42fe-a682-77c2d047e107');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('email');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //herhaal emailadres
        $id = Uuid::fromString('2c5351c7-5067-4d22-87c8-b147c7497f06');
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

        //doel buurtbudget
        //wilt u een buurtfeest of andere activiteit/initiatief organiseren?
        $id = Uuid::fromString('87bfa6ea-e415-43c5-a822-ddc6fcaa8f66');
        $property = new Property();
        $property->setTitle('wilt u een buurtfeest of andere activiteit/initiatief organiseren?');
        $property->setDescription('Selecteer wat van toepassing is:');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Buurtfeest', 'Andere activiteit/initiatief']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //omschrijving
        $id = Uuid::fromString('a1f9ddf8-f635-4fc2-9058-046e400d79c0');
        $property = new Property();
        $property->setTitle('Geef een korte omschrijving van de activiteit of het initiatief');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //wat wilt u bereiken
        $id = Uuid::fromString('2b81753e-0f31-4378-8769-166fba603331');
        $property = new Property();
        $property->setTitle('Wat wilt u met het budget bereiken?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //wanneer wilt u het uitvoeren?
        $id = Uuid::fromString('f272d9bc-5a3d-4aec-908b-02f53e65b51d');
        $property = new Property();
        $property->setTitle('Wanneer wilt u het uitvoeren?');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //waar vind het plaats?
        $id = Uuid::fromString('7c7fbc27-7a64-4a08-87ac-5355af45b074');
        $property = new Property();
        $property->setTitle('Waar gaat het plaatsvinden?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //de kosten
        //hoeveel gaat het kosten?
        $id = Uuid::fromString('20338510-5cc4-4b1b-af04-da35588ce612');
        $property = new Property();
        $property->setTitle('hoeveel geld gaat het in totaal kosten?');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //voor welk deel van de kosten wilt u aanvraag doen?
        $id = Uuid::fromString('4b7ab9e1-d2f1-4da3-8d4f-6caecd9df58a');
        $property = new Property();
        $property->setTitle('Voor welk deel van de kosten wilt u aanvraag doen?');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //begroting uploaden
        $id = Uuid::fromString('c1c2d389-f2b9-4bbb-9a94-c7e27a072bac');
        $property = new Property();
        $property->setTitle('De begroting uploaden');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //betrokkenheid buurt
        //wat is uw inzet?
        $id = Uuid::fromString('1ae039e9-43e5-4579-9a9b-f188a25d56db');
        $property = new Property();
        $property->setTitle('Wat is uw eigen inzet en/of bijdrage?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //akkoord?
        $id = Uuid::fromString('6d6f8b0c-2446-4043-9e94-3f3d6bf097e1');
        $property = new Property();
        $property->setTitle('Zijn de direct omwonende akkoord?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //uploaden
        $id = Uuid::fromString('4ec4c54e-b841-463d-83bc-8d2559e3c4e0');
        $property = new Property();
        $property->setTitle('Handtekening uploaden');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         *
         * Bouwtekeing opvragen
         */

        $id = Uuid::fromString('ba6093e6-2f51-4d05-b9a2-60dc9ef6fc62');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Bouwtekening opvragen');
        $requestType->setDescription('Vraag hier een bouwtekening op');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //Uw gegevens
        //telefoonnummer
        $id = Uuid::fromString('25eacbe9-31c7-4af4-84cf-a68bec98f77d');
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

        //emailadres
        $id = Uuid::fromString('4b27eeea-7a1e-4660-8b4b-85c8d63b2371');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('email');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //herhaal emailadres
        $id = Uuid::fromString('41728926-f2d0-41b0-8af9-7c787e291206');
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

        //Bouwjaar en type object
        //waar wilt u een bouwtekening van hebben?
        $id = Uuid::fromString('e51124d4-cb5b-48f0-a720-b3144f2d2abc');
        $property = new Property();
        $property->setTitle('waar wilt u een bouwtekening van hebben?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Eén woning', 'Meerdere woningen', 'Iets anders (bijv. bedrijfspand)']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //is het gebouw vóór 1950 gebouwd?
        $id = Uuid::fromString('97c5aa5c-9d03-4401-b95e-debcabe6523e');
        $property = new Property();
        $property->setTitle('Is het gebouw vóór 1950 gebouwd?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //een toelichting
        //Welke tekeningen heeft u nodig?
        $id = Uuid::fromString('2b4e9b1e-b3b4-4a36-ad08-c3d2836ac41c');
        $property = new Property();
        $property->setTitle('Welke tekeningen heeft u nodig?');
        $property->setDescription('Op bouwkundige tekeningen staan de afmetingen en de gebruikte materialen van het gebouw. Op constructietekeningen staan de draagstructuren van het gebouw. Het gaat om de constructieopbouw, palenplan, fundering, vloeren, dakconstructie en/of staalconstructie.');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Bouwkundige tekeningen', 'Bouwkundige en contructie tekeningen']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //postcode
        $id = Uuid::fromString('f17d1d5b-2d0d-4fa6-b674-491dadc5601d');
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

        //huisnummer
        $id = Uuid::fromString('d53aa76f-aad6-42ec-8be7-6f50d8109ef2');
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

        //huisletter
        $id = Uuid::fromString('891ec347-13d9-4d3e-89c1-d7db32b28691');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer toevoeging
        $id = Uuid::fromString('eb1c128b-d4b0-49d2-9a3e-6064027adeef');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //straatnaam
        $id = Uuid::fromString('69be5e95-dbd3-4518-b08d-95bd232c4271');
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

        //woonplaats
        $id = Uuid::fromString('76539609-7734-4f6b-acec-0a91c80e9ffb');
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

        //welke gegevens heeft u nodig?
        //omschrijf
        $id = Uuid::fromString('542f5cfa-e2a8-4e08-99a3-589bb891ef7f');
        $property = new Property();
        $property->setTitle('Omschrijf zo duidelijk en volledig mogelijk');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         *
         * Samenstelling sportvereniging
         */

        $id = Uuid::fromString('1f2fc424-f82d-4505-8731-ac55833d81b3');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Samenstelling sportvereninging');
        $requestType->setDescription('Vul hier de samenstelling van uw sportvereniging in');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //gegevens sportvereniging
        //gegevens kvk
        $id = Uuid::fromString('0dbc66a2-5112-4efd-a094-0a5a8b1bfb23');
        $property = new Property();
        $property->setTitle('Inschrijfnummer KvK');
        $property->setType('string');
        $property->setFormat('kvk');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //bedrijfsgegevens
        //gegevens sportvereniging
        $id = Uuid::fromString('f507af1e-bd2f-47ea-b9b5-306cf2e9836d');
        $property = new Property();
        $property->setTitle('Gegevens sportvereniging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //postcode
        $id = Uuid::fromString('9e738fb2-819e-4c79-8860-07bc6567d6d9');
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

        //huisnummer
        $id = Uuid::fromString('46c291ae-d2e7-48f4-a09c-b41d660e8fb9');
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

        //huisletter
        $id = Uuid::fromString('e41b4e17-b6af-4888-a57b-bd4213843cbd');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer toevoeging
        $id = Uuid::fromString('95e07dc0-0945-40f6-a79f-3686e5d33bea');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //straatnaam
        $id = Uuid::fromString('2b610890-bc38-4553-afa2-4d3fbd45386f');
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

        //plaats
        $id = Uuid::fromString('06329a11-d4f4-4571-a6d6-0a61c3369b75');
        $property = new Property();
        $property->setTitle('Plaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //gegevens secretaris/contact persoon
        //voornamen
        $id = Uuid::fromString('ee598e5b-db66-4f4d-a12b-aee5069a0ca2');
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

        //tussenvoegsel(s)
        $id = Uuid::fromString('e9d11008-fa0a-4c10-b69b-e6b73ec2c78e');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //achternaam
        $id = Uuid::fromString('906309b3-db5c-4299-8957-720e146272e4');
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

        //telefoonnummer
        $id = Uuid::fromString('5e758019-0353-40c5-aef6-95d1b005f24f');
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

        //emailadres
        $id = Uuid::fromString('2f9b19ef-ddb2-4d4d-a76e-4d7c3ef348fb');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('email');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //herhaal emailadres
        $id = Uuid::fromString('a571478f-cc7b-4477-8690-6e05adeb6f03');
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

        //akkoord verklaring
        $id = Uuid::fromString('b75b0eb2-4d97-4cdb-bd33-246195232371');
        $property = new Property();
        $property->setTitle('Akkoord verklaring');
        $property->setDescription('Hiermee verklaar ik dat de opgegeven persoon dit formulier in mag vullen namens bovenstaande rechtspersoon.');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Akkoord']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //aanvullende gegevens
        //sportvereniging
        //tak van sport
        $id = Uuid::fromString('a491c29c-a934-4a12-a406-5d6d96bf20aa');
        $property = new Property();
        $property->setTitle('Tak van sport');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //website
        $id = Uuid::fromString('56e2b968-3792-46c6-b83b-4fae472887af');
        $property = new Property();
        $property->setTitle('Website');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Aantal leden
        //17 jaar
        $id = Uuid::fromString('ee28d427-d9ba-430e-9480-2012ee36fa93');
        $property = new Property();
        $property->setTitle('Sportende leden t/m 17 jaar');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //18 +
        $id = Uuid::fromString('6310acef-9383-4429-abd2-e9adbaf9501c');
        $property = new Property();
        $property->setTitle('Sportende leden + 18 jaar');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //niet sportende leden
        $id = Uuid::fromString('60a681fa-c8ac-4979-b827-2bcfbe99bcb3');
        $property = new Property();
        $property->setTitle('Niet sportende leden');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //postadres
        //postcode
        $id = Uuid::fromString('eb97faac-f858-443c-9feb-62cc63e7657c');
        $property = new Property();
        $property->setTitle('Postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer
        $id = Uuid::fromString('cf5384fb-7644-4f61-8894-5205ee2c830d');
        $property = new Property();
        $property->setTitle('Huisnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisletter
        $id = Uuid::fromString('e5276902-4b3f-45d1-9e27-a32a8f8429b3');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //toevoeging huisnummer
        $id = Uuid::fromString('d74f396b-0986-464a-981d-b361a2fd2aca');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //straatnaam
        $id = Uuid::fromString('5762c643-2942-492e-a50f-657339b059a7');
        $property = new Property();
        $property->setTitle('Straatnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //woonplaats
        $id = Uuid::fromString('aa3bdda0-db77-4c51-ba17-1f08b1b8c730');
        $property = new Property();
        $property->setTitle('Woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //waarheid ingevuld
        $id = Uuid::fromString('9ffad900-28c4-4bc4-b71e-e104c338084e');
        $property = new Property();
        $property->setTitle('Zijn de gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         *
         * Aanvragen tegemoetkoming in schade (planschadevergoeding)
         *
         */

        $id = Uuid::fromString('3bb7a27a-82a0-4e38-afba-b4b3a9de4306');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Aanvragen tegemoetkoming in schade (planschadevergoeding)');
        $requestType->setDescription('Vraag hier een tegemoetkoming in schade aan');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        //ontroerende zaak
        //postcode
        $id = Uuid::fromString('e61264de-4f93-4d75-97a2-a9b8516c0c01');
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

        //huisnummer
        $id = Uuid::fromString('1f4cf91e-6a04-44b6-9e49-d701bfecf7b5');
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

        //huisletter
        $id = Uuid::fromString('819139d1-e660-4bab-bcbf-dd42514872ac');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huisnummer toevoeging
        $id = Uuid::fromString('291e038a-f9db-4b4b-823b-6063f1dadee5');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //straatnaam
        $id = Uuid::fromString('9d9833ba-1d3c-4f68-9c40-a62364f30d83');
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

        //woonplaats
        $id = Uuid::fromString('527241ec-bff9-492f-9e22-e93d1b7a7fd5');
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

        //uw relatie met de ontroerende zaak
        $id = Uuid::fromString('a28e6787-2740-402e-aca3-eff225b711f8');
        $property = new Property();
        $property->setTitle('Wat is uw relatie tot de ontroerende zaak?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Eigenaar', 'Huurder', 'Gemachtigde van de eigenaar', 'Gemachtigde van de huurder']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //welke schade heeft het geleden?
        $id = Uuid::fromString('8c0ffbcc-9e38-451e-b628-a8e8ad1abb50');
        $property = new Property();
        $property->setTitle('Welke schade heeft de ontroerende zaak geleden?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Waardevermindering', 'Inkomensderving']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //uw gegevens
        //telefoonnummer
        $id = Uuid::fromString('7bbd0593-4284-4f2f-a918-3a99670e8136');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setExample('0612345678');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //emailadres
        $id = Uuid::fromString('2ab5126f-af53-4c88-8734-b08fd564994b');
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

        //herhaal e-mailadres
        $id = Uuid::fromString('cf60c928-6b05-44ee-afe5-29909ba441f8');
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

        //de grond van aanvraag
        //schade veroorzakende maatregel
        $id = Uuid::fromString('4970f85e-cc4e-4f05-b8b5-b6e7bee8aecb');
        $property = new Property();
        $property->setTitle('Op grond van welke schadeveroorzakende maatregel wordt de aanvraag gedaan?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Een nieuw bestemmingsplan', 'Een wijziging of uitwerking van een bestaand bestemmingsplan ', 'Een wijziging of uitwerking van een bestaand bestemmingsplan ', 'Tijdelijke afwijking van het bestemmingsplan', 'Een binnenplanse afwijking van het bestemmingsplan ', 'Het binnen een bestemmingsplan stellen van nadere eisen', 'Het afwijken van een beheersverordening',  'Het buiten toepassing verklaren van een beheersverordening', 'Een provinciaal of rijks inpassingsplan (bestemmingsplan)', 'Een bepaling uit de provinciale verordening', 'De aanhouding van een beslissing omtrent een bouw-, sloop- of aanlegvergunning']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //aard van de schade
        //recht op tegemoetkoming
        $id = Uuid::fromString('de2fe24a-4e99-41dc-a7a8-d776c909b739');
        $property = new Property();
        $property->setTitle('Waarom vind u dat u recht heeft op tegemoetkoming in planschade?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Het vervallen of beperken van eigen bouwmogelijkheden', 'Een inbreuk op de privacy door nieuwe bebouwing ', 'Het vervallen van een waardebepalend vrij uitzicht', 'Belemmering van bezonning', 'Onevenredige verslechtering van bereikbaarheid of parkeermogelijkheden ', 'Verslechtering milieuomstandigheden', 'Verslechtering van de situeringswaarde van het eigendom']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //hoogte gevraagde tegemoetkoming
        $id = Uuid::fromString('892a67d9-a1a4-4ebd-bb86-baa772b01bef');
        $property = new Property();
        $property->setTitle('Hoogte gevraagde tegemoetkoming');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //is de schade anderzins vergoed?
        $id = Uuid::fromString('bc564bc6-e47d-413e-b1f8-72c9e7fd72c7');
        $property = new Property();
        $property->setTitle('Is de schade anderzins vergoed?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //zo ja, omschrijf hoe
        $id = Uuid::fromString('4e34f490-1910-4f7a-b0ea-135c347b5b49');
        $property = new Property();
        $property->setTitle('Zo ja, omschrijf hoe');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Als u geen vergoeding in geld wenst, op welke wijze wilt u de schade tegemoetgekomen zien?
        $id = Uuid::fromString('e17baaac-d192-4fad-ade7-9606dff4932d');
        $property = new Property();
        $property->setTitle('Als u geen vergoeding in geld wenst, op welke wijze wilt u de schade tegemoetgekomen zien?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         * Parkeervergunning Incidenteel
         *
         */
        $id = Uuid::fromString('06ede3d9-2146-4250-a06b-00d1d4822a78');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Parkeervergunning Incidenteel');
        $requestType->setDescription('Parkeervergunning Incidenteel aanvragen.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Uw gegevens
        // Telefoonnummer
        $id = Uuid::fromString('89bb3781-56a7-4c3e-b121-1cb2f153badc');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setExample('0612345678');
        $property->setRequired(false);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // E-mailares
        $id = Uuid::fromString('68990cc6-c8bb-4ae0-bf3a-6dcd38eb1577');
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

        // Herhaal e-mailadres
        $id = Uuid::fromString('a736d736-af06-44f4-adde-a6083dc0f3ec');
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

        //vergunning gegevens
        // Kenteken
        //voer het kenteken in
        $id = Uuid::fromString('c7b529a5-a201-457d-b968-6b95254a6a12');
        $property = new Property();
        $property->setTitle('Voer het kenteken in met streepjes tussen de letter/cijfer-combinaties
        (bijvoorbeeld 00-AB-AB of 00-ABC-0)');
        $property->setType('string');
        $property->setFormat('rdw');
        $property->setExample('(00-AB-AB) of (00-ABC-0)');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Vergunningsgegevens
        //waarvoor heeft u een vergunning nodig?
        $id = Uuid::fromString('4214131b-33c6-491d-a1ff-6631855a006d');
        $property = new Property();
        $property->setTitle('Waarvoor heeft u de vergunning nodig?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Gebied
        $id = Uuid::fromString('55c56c50-1f9f-48fc-ba0c-303386bf296c');
        $property = new Property();
        $property->setTitle('Voor welk gebied heeft u de vergunning nodig?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Centrum', 'Noord Holland/ Venenlaankwartier of Grote Waal']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Voor welke periode heeft u de vergunning nodig?
        //De vergunning meot minimaal 1 week en mag maximaal 3 maanden van tevoren aangevraagd worden.
        //De vergunning kan maximaal voor de duur van 1 jaar aangevraagd worden.

        // Vanaf tot en met
        $id = Uuid::fromString('9a5e4cfc-e67e-4163-a516-f1c133e49f59');
        $property = new Property();
        $property->setTitle('Voor welke periode heeft u de vergunning nodig?');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Machtiging stage 3
        // Bankrekeningnummer
        $id = Uuid::fromString('d5eafe00-910e-4f83-9f5b-f17cd9c5ed85');
        $property = new Property();
        $property->setTitle('Bankrekeningnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Op naam van
        $id = Uuid::fromString('380b25c1-9cc5-41e0-90f9-413ad4fef80b');
        $property = new Property();
        $property->setTitle('Op naam van');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Plaats
        $id = Uuid::fromString('4d8bc0b6-f15a-4dba-be8e-8a3ae4ce7d07');
        $property = new Property();
        $property->setTitle('Plaats}');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Akkoord
        $id = Uuid::fromString('fac8ae29-a2ab-4576-88f8-01a68c59d368');
        $property = new Property();
        $property->setTitle('Akkoord');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         *
         * Ligplaats klein bootje
         *
         */

        $id = Uuid::fromString('ebff7783-2a8a-482c-882b-9d478e7d0a12');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Ligplaats klein bootje');
        $requestType->setDescription('Via dit formulier vraagt u een ligplaats voor een klein bootje aan.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Wat is de gewenste locatie ligplaats?
        $id = Uuid::fromString('ca4251ab-8c59-431a-b7c4-22f6805c387c');
        $property = new Property();
        $property->setTitle('Wat is de gewenste locatie ligplaats?');
        $property->setDescription('Hier kunt u aangeven voor welke locatie u een ligplaatsvergunning wenst.');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['de Delft in Overveen - Kennemerpark e.o', 'Houtvaart tussen Aerdenhout en Haarlem - Houtvaartkade en t.h.v. Goudsbloemplein',
            'Leidse Trekvaart en Beukenvaart - Bennebroek -Leidsevaart en Beukenlaan', 'Bennebroekervaart - Bennebroek - t.h.v. Van Lieroppark en Reek en Meerweg',
            'Leidse Trekvaart - Vogelenzang - ten westen en oosten van spoorlijn', 'Bennebroekervaart - Haventje Bennebroek', ]);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //is het een nieuw of bestaand voertuig?
        $id = Uuid::fromString('e509701b-aa0e-420f-8c69-9c0eed109ba0');
        $property = new Property();
        $property->setTitle('Is het een nieuw of bestaand vaartuig?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Nieuw vaartuig', 'Bestaand vaartuig']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //soort vaartuig
        $id = Uuid::fromString('0b234ca7-e3ba-4565-a3e5-fdf51c972a1d');
        $property = new Property();
        $property->setTitle('Soort vaartuig');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //naam vaartuig
        $id = Uuid::fromString('7d4244f3-2deb-44d0-864c-9be410f03c99');
        $property = new Property();
        $property->setTitle('Naam vaartuig');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //lengte vaartuig
        $id = Uuid::fromString('cdb311fb-8304-44b3-b9cb-88b02c0be648');
        $property = new Property();
        $property->setTitle('Lengte vaartuig (in cm)');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //breedte vaartuig
        $id = Uuid::fromString('5020f873-2faf-4391-ba7a-a8e4da22d307');
        $property = new Property();
        $property->setTitle('Breedte vaartuig (in cm)');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //hoogte vaartuig
        $id = Uuid::fromString('594b38f9-229a-453b-87a5-ec448be4375d');
        $property = new Property();
        $property->setTitle('Hoogte vaartuig (in cm)');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //wijze van voorstuwing
        $id = Uuid::fromString('ab94af43-1036-46eb-ba84-fef19275206c');
        $property = new Property();
        $property->setTitle('Wijze van voorstuwing');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //kleur van de boot
        $id = Uuid::fromString('76be117a-26d3-480e-8747-4a104dbca088');
        $property = new Property();
        $property->setTitle('Kleur van de boot');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //kenteken van de boot
        $id = Uuid::fromString('e38cc577-cf07-4a08-ad4e-748c6c18707c');
        $property = new Property();
        $property->setTitle('Kenteken van de boot (indien kentekenplichtig)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //toelichting
        $id = Uuid::fromString('d7ea4d24-23f3-428f-a3d4-a655554eb5d6');
        $property = new Property();
        $property->setTitle('Toelichting');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //akkoord verklaring
        $id = Uuid::fromString('689bec79-a955-4588-b889-3b90bb56147c');
        $property = new Property();
        $property->setTitle('Zijn alle gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //bijlagen
        $id = Uuid::fromString('6356938a-1c34-456d-b006-963028c3aacd');
        $property = new Property();
        $property->setTitle('Foto van de boot');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //telefoonnummer
        $id = Uuid::fromString('47c29397-4509-4d6d-9f26-13695cb68cc5');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //e-mailadres
        $id = Uuid::fromString('28b09e40-99e0-4dd4-be7b-b6e1b0f00f29');
        $property = new Property();
        $property->setTitle('Email-adres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Herhaal e-mailadres
        $id = Uuid::fromString('2c47f95b-b940-4914-b35f-d0b516df29b8');
        $property = new Property();
        $property->setTitle('Email-adres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //status bericht
        $id = Uuid::fromString('9a5cb50d-9556-4154-afd7-ca4613cfed54');
        $property = new Property();
        $property->setTitle('Statusberichten via e-mail op dit e-mailadres ontvangen?');
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
