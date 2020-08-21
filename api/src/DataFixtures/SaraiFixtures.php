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

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('a4932198-7f55-411f-8dd0-cf5d453d744c');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

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

        /*
         * Contactformulier schuldhulpverlening
         *
         */
        $id = Uuid::fromString('16bb609d-cc5e-40ea-b0f9-a0d0b0fdd796');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Contactformulier schuldhulpverlening');
        $requestType->setDescription('Via dit formulier kunt u schuldhulpverlening aanvragen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Voor wie vult u dit formulier in?
        $id = Uuid::fromString('c18e476b-d5b0-43dd-b8a9-3fbfa60379e1');
        $property = new Property();
        $property->setTitle('Voor wie vult u dit formulier in?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Mijzelf', 'Een ander (als bewindvoerder)']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Bent u werkzaam als zelfstandig ondernemer?
        $id = Uuid::fromString('fe566195-405e-43fa-802f-7b9240caf872');
        $property = new Property();
        $property->setTitle('Bent u werkzaam als zelfstandig ondernemer?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Is er sprake van een definitieve datum voor ontruiming/afsluiting?
        $id = Uuid::fromString('1a2b9a41-0d36-4fb7-b57f-b47e90e6df7e');
        $property = new Property();
        $property->setTitle('Is er sprake van een definitieve datum voor ontruiming/afsluiting?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Heeft u een bewindvoerder?
        $id = Uuid::fromString('13116bd7-ffea-452a-969b-e094b42a0695');
        $property = new Property();
        $property->setTitle('Heeft u een bewindvoerder?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Gegevens Bewindvoerder
        //naam
        $id = Uuid::fromString('53ff3d9f-636b-419a-8fde-dda9c504921f');
        $property = new Property();
        $property->setTitle('Naam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //telefoonnummer
        $id = Uuid::fromString('266b6881-9ba3-4a48-a86d-b1700da40269');
        $property = new Property();
        $property->setTitle('Telefoonnummer (overdag bereikbaar)');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Partner
        //Wat is uw burgelijke staat?
        $id = Uuid::fromString('e8716fcf-e8e5-464e-bbc4-72ddf23c5b75');
        $property = new Property();
        $property->setTitle('Wat is uw burgelijke staat?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Gehuwd/geregistreersd partner', 'Samenwonend', 'Niet gehuwd, geregistreerd partner']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //bent u gehuwd/geregistreerd partner onder huwelijkse voorwaarden/partnerschapsvoorwaarden?
        $id = Uuid::fromString('7189aa48-5dc2-4196-b7de-adab3ef17069');
        $property = new Property();
        $property->setTitle('Bent u gehuwd/geregistreerd partner onder huwelijkse voorwaarden/partnerschapsvoorwaarden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Heeft uw partner ook schulden?
        $id = Uuid::fromString('f7fd5290-dce2-4a6a-9bef-be79b8702a8c');
        $property = new Property();
        $property->setTitle('Heeft uw partner ook schulden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. Bijlagen toevoegen
        //Bijlagen versturen
        //kies 'browse' of 'blader' om een bestand van uw computer te zoeken
        $id = Uuid::fromString('d538d3dc-1e16-4a90-94ca-ad5c58e708b1');
        $property = new Property();
        $property->setTitle('kies \'browse\' of \'blader\' om een bestand van uw computer te zoeken');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //4. Toelichting en persoonsgegevens
        //Uw gegevens
        //telefoonnummer
        $id = Uuid::fromString('a19b21d2-c395-45ea-8ec1-0b58ddbbcbc0');
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

        //E-mailadres
        $id = Uuid::fromString('576cb008-a477-4140-9f7b-15e1ce942ab7');
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

        //Herhaal e-mailadres
        $id = Uuid::fromString('a37e98d6-a6fa-4bbc-ba4d-f09e2ea3e6b7');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Toelichting
        //Ruimte voor extra informatie of opmerkingen
        $id = Uuid::fromString('c8bed216-f084-42fa-a52f-9e37f09791c9');
        $property = new Property();
        $property->setTitle('Ruimte voor extra informatie of opmerkingen');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('5fb8c237-a0b3-4c37-9919-75d6c0c05b4e');
        $property = new Property();
        $property->setTitle('Zijn de gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         * Verzoek tot geheimhouding persoonsgegevens
         *
         */
        $id = Uuid::fromString('07486a7d-6bd4-45b4-b3ab-14092267369f');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Verzoek tot geheimhouding persoonsgegevens');
        $requestType->setDescription('Via dit formulier kunt u een verzoek tot geheimhouding van persoonsgegevens aanvragen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. Uw gegevens
        //telefoonnummer
        $id = Uuid::fromString('e7a2839a-18f9-410f-8416-a8fe3e80d77b');
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

        //E-mailadres
        $id = Uuid::fromString('ebe854e0-740b-4762-a2a5-1a77fb8fd487');
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

        //Herhaal e-mailadres
        $id = Uuid::fromString('c7f87212-5af3-40c7-9e78-6e8c29e2843a');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Indienen of Intrekken
        //Wat wilt u doen?
        $id = Uuid::fromString('64c35cbb-a573-49f0-958b-b3f99d257e69');
        $property = new Property();
        $property->setTitle('Wat wilt u doen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Een verzoek tot geheimhouding indienen', 'Een verzoek tot geheimhouding intrekken']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. Indienen
        //Voor wie vraagt u een geheimhouding aan?
        $id = Uuid::fromString('31bb4f0f-709c-48f0-a9f4-0a263aa685f7');
        $property = new Property();
        $property->setTitle('Voor wie vraagt u een geheimhouding aan?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Voor mijzelf', 'Voor mijn kinderen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Gegevens kinderen
        //Vul hier de gegevens in van het kind voor wie u het verzoek indient.

        //formElement maken waarbij je meerdere kinderen kunt toevoegen

        //Persoonsgegevens van kind 1
        //voornamen
        $id = Uuid::fromString('76272572-677e-4070-88c6-52d4dae172e2');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Tussenvoegsels
        $id = Uuid::fromString('70fabe34-a985-49c5-aa8e-36d699ccbc83');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Achternaam
        $id = Uuid::fromString('5cf36c00-2479-4e35-b645-4ca2759187f8');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Geboortedatum
        $id = Uuid::fromString('6e303208-5bb6-4530-96a9-d50a42d2298d');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Geboorteplaats
        $id = Uuid::fromString('9c7f70f3-68a4-4189-8c8f-f0506580e4ff');
        $property = new Property();
        $property->setTitle('Geboorteplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //4. Intrekken
        //Voor wie wilt u de geheimhouding intrekken?
        $id = Uuid::fromString('1fabc8f4-3fa0-4011-adf6-53a9f50aed7f');
        $property = new Property();
        $property->setTitle('Voor wie wilt u de geheimhouding intrekken?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Voor mijzelf', 'Voor mijn kinderen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Gegevens kind(eren)
        //Vul hier de gegevens in van het kind voor wie u het verzoek intrekt.

        //formElement maken waarbij je meerdere kinderen kunt toevoegen

        //Persoonsgegevens van kind 1
        //voornamen
        $id = Uuid::fromString('e121bfdf-4ff4-44aa-99b6-33590d2e257d');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Tussenvoegsels
        $id = Uuid::fromString('4f381e62-c2ed-47e1-bc49-32553d7ada3b');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Achternaam
        $id = Uuid::fromString('436f9826-832f-41a9-b87f-32ae667e2043');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Geboortedatum
        $id = Uuid::fromString('18b4e414-bdcb-47d5-932e-5653fe84431a');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Geboorteplaats
        $id = Uuid::fromString('a097f52a-1688-4d30-bdc2-816f1f040b55');
        $property = new Property();
        $property->setTitle('Geboorteplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('8e169520-a997-4826-a663-0bf672282205');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
        * Fraude melden
        *
        */
        $id = Uuid::fromString('db64d35b-b6da-4cac-af5d-7d4360d0281f');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Fraude melden');
        $requestType->setDescription('Via dit formulier kunt u fraude melden');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. Wat wilt u melden?
        //Wat wilt u melden?
        $id = Uuid::fromString('665d8321-3467-4772-806a-b98538b4c459');
        $property = new Property();
        $property->setTitle('Wat wilt u melden?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Uitkeringsfraude', 'Adres-/woonfraude', 'Zorgfraude', 'Ander soort fraude']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Waarom denkt u dat er sprake is van fraude?
        $id = Uuid::fromString('3a3e1f91-a9d4-4fb3-aed0-191d7e08c738');
        $property = new Property();
        $property->setTitle('Waarom denkt u dat er sprake is van fraude?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Om welk adres/locatie gaat het?
        $id = Uuid::fromString('080bf94d-9cea-43d6-9600-745fcdd5e911');
        $property = new Property();
        $property->setTitle('Om welk adres/locatie gaat het?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Hoeveel personen zijn hierbij betrokken en wat weet u van hen?
        $id = Uuid::fromString('39a51fa1-47db-477d-9ada-7a6d4152347b');
        $property = new Property();
        $property->setTitle('Hoeveel personen zijn hierbij betrokken en wat weet u van hen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wanneer is de fraude volgens u begonnen?
        $id = Uuid::fromString('3e576375-8828-43d2-a0cb-85b558f6ae1a');
        $property = new Property();
        $property->setTitle('Wanneer is de fraude volgens u begonnen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Weet u wanneer er iemand aanwezig is op het adres of locatie?
        $id = Uuid::fromString('70ed113b-0e6c-4b84-be03-d62b148c9fb9');
        $property = new Property();
        $property->setTitle('Weet u wanneer er iemand aanwezig is op het adres of locatie?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Maakt de persoon, over wie u de melding doet, gebruik van voertuigen?
        $id = Uuid::fromString('a0582b8a-e3ad-49b1-94f8-1ef299889b89');
        $property = new Property();
        $property->setTitle('Maakt de persoon, over wie u de melding doet, gebruik van voertuigen?');
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

        //Wat voor soort voertuigen?
        $id = Uuid::fromString('503efffb-0844-4d61-b462-7871612aaaeb');
        $property = new Property();
        $property->setTitle('Wat voor soort voertuigen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Uitkeringsfraude
        //Woont er een partner op dit adres? Zo ja, wie en hoe vaak?
        $id = Uuid::fromString('75b47c21-6c06-4864-b9ae-70d4a4249139');
        $property = new Property();
        $property->setTitle('Woont er een partner op dit adres? Zo ja, wie en hoe vaak?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wat voor werk doet de persoon en wat zijn de werktijden?
        $id = Uuid::fromString('135f3b87-1bea-4f7a-91fd-5f6185e1fc92');
        $property = new Property();
        $property->setTitle('Wat voor werk doet de persoon en wat zijn de werktijden?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Is de persoon regelmatig in het buitenland? Zo ja, welk land en wanneer?
        $id = Uuid::fromString('0e865cf8-cee9-4e47-949a-7d70f41c2891');
        $property = new Property();
        $property->setTitle('Is de persoon regelmatig in het buitenland? Zo ja, welk land en wanneer?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zorgfraude
        //Om wat voor zorg gaat het?
        $id = Uuid::fromString('7a28282d-a53e-4965-a712-876193ddc11a');
        $property = new Property();
        $property->setTitle('Om wat voor zorg gaat het?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Uw gegevens
        //Mag de gemeente contact met u opnemen om extra vragen te stellen over uw melding?
        $id = Uuid::fromString('7d2a2d81-c85d-4edc-b919-a147eb0004a0');
        $property = new Property();
        $property->setTitle('Mag de gemeente contact met u opnemen om extra vragen te stellen over uw melding?');
        $property->setDescription('Anonieme meldingen zijn moeilijker te onderzoeken en op te lossen. Uiteraard worden uw gegevens vertrouwelijk behandeld en alleen gebruikt voor het afhandelen van uw melding.');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee, ik wil anoniem melden']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Uw gegevens
        //Telefoonnummer
        $id = Uuid::fromString('087e09c8-d7ef-4575-8936-75fcb40e0379');
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

        //E-mailadres
        $id = Uuid::fromString('01505a42-5683-4bd1-be36-4d54d16604ef');
        $property = new Property();
        $property->setTitle('E-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Herhaal e-mailadres
        $id = Uuid::fromString('d2299920-9c17-4616-8721-8c591cfd6908');
        $property = new Property();
        $property->setTitle('Herhaal e-mailadres');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('9b9fdd00-19ca-4d24-a80e-157b863c3ea5');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
        * Subsidie verantwoording
        *
        */
        $id = Uuid::fromString('98901f8f-12ed-4dff-b8f2-ff81842e6b19');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Subsidie verantwoording');
        $requestType->setDescription('Via dit formulier kunt u subsidie verantwoording afleggen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. Belangrijk
        //Wat is het aan u verleende subsidiebedrag?
        $id = Uuid::fromString('93dd63c5-df88-441a-922f-fd75763a3ed2');
        $property = new Property();
        $property->setTitle('Wat is het aan u verleende subsidiebedrag?');
        $property->setDescription('Deze kunt u terugvinden op de verleningsbrief');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Uw gegevens
        //Telefoonnummer
        $id = Uuid::fromString('d9aa5bbf-bdb2-42e4-84f4-761dd8d9b354');
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

        //E-mailadres
        $id = Uuid::fromString('d2b15e79-753a-4d43-80c2-fec1ee55060e');
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

        //Herhaal e-mailadres
        $id = Uuid::fromString('9b63971b-5110-49a5-8118-ae2fbc593087');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. Subsidie gegevens
        //Zaaknummer
        //Geef hier het zaaknummer van uw subsidieaanvraag op
        $id = Uuid::fromString('c964d159-abda-4a60-a67e-0b4c7c781561');
        $property = new Property();
        $property->setTitle('Geef hier het zaaknummer van uw subsidieaanvraag op');
        $property->setDescription('Het zaaknummer is een 7-cijferig nummer, deze vindt u terug op alle correspondentie omtrent uw aanvraag.');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Activiteiten
        //Beschrijf de activiteiten die u heeft georganiseerd
        $id = Uuid::fromString('7ba2c95b-2602-4018-9f3c-7ff86a686d47');
        $property = new Property();
        $property->setTitle('Beschrijf de activiteiten die u heeft georganiseerd');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //of selecteer een bestand met beschrijving van de activiteiten waarover de verantwoording gaat
        $id = Uuid::fromString('f555ea71-bd71-4cda-8b90-4b7aecad08b5');
        $property = new Property();
        $property->setTitle('Of selecteer een bestand met beschrijving van de activiteiten waarover de verantwoording gaat');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Verklaring
        //Ik verklaar dat ik de subsidie heb gebruikt volgens de voorwaarden die de gemeente voorschrijft in de beschikking tot subsidieverlening
        $id = Uuid::fromString('eae63b80-247d-4098-a7cd-7d96a19c8eb6');
        $property = new Property();
        $property->setTitle('Ik verklaar dat ik de subsidie heb gebruikt volgens de voorwaarden die de gemeente voorschrijft in de beschikking tot subsidieverlening');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //4. Verantwoording
        //voeg de volgende bijlagen toe
        $id = Uuid::fromString('eb9aa34f-e21f-49b8-ac8e-da82b55e73f4');
        $property = new Property();
        $property->setTitle('voeg de volgende bijlagen toe');
        $property->setDescription('De laatste jaarrekening (als u die niet heeft is een balans ook goed). En het inhoudelijk jaarverslag.');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //5. Opmerkingen
        //Bijlagen algemeen
        //Heeft u nog extra informatie over de subsidie verantwooring dan kunt u dit hier plaatsen
        $id = Uuid::fromString('2deda805-836b-4d3b-a150-3dedaa2071bf');
        $property = new Property();
        $property->setTitle('Heeft u nog extra informatie over de subsidie verantwooring dan kunt u dit hier plaatsen');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //En/of voeg een bestand toe, met uw extra opmerkingen
        $id = Uuid::fromString('6629dd17-edd2-4af0-9f40-9d0b59433fbc');
        $property = new Property();
        $property->setTitle('En/of voeg een bestand toe, met uw extra opmerkingen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('5b08a870-197e-4800-9363-83a6878053a6');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         * Melding geboorteaangifte #94
         *
         */
        $id = Uuid::fromString('ada5a0d4-cd01-45cf-a111-f203de11d82f');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Melding geboorteaangifte');
        $requestType->setDescription('Via dit formulier kunt u een melding van de geboorteaangifte doen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1.belangrijk
        //heeft u al een melding gedaan?
        $id = Uuid::fromString('751b828d-b129-43ed-ac39-9ed7ac86eeec');
        $property = new Property();
        $property->setTitle('Heeft u al een melding gedaan?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Is uw kind geboren in de gemeente?
        $id = Uuid::fromString('b68aeaca-ee68-4547-b7dc-1c2312197c96');
        $property = new Property();
        $property->setTitle('Is uw kind geboren in de gemeente?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wie doet de aangifte?
        $id = Uuid::fromString('303073cf-c20c-43a6-bcfc-7530bbf56983');
        $property = new Property();
        $property->setTitle('Wie doet de aangifte?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Vader of meemoeder', 'Moeder', 'Anders']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Uw gegevens
        //aangever
        //telefoonnummer
        $id = Uuid::fromString('33968884-9455-4baf-afa2-27ed3af0ec08');
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

        //E-mailadres
        $id = Uuid::fromString('6472e7b0-8ba2-484c-8aa8-7689132e11ee');
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

        //Herhaal e-mailadres
        $id = Uuid::fromString('15653af1-8414-492c-b90f-fce3fb0e6a29');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. gegevens kind
        //gegevens kind(eren)
        //waar is uw kind geboren
        $id = Uuid::fromString('09564735-895c-4b85-aaf5-9276bc94a649');
        $property = new Property();
        $property->setTitle('Wie doet de aangifte?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Thuis', 'Ziekenhuis', 'Anders']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //bij antwoord anders
        $id = Uuid::fromString('acce53b8-ecd4-40d2-aaf6-a9b1f91d2fa2');
        $property = new Property();
        $property->setTitle('Locatie van geboorte');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //gegevens kind
        //voornamen
        $id = Uuid::fromString('cb961d90-b178-466c-be95-20762f4963d6');
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

        //tussenvoegsel
        $id = Uuid::fromString('95ce37ea-f048-421c-a585-a109ab24c13a');
        $property = new Property();
        $property->setTitle('Tussenvoegsel(s)');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //achternaam
        $id = Uuid::fromString('861c2d53-2d5d-4efb-ab3a-942866b13f06');
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

        //geboortedatum
        $id = Uuid::fromString('9cd123f4-9650-41b0-95f4-aac9b5790486');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geboortetijd
        $id = Uuid::fromString('abd211ab-905f-4686-a22f-b8387f55c720');
        $property = new Property();
        $property->setTitle('Geboortetijd');
        $property->setType('string');
        $property->setFormat('time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geslacht
        $id = Uuid::fromString('97a79b4f-f767-4c6a-8bed-24b828209664');
        $property = new Property();
        $property->setTitle('Geslacht');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Jongen', 'Meisje']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //knop om een kind toe tevoegen

        //is er een erkenningsakte gemaakt?
        $id = Uuid::fromString('ac106fc3-25ea-4554-9065-54193dea4d52');
        $property = new Property();
        $property->setTitle('Is er een erkenningsakte gemaakt?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja, in de gemeente Zuid-Drecht', 'Ja, in een andere gemeente', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#als er een andere gemeente is ingevoerd
        //Gegevens erkenningsakte
        //Description: Deze gegevens vindt u op de erkenningakte. Neem deze erkenningakte mee de geboorte aangifte.
        //Aktenummer
        $id = Uuid::fromString('dcb9966a-593b-43b5-bbab-f0a139d74c7e');
        $property = new Property();
        $property->setTitle('Aktenummer');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geslachtsnaam kind
        $id = Uuid::fromString('ae500896-ec46-4579-a041-457974afae6d');
        $property = new Property();
        $property->setTitle('Geslachtsnaam kind');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Gekozen voor geslachtsnaam', 'Geslachtsnaam kind is']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#als je geslachtsnaam kind is hebt gekozen
        $id = Uuid::fromString('bd37853a-6e95-4786-ba46-bd5a9a018080');
        $property = new Property();
        $property->setTitle('Geslachtsnaam kind is');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Gemeente waarin de akte is opgemaakt
        $id = Uuid::fromString('2eced491-1787-4fdd-a55a-26be93721d94');
        $property = new Property();
        $property->setTitle('Gemeente waarin de akte is opgemaakt');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Datum waarin de akte is opgemaakt
        $id = Uuid::fromString('33038d0a-95d5-4086-b7cc-f453ed9dcac9');
        $property = new Property();
        $property->setTitle('Datum waarin de akte is opgemaakt');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#misschien een voorbeeld foto van geslachtsnaam kind

        //4. Gegevens ouder
        //Gegevens moeder
        //woont de moeder op hetzelfde adres als de vader of meemoeder?
        $id = Uuid::fromString('fa71df86-6746-48a0-bfb8-71c27f84645e');
        $property = new Property();
        $property->setTitle('Woont de moeder op hetzelfde adres als de vader of meemoeder?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#ja
        //voornamen
        $id = Uuid::fromString('04724836-2dd9-49a5-ba62-75b4ec88c75a');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //achternaam
        $id = Uuid::fromString('9d8cf98d-2dbe-49a8-b59d-9eb9453db9bc');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geboortedatum
        $id = Uuid::fromString('1ab4cc13-981b-4633-8659-05abec39f491');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geboorteplaats
        $id = Uuid::fromString('da1a4e76-3324-4414-87cd-61ccc3b75783');
        $property = new Property();
        $property->setTitle('Geboorteplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#nee en vader/meemoeder
        //voornamen
        $id = Uuid::fromString('e11e7114-8799-4a38-b426-31e5b958fb99');
        $property = new Property();
        $property->setTitle('Voornamen');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //achternaam
        $id = Uuid::fromString('36c34686-94c0-44c8-bb44-a6f70c8f4941');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //postcode
        $id = Uuid::fromString('d3435887-9045-41b5-bf3e-5b4dd0cea46d');
        $property = new Property();
        $property->setTitle('Postcode');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //huisnummer
        $id = Uuid::fromString('e4dee54f-4e24-4831-8ff5-6a4735252934');
        $property = new Property();
        $property->setTitle('Huisnummer');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //huisletter
        $id = Uuid::fromString('c642c292-ea76-49f1-9d4f-fe0ebb649937');
        $property = new Property();
        $property->setTitle('Huisletter');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //huisnummer toevoeging
        $id = Uuid::fromString('b361ac8f-5290-4599-bf27-c6aee9bc9d4e');
        $property = new Property();
        $property->setTitle('Huisnummer toevoeging');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //straatnaam
        $id = Uuid::fromString('20fa5fbb-3338-40b9-84cd-ef0f1c8bb481');
        $property = new Property();
        $property->setTitle('Straatnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Woonplaats
        $id = Uuid::fromString('345f1cfd-ead4-4868-af4b-c69df4a58fbb');
        $property = new Property();
        $property->setTitle('Woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geboortedatum
        $id = Uuid::fromString('a740ca28-e5bc-4623-9d0e-566f1d13da2c');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //geboorteplaats
        $id = Uuid::fromString('28254f99-641e-46f2-b27c-72eb42aca178');
        $property = new Property();
        $property->setTitle('Geboorteplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#moeder
        //Gegevens ouder
        $id = Uuid::fromString('d778b647-a981-4eec-bf5b-2a032f9f41bf');
        $property = new Property();
        $property->setTitle('Is er nog een ouder?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //#ja #nee
        //Woont de andere ouder op hetzelfde adres?
        $id = Uuid::fromString('5252aebf-cc48-4cd4-93a2-ca55a93bfa01');
        $property = new Property();
        $property->setTitle('Woont de andere ouder op hetzelfde adres?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('fb0687eb-d82f-41f0-98c3-0f48c78c80f3');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         * Naamwijziging
         * Advocaat voor jezelf en voor een ander
         *
         */
        $id = Uuid::fromString('b5f7d6a4-9dbf-4767-befe-91c26f1a4d9b');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Akkoord geven naamwijziging advocaat');
        $requestType->setDescription('');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //2. Gegevens advocaat
        // Inloggen met E-herkenning
        //naam
        $id = Uuid::fromString('2d81c6a8-8324-4822-8bc3-ac0bdd1b6fc3');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Voorletters
        $id = Uuid::fromString('9288e000-7538-47fe-9ef7-c9f3b39f2a78');
        $property = new Property();
        $property->setTitle('Voorletters');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Instantie
        $id = Uuid::fromString('ee0de18a-887e-4ec9-a057-8c02cf0964d9');
        $property = new Property();
        $property->setTitle('Instantie');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //postcode
        $id = Uuid::fromString('e5804e0d-af92-44ce-a2f4-db8abb388c47');
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

        //plaats
        $id = Uuid::fromString('f42bf65d-3e39-4723-9909-5199e9f66233');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //adres
        $id = Uuid::fromString('631f408c-8380-45ac-a790-6c58e74fce2e');
        $property = new Property();
        $property->setTitle('Adres');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //telefoonnummer instantie
        $id = Uuid::fromString('35363a74-3778-4bcb-bb45-24be19a5a1b2');
        $property = new Property();
        $property->setTitle('Telefoonnummer instantie');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. Bijlagen en akkoord
        //bijlagen toevoegen
        $id = Uuid::fromString('453f45e0-e1f8-420b-a894-02376c73598a');
        $property = new Property();
        $property->setTitle('Bijlagen toevoegen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Gaat u akkoord met de ingevulde gegevens?
        $id = Uuid::fromString('9899c0f7-1f5f-4144-8506-ba9d949c3b51');
        $property = new Property();
        $property->setTitle('Gaat u akkoord met de ingevulde gegevens?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Akkoord']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        /*
         * Naamswijziging
         * akkoord geven andere ouder
         */
        $id = Uuid::fromString('bea50404-05fb-4e14-a264-3cd0ac6fb745');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Akkoord geven naamwijziging andere ouder');
        $requestType->setDescription('');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //2. Gegevens andere ouder
        //inloggen met digid
        //BSN
        $id = Uuid::fromString('90c0342b-e2ab-45f2-adbb-cc176820a8b9');
        $property = new Property();
        $property->setTitle('BSN');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //voornaam
        $id = Uuid::fromString('03453a36-eff7-496f-a6a8-b53da2fb9097');
        $property = new Property();
        $property->setTitle('Voornaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //achternaam
        $id = Uuid::fromString('952e5055-756e-4120-b82b-ff6baed34986');
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

        //geboortedatum
        $id = Uuid::fromString('008312f9-58b5-443c-8dbc-d03db65ca562');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Bent u akkoord met de bovenstaande verandering?
        $id = Uuid::fromString('9337ada0-9cb7-456d-8bf2-82604cd4b44b');
        $property = new Property();
        $property->setTitle('Bent u akkoord met de bovenstaande verandering?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

      /*
       * Nederlander worden
       *
       */
        $id = Uuid::fromString('19b72d6b-1614-43cd-8ea0-d99d006d0eff');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Nederlander worden');
        $requestType->setDescription('Via dit formulier kunt u aanvragen om een Nederlander te worden ');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. belangrijke informatie
        //section - Antwoord van de gemeente
        //description - U krijgt binnen 5 werkdagen antwoord. U kunt zelf kiezen hoe u dit antwoord krijgt
        //Hoe wilt u antwoord krijgen?
        $id = Uuid::fromString('09b23364-1d7f-4628-9969-4aea0e072b2d');
        $property = new Property();
        $property->setTitle('Hoe wilt u antwoord krijgen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Per e-mail', 'Per post', 'Afspraak in het stadhuis']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2. Uw gegevens
        //voornaam
        $id = Uuid::fromString('90298527-052c-4e9d-a99e-6a1fac71839b');
        $property = new Property();
        $property->setTitle('Voornaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //tussenvoegsel
        $id = Uuid::fromString('1d380f06-10aa-4118-8b77-61231a778b11');
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
        $id = Uuid::fromString('44ec94ec-738b-4f3b-8230-1ae8e5c9acb5');
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

        //postcode
        $id = Uuid::fromString('5262b47f-92b0-496e-896b-79683a64337e');
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
        $id = Uuid::fromString('d99b6cf6-48ea-4357-abf6-2de94099499d');
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
        $id = Uuid::fromString('ea0ce795-d434-4799-ad9d-65098130930c');
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
        $id = Uuid::fromString('1b09a941-d503-4436-ae71-bfb354f6598f');
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
        $id = Uuid::fromString('b511f7d2-3f88-45ef-b4ef-76c36199bbe7');
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
        $id = Uuid::fromString('0b41ed35-bb8a-4e59-a52e-f767a31da524');
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

        // telefoonnummer
        $id = Uuid::fromString('d492db19-16dc-4602-a76a-4900f8afd73a');
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
        $id = Uuid::fromString('dc175ae7-3453-41f1-8438-fee7bbcf49a1');
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

        //herhaal emailadres
        $id = Uuid::fromString('7b1fadd0-f97f-405e-a880-ade42e51d450');
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

        //geboortedatum
        $id = Uuid::fromString('d17e849d-987b-4c1f-8363-c1bd805e06a7');
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

        //3. Een toelichting
        //Voor wie vraagt u informatie op?
        $id = Uuid::fromString('7cb3cea4-3e2d-4dc5-972f-ea7bb5d230a3');
        $property = new Property();
        $property->setTitle('Voor wie vraagt u informatie op?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Alleen voor mijzelf', 'Voor mij en mijn gezin']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Heeft u informatie die handig kan zijn?
        //description - Bijvoorbeeld:  U bent bezig met een inburgeringscursus of heeft diploma's gehaald.
        $id = Uuid::fromString('e78f2a50-daad-4dd1-9212-48b1d3c098dc');
        $property = new Property();
        $property->setTitle('Heeft u informatie die handig kan zijn?');
        $property->setDescription('Bijvoorbeeld:  U bent bezig met een inburgeringscursus of heeft diploma\'s gehaald.');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Heeft u documenten die nodig kunnen zijn? Bijvoorbeeld: een diploma of ontheffing. Deze kunt u uploaden.
        $id = Uuid::fromString('fc9944dd-a1a6-4658-8873-d6f10d01adbf');
        $property = new Property();
        $property->setTitle('Heeft u documenten die nodig kunnen zijn? Bijvoorbeeld: een diploma of ontheffing. Deze kunt u uploaden:');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         * Kwijtscheldingsberekening
         *
         */
        $id = Uuid::fromString('92f2c3fd-236a-4cf7-adb2-8c5d27424f62');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Kwijtscheldingsberekening');
        $requestType->setDescription('');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. Uw gegevens
        //section - Kwijtscheldingsberekening 2020
        $id = Uuid::fromString('4ee5f6f4-c8d5-429e-8e07-39dc9617e5b8');
        $property = new Property();
        $property->setTitle('Kies de situatie die voor u van toepassing is');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['alleenstaande, jonger dan 65', 'alleenstaande, 65 of ouder', 'alleenstaande ouder, jonger dan 65', 'alleenstaande ouder, ouder dan 65 jaar',
            'partners, jonger dan 65', 'partners, waarvan één ouder dan 65', 'partners, waarvan beiden ouder dan 65']);
        $property->setRequierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //bedrag van aanslag
        $id = Uuid::fromString('074fa09d-5f02-40e6-bcc1-b65343765e1b');
        $property = new Property();
        $property->setTitle('Bedrag van de aanslag');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //banksaldo
        $id = Uuid::fromString('abe707eb-b639-4656-b89f-1c4d1caf52c3');
        $property = new Property();
        $property->setTitle('Banksaldo');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //2. Inkomsten per maand
        //Netto loon, uitkering:
        $id = Uuid::fromString('333557b8-a349-492a-8f38-4b43eeb7cd4b');
        $property = new Property();
        $property->setTitle('Netto loon, uitkering');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Aow
        $id = Uuid::fromString('d5786830-0856-47da-aa41-177a2dbaa338');
        $property = new Property();
        $property->setTitle('Aow:');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Pensioen
        $id = Uuid::fromString('796c1e36-f860-431a-8772-512561e89a81');
        $property = new Property();
        $property->setTitle('Pensioen');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Alimentatie
        $id = Uuid::fromString('d7547d42-cda8-415e-95d1-0e39ca2ee7d5');
        $property = new Property();
        $property->setTitle('Alimentatie');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Heffingskortingen
        $id = Uuid::fromString('ca9b3dcc-9582-459c-93e7-08c95c56910a');
        $property = new Property();
        $property->setTitle('Heffingskortingen');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Vakantiegeld
        $id = Uuid::fromString('f60165c9-46ca-4aeb-b0c6-c46294d0cd87');
        $property = new Property();
        $property->setTitle('Vakantiegeld');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Zorgtoeslag
        $id = Uuid::fromString('6bf824dc-f7d3-4920-9978-443caaa48c2c');
        $property = new Property();
        $property->setTitle('Zorgtoeslag');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Huurtoeslag
        $id = Uuid::fromString('b2f53af8-dc42-4996-8949-81dbe94f1c81');
        $property = new Property();
        $property->setTitle('Huurtoeslag');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Studiefinanciering
        $id = Uuid::fromString('200c7485-2ece-4e9b-bb68-4986b4cc98d6');
        $property = new Property();
        $property->setTitle('Studiefinanciering');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Toeslag kinderopvang
        $id = Uuid::fromString('5ce6f88b-546d-4a1d-9738-ce08d6a6dea1');
        $property = new Property();
        $property->setTitle('Toeslag kinderopvang');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Voorlopige belastingteruggave
        $id = Uuid::fromString('05226d67-68df-40f3-8a43-69f41e6f5ea8');
        $property = new Property();
        $property->setTitle('Voorlopige belastingteruggave');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Verhuur kamer(s)/ kostgangers
        $id = Uuid::fromString('ce027de4-b4ed-49f4-8b9c-5ddb047da479');
        $property = new Property();
        $property->setTitle('Verhuur kamer(s)/ kostgangers');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Overige inkomsten
        $id = Uuid::fromString('b35d37f7-0cf2-4e02-b029-50b292095069');
        $property = new Property();
        $property->setTitle('Overige inkomsten');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //3. Uitgaven per maand
        //Hypotheekrente
        $id = Uuid::fromString('bc11d4de-f023-432b-be9a-e66217bfa596');
        $property = new Property();
        $property->setTitle('Hypotheekrente');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Kale huur (incl. subsidiabele kosten)
        $id = Uuid::fromString('94b10394-7f84-46bc-80c4-a33a1f492c13');
        $property = new Property();
        $property->setTitle('Kale huur (incl. subsidiabele kosten)');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Ziektekostenpremie
        $id = Uuid::fromString('f8d793c6-001d-4924-a00c-2b974ced6976');
        $property = new Property();
        $property->setTitle('Ziektekostenpremie');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Alimentatie
        $id = Uuid::fromString('26e7376a-7843-415f-96b2-14b14a401f2d');
        $property = new Property();
        $property->setTitle('Alimentatie');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Kinderopvang
        $id = Uuid::fromString('a7e6eea7-f2c5-47e1-b8fe-8aa301e78056');
        $property = new Property();
        $property->setTitle('Kinderopvang');
        $property->setType('string');
        $property->setFormat('number');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
         * Verhuizing naar de gemeente Hoorn
         *
         */
        $id = Uuid::fromString('df920444-7783-477a-97fd-6a7ef839345c');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Verhuizing naar de gemeente Hoorn');
        $requestType->setDescription('');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1. Belangrijk
        //Gaat u verhuizen naar de gemeente Hoorn?
        $id = Uuid::fromString('eddeca63-ce31-4593-85b6-bd2f7ca4146a');
        $property = new Property();
        $property->setTitle('Gaat u verhuizen naar de gemeente Hoorn?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Verhuisdatum
        $id = Uuid::fromString('abc79718-9c61-4198-b626-554e6a9c22e0');
        $property = new Property();
        $property->setTitle('Verhuisdatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Hoe gaat u wonen?
        $id = Uuid::fromString('1486d8c7-3739-417c-8bc0-f308cb6912db');
        $property = new Property();
        $property->setTitle('Hoe gaat u wonen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['zelfstandig als huurder', 'zelfstandig als eigenaar', 'inwonend', 'inwonend bij een (zorg)instelling']);
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //2. Uw gegevens
        //Telefoonnummer
        $id = Uuid::fromString('28a586c5-a7d9-4041-873c-1e9bbd7a55fc');
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

        //E-mailadres
        $id = Uuid::fromString('6a4ca487-61a7-44dd-a7e6-16e1ebd72256');
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

        //Herhaal e-mailadres
        $id = Uuid::fromString('802bc991-6ffe-4c2a-8ff8-55caf97cc9ae');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //3. Uw verhuizing
        //section - Uw nieuwe adres
        //postcode
        $id = Uuid::fromString('4ea1e9b3-a7c8-4a29-b435-194c822a3df6');
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
        $id = Uuid::fromString('69967018-6c28-4f7a-9f95-2a925c747575');
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
        $id = Uuid::fromString('bd5a9c81-f063-4ed6-a54b-32437b885eb0');
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
        $id = Uuid::fromString('49a141a9-714b-4352-b2e9-4809962e5ac2');
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
        $id = Uuid::fromString('93b95d84-5b80-46bb-a57a-0e9f4c42372a');
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
        $id = Uuid::fromString('c066308c-ce60-4f05-9e08-3cdc3f56d9ea');
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

        //Met hoeveel personen woont u na uw verhuizing?
        $id = Uuid::fromString('74dad8f2-6ce3-4b53-a1d8-e7edc8d1f598');
        $property = new Property();
        $property->setTitle('Met hoeveel personen woont u na uw verhuizing?');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //section - meeverhuizen
        //descripton - Het oude en het nieuwe adres van deze personen moet hetzelfde zijn als dat van u. Is dit niet zo? Dan moet ieder zelf aangifte doen.
        //Verhuizen er gezinsleden mee?
        $id = Uuid::fromString('49ae832e-4c4a-4901-941e-c02ef3c4a930');
        $property = new Property();
        $property->setTitle('Verhuizen er gezinsleden mee?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //4. Meeverhuizende gezinsleden
        //Wie verhuizen er mee?
        $id = Uuid::fromString('0d605141-c65b-4909-9cd2-b28e57511d29');
        $property = new Property();
        $property->setTitle('Wie verhuizen er mee?');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['Partner', 'Kinderen']);
        $property->setReguierd(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //section - Partner
        //description - Vul hier de gegevens van uw partner in
        //voornamen
        $id = Uuid::fromString('7713e9d2-8539-4b02-8066-99bcb7b9b8a4');
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
        $id = Uuid::fromString('974e8d19-7e08-49e5-b046-26f9648c458c');
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
        $id = Uuid::fromString('493db183-621f-4432-bacd-f1f60d14e433');
        $property = new Property();
        $property->setTitle('Achternaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum
        $id = Uuid::fromString('b4e6a4a8-dcbd-48dc-b69d-39340802d3a9');
        $property = new Property();
        $property->setTitle('Geboortedatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //5. Bijlagen
        //bijlagen versturen
        $id = Uuid::fromString('b16f82ed-8c27-450c-b5df-0e45cd088b18');
        $property = new Property();
        $property->setTitle('Bijlagen versturen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Zijn de gegevens naar waarheid ingevuld?
        $id = Uuid::fromString('7fba8ea6-2ad7-450b-8cc6-a1cc6da0d039');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);
    }
}
