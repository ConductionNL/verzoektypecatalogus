<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MarkFixtures extends Fixture
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

        //reqeust type
        $id = Uuid::fromString('7e3998c0-4e9d-41e2-b9dc-f0840efc44d9');
        $requestType = new RequestType();
        $requestType->setName('Ja/Nee sticker bestellen');
        $requestType->setDescription('Bestel via dit formulier een JA/NEE of NEE/NEE sticker.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //type sticker
        $id = Uuid::fromString('c77cb790-7a93-46c6-a280-7f35bb29097f');
        $property = new Property();
        $property->setTitle('Welke sticker wilt u hebben?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['NEE/JA (u krijgt geen reclamedrukwerk, maar wel huis-aan-huisbladen)', 'NEE/NEE (u krijgt geen reclamedrukwerk en geen huis-aan-huisbladen)']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Adresgegevens
        $id = Uuid::fromString('c9ed0d31-6296-4e65-9416-aa2a1c366ecd');
        $property = new Property();
        $property->setTitle('Wat is uw adres?');
        $property->setName('adres_Sticker');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //persoonsgegevens
        $id = Uuid::fromString('f0ab2b61-2a98-48c0-b984-58ab5fa8568f');
        $property = new Property();
        $property->setTitle('Wat zijn uw gegevens?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Contactformulier bijzondere bijstand

        //reqeust type
        $id = Uuid::fromString('2d39a167-ea2e-49d9-96aa-fc5d199bd57c');
        $requestType = new RequestType();
        $requestType->setName('Contactformulier bijzondere bijstand');
        $property->setTitle('Contactformulier bijzondere bijstand');
        $requestType->setDescription('Wilt u weten of u in aanmerking komt voor bijzondere bijstand? Dat kan via dit contactformulier.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //textarea reden bijstand
        $id = Uuid::fromString('8835b122-7a8a-4dfc-86d9-e12254e9f676');
        $property = new Property();
        $property->setTitle('Voor welke kosten wilt u bijzondere bijstand aanvragen?');
        $property->setName('reden_anvraag');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Persoonsgegevens
        $id = Uuid::fromString('52339b15-cd83-4710-b102-c06fc72cd727');
        $property = new Property();
        $property->setTitle('Wat zijn uw gegevens?');
        $property->setType('string');
        $property->setName('gegevens_bijstand');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //ingevuld naar waarheid
        $id = Uuid::fromString('b2c127a1-c963-46dd-ae77-1a63de2c0b4c');
        $property = new Property();
        $property->setTitle('Zijn alle gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setDescription('Nee, wijzig uw bovenstaande gegevens');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Stel uw vraag aan 1.Hoorn formuliier

        $id = Uuid::fromString('a3844f30-74d7-4fcc-84c0-5c81fea5dc2e');
        $requestType = new RequestType();
        $requestType->setName('Stel uw vraag aan Zuid-Drecht');
        $property->setTitle('Stel uw vraag aan Zuid-Drecht');
        $requestType->setDescription('Dit formulier gebruikt u als u een algemene vraag over zorg en ondersteuning wilt stellen. Als u uw gegevens invult, ontvangt u een antwoord via e-mail of telefoon. U kunt ook anoniem een melding maken. Als u hiervoor kiest, kunnen wij geen contact met u opnemen.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Anoniem cantact
        $id = Uuid::fromString('fcbd0781-4f77-4943-a1e4-37e75afb3cc2');
        $property = new Property();
        $property->setTitle('Wilt u anoniem iets melden?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Aangeven vraag of melding
        $id = Uuid::fromString('24d9151f-abfe-45c6-9b87-5b543acae91d');
        $property = new Property();
        $property->setTitle('Uw vraag of melding betreft:');
        $property->setName('melding_klacht');
        $property->setDescription('Kunt u aangeven op welk gebied u een vraag of melding heeft?');
        $property->setRequired(true);
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Wonen', 'Werk en inkomen', 'Opvoeden en opgroeien', 'Gezondheid en ondersteuning']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //textarea vraag of opmerking
        $id = Uuid::fromString('36708885-716b-4e12-a93a-614952217b4e');
        $property = new Property();
        $property->setTitle('Vraag of opmerking');
        $property->setName('vraag_opmerking');
        $property->setType('string');
        $property->setRequired(true);
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Persoonsgegevens
        $id = Uuid::fromString('9410db4d-331f-4a54-9322-5db9148b9c90');
        $property = new Property();
        $property->setTitle('Wat zijn uw gegevens?');
        $property->setName('gegevens_aanmelden');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Contact over vraag
        $id = Uuid::fromString('12e64bca-dd12-4c25-b119-01e9416fb1be');
        $property = new Property();
        $property->setTitle('Wilt u persoonlijk contact over deze vraag of melding?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Formulier Activiteit organiseren
        //reqeust type
        $id = Uuid::fromString('6a2b39fc-669d-4b6e-bbcc-27c8d8063f4e');
        $requestType = new RequestType();
        $requestType->setName('Activiteit organiseren');
        $property->setTitle('Activiteit organiseren');
        $requestType->setDescription('Wilt u een klein evenement organiseren in onze gemeente vul dan dit formulier in');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Naam evenement
        $id = Uuid::fromString('3210089c-30e7-4e32-b0ee-c7120924ff4a');
        $property = new Property();
        $property->setName('Naam klein evenement');
        $property->setTitle('Naam klein evenement');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Omschrijving klein evenement
        $id = Uuid::fromString('a92e3830-0c45-406b-a955-dfd00e01905c');
        $property = new Property();
        $property->setName('Omschrijving klein evenement');
        $property->setTitle('Omschrijving klein evenement');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setDescription('Omschrijf de activiteiten op uw evenement');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Datum evenement
        $id = Uuid::fromString('b7415265-4f0f-4e35-9ee1-1774c5242ee3');
        $property = new Property();
        $property->setTitle('Datum klein evenement');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //mobilenummer
        $id = Uuid::fromString('dc3d50fb-106d-4fea-acb8-1323ac412744');
        $property = new Property();
        $property->setTitle('Mobiel nummer (tijdens evenement)');
        $property->setName('tel_evenement');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Mobiel nummer van uw bedrijf');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Begintijd event
        $id = Uuid::fromString('2b34d5f1-37fb-40a9-b171-61a9ccea3e16');
        $property = new Property();
        $property->setTitle('Begin evenement');
        $property->setType('string');
        $property->setFormat('time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Eindtijd evenement
        $id = Uuid::fromString('ef793831-d09b-428f-a2d5-338943abe8b5');
        $property = new Property();
        $property->setTitle('Eind evenement');
        $property->setType('string');
        $property->setFormat('time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //locatie evenement
        $id = Uuid::fromString('ee10e23b-0722-4744-95d9-db3d3a77291f');
        $property = new Property();
        $property->setTitle('locatie evenement');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //bezoekers evenement
        $id = Uuid::fromString('a4079fc0-7386-4262-8497-ba2ecb272395');
        $property = new Property();
        $property->setTitle('Aantal verwachte deelnemers/bezoekers');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //afsluiten evenement
        $id = Uuid::fromString('18271026-961a-4577-834b-f00c68df6a7a');
        $property = new Property();
        $property->setTitle('Wenst u straten en/of parkeerplaatsen af te sluiten?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Situatieschets
        $id = Uuid::fromString('5a57828b-1232-4225-ad59-50c9347fbb98');
        $property = new Property();
        $property->setTitle('Situatieschets');
        $property->setType('string');
        $property->setFormat('file');
        $property->setDescription('In te dienen bijlage: situatieschets op schaal 1:1000 waaruit blijkt waaar het evenement wordt gehouden
        en welke objecten (met maatvoering) en afstanden op welke locatie worden geplaatst met, indien van toepassing de wegafsluiting.
        Uit de situatieschets moet duidelijk blijken ook past op de betreffende locatie en dat er vrije doorgang overblijft voor hulpdiensten van minimaal 3.50 meter.');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //ingevuld naar waarheid
        $id = Uuid::fromString('81000444-8880-4ad4-82a3-0b53e9c1a233');
        $property = new Property();
        $property->setTitle('Zijn alle gegevens naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //locatie
        $id = Uuid::fromString('4b3faaf9-f8f4-422c-869b-19103892316f');
        $property = new Property();
        $property->setTitle('Wat is het adres van uw evenement?');
        $property->setName('adres_evenement');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Formulier alchol schenken
        $id = Uuid::fromString('30d63557-53e5-4393-a613-ca1debf278f4');
        $requestType = new RequestType();
        $requestType->setName('Aanvraag verguning Drank en Horicawet');
        $property->setTitle('Aanvraag verguning Drank en Horicawet');
        $property->setDescription('Een ondernemer moet een drank- en horecavergunning hebben om alcoholische dranken te schenken, Vraag deze hier aan.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //stage 1
        //bedrijfnaam
        $id = Uuid::fromString('889d5fc0-6709-42c5-b910-b992638e2755');
        $property = new Property();
        $property->setTitle('Naam Bedrijf:');
        $property->setName('name_bedrijf');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //kvknummer
        $id = Uuid::fromString('7130e972-64e1-4e8b-8a6e-fe6f61ad4db3');
        $property = new Property();
        $property->setTitle('KvK-nummer:');
        $property->setType('string');
        $property->setFormat('kvk');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Adres bedrijf
        $id = Uuid::fromString('b2163bf1-1247-4670-a146-d9bd2ce703ef');
        $property = new Property();
        $property->setTitle('Wat is het adres van uw bedrijf?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequestType($requestType);
        $property->setRequired(true);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //vergunninghouder
        $id = Uuid::fromString('574e80ce-8ec5-4c85-9a06-0057d6c20b5e');
        $property = new Property();
        $property->setTitle('De vergunning wordt aangevraagd voor de hiervoor genoemde natuuriijke of rechtspersoon.');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //stage 3
        //soort instelling
        $id = Uuid::fromString('d739487d-6e6a-4dce-be87-58b52194e955');
        $property = new Property();
        $property->setTitle('Voor welk soort instelling vraagt u een vergunning aan?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //betrekking aanvraag
        $id = Uuid::fromString('55de8ff7-0513-4b09-b8de-dbec3f1ae343');
        $property = new Property();
        $property->setTitle('Waar heeft uw aanvraag betrekking op?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //vragen over instelling
        $id = Uuid::fromString('9f05249d-bcc2-4f24-8580-0fd3de0a6d4d');
        $property = new Property();
        $property->setTitle('Wordt deze vergunning aangevraagd voor een natuuriijke of rechtspersoon?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['natuuriijke persoon', 'rechtspersoon/rechtspersonen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //aangeven ruimte
        $id = Uuid::fromString('bd54116a-70d4-417f-8f98-b53b4309a9a9');
        $property = new Property();
        $property->setTitle('Welke ruimte:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //opervlakte
        $id = Uuid::fromString('5b6f5604-3188-4584-a936-c6ec3ea20994');
        $property = new Property();
        $property->setTitle('Oppervlakte in m2:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //nog een ruimte
        $id = Uuid::fromString('bacf6482-7ed8-4231-9a01-dca12c292d8f');
        $property = new Property();
        $property->setTitle('Wilt u nog een ruimte melden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //openingstijd
        // Maandag
        $id = Uuid::fromString('aebb8c79-8729-4cd8-8f3c-1e9ba3d201fa');
        $property = new Property();
        $property->setTitle('Maandag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //dinsdag
        $id = Uuid::fromString('f3e3c0e1-0793-4e09-a915-cbcadce69c8c');
        $property = new Property();
        $property->setTitle('Dinsdag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //woensdag
        $id = Uuid::fromString('98edf464-7bc6-454b-9d50-ec53dbe11083');
        $property = new Property();
        $property->setTitle('Woensdag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //donderdag
        $id = Uuid::fromString('6f80c433-e692-44b2-aa53-99938da49455');
        $property = new Property();
        $property->setTitle('Donderdag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //vrijdag
        $id = Uuid::fromString('a5256e20-c054-4ebf-a730-dae71f3c5bea');
        $property = new Property();
        $property->setTitle('Vrijdag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //zaterdag
        $id = Uuid::fromString('e18fef01-b3ac-4ddd-8ae6-5b2e299d6a77');
        $property = new Property();
        $property->setTitle('Zaterdag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //zondag
        $id = Uuid::fromString('7ecf8afe-c190-4a9d-9a8c-a7d261d056a8');
        $property = new Property();
        $property->setTitle('Zondag');
        $property->setType('string');
        $property->setFormat('tofrom-time');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //lijdinggevende
        $id = Uuid::fromString('704c0be6-1f9c-4623-8761-98ab5c8e9b15');
        $property = new Property();
        $property->setTitle('Hoeveel leidinggevenden zijn er?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //huurovereenkomst
        $id = Uuid::fromString('3d417e45-b0b3-405e-b725-83f2ae355268');
        $property = new Property();
        $property->setTitle('Huurovereenkomst of eigendombewijs');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //plattegrond
        $id = Uuid::fromString('0bdf1d97-0d24-415a-9371-7a7d60f4bd40');
        $property = new Property();
        $property->setTitle('Plattegrond van de inrichting');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //aanwezigheid
        $id = Uuid::fromString('66ccac5c-969a-4879-9f6a-a151f414c3f4');
        $property = new Property();
        $property->setTitle('Kunnen er, op enig moment meer dan 50 persoonen (incl. personeel) in de ruimte aanwezig zijn?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //ventilatie
        $id = Uuid::fromString('27864281-d32b-4eeb-816a-6edc691a83ea');
        $property = new Property();
        $property->setTitle('Opgave van de capaciteit in m3 per uur van de mechanische ventilatie-inrichting');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //beroep horecawet
        $id = Uuid::fromString('a61c80cb-54d6-415a-8e46-ef5caa9fbd09');
        $property = new Property();
        $property->setTitle('Wilt u beroep doen op artiekel 46 van de drank en horecawet?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        /*
       * Anvraagformulier Bijverslening
       *
       */
        $id = Uuid::fromString('1dcfbd45-3140-4d9b-ba20-7fb97dfc32b6');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Anvraagformulier Bijverslening');
        $property->setTitle('Anvraagformulier Bijverslening');
        $requestType->setDescription('Via dit formulier vraagt u een Blijverslening aan.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Uw gegevens
        //Telefoonnummer
        $id = Uuid::fromString('1172021a-9902-42b7-ab08-2cb169b589da');
        $property = new Property();
        $property->setTitle('Wat zijn uw gegevens?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //heeft u een partner? Vul dan hieronder de gegevens van uw partner in.
        //Voor- en achternaam
        $id = Uuid::fromString('55027bb1-5639-4ea2-a92b-878971c3776e');
        $property = new Property();
        $property->setTitle('Gegevens partner');
        $property->setName('partner');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //gegevens van uw woning + description
        //adres
        $id = Uuid::fromString('f9f7bf4e-a798-45b9-9fab-e5e68aa48718');
        $property = new Property();
        $property->setTitle('Wat is het adres?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //wanneer eigenaar
        $id = Uuid::fromString('a012a629-3f02-43f8-8037-9f91609385fc');
        $property = new Property();
        $property->setTitle('Op welke datum werd u de eigenaar van de woning?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wat is de WOZ-waarde van de woning?
        $id = Uuid::fromString('c4c936c8-6973-4578-b6cb-1e63b94bb8f0');
        $property = new Property();
        $property->setTitle('Wat is de WOZ-waarde van de woning?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Hoe hoog is het hypotheekbedrag dat nog op de woning openstaat?
        $id = Uuid::fromString('37a86de8-4c81-4fea-b311-4755e837d830');
        $property = new Property();
        $property->setTitle('Hoe hoog is het hypotheekbedrag dat nog op de woning openstaat?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Woont u zelf in de woning waarvoor u de lening aanvraagt?
        $id = Uuid::fromString('a8e8ed68-b6d5-45e9-a245-7d03f73cbbbb');
        $property = new Property();
        $property->setTitle('Woont u zelf in de woning waarvoor u de lening aanvraagt?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //stage 2
        //aanpassingen aan de woning
        //description = Welke maatregelen of werkzaamheden aan uw woning gaat u uitvoeren?

        //form met drie kopjes naast elkaar met textbalkjes onder elkaar

        //Hoe dragen de maatregelen bij aan het langer zelfstandig wonen in de woning?
        $id = Uuid::fromString('700d1c83-e911-4c2c-ad3b-ee9a5292b314');
        $property = new Property();
        $property->setTitle('Hoe dragen de maatregelen bij aan het langer zelfstandig wonen in de woning?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Heeft u voor de maatregelen een omgevingsvergunning nodig?
        $id = Uuid::fromString('ff8161eb-41ae-4d01-b236-7091e2d1413d');
        $property = new Property();
        $property->setTitle('Heeft u voor de maatregelen een omgevingsvergunning nodig?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zo ja, heeft u de vergunning al aangevraagd?
        $id = Uuid::fromString('b1ef428f-7be4-4004-9455-1b3dbff64bf9');
        $property = new Property();
        $property->setTitle('Zo ja, heeft u de vergunning al aangevraagd?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Bent u al begonnen met het uitvoeren van de werkzaamheden?
        $id = Uuid::fromString('777ba2ae-57d7-4a4c-baa9-5bb81f874ab0');
        $property = new Property();
        $property->setTitle('Bent u al begonnen met het uitvoeren van de werkzaamheden? ');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wat is de reden waarom u de maatregelen aan de woning laat uitvoeren?
        $id = Uuid::fromString('d33f4a30-68f6-4252-a47c-47c384177be5');
        $property = new Property();
        $property->setTitle('Wat is de reden waarom u de maatregelen aan de woning laat uitvoeren?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Preventief om de woning bewoonbaar te houden voor de toekomst', 'De aanpassing is vereist vanwege een huidige medische situatie']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Als de aanpassing is vereist vanwege een huidige medische situatie, wanneer is de noodzaak voor het aanpassen van de woning ontstaan?
        $id = Uuid::fromString('b45d9af4-cdf1-4820-b2e9-49e645dea203');
        $property = new Property();
        $property->setTitle('Als de aanpassing is vereist vanwege een huidige medische situatie, wanneer is de noodzaak voor het aanpassen van de woning ontstaan?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //stage 3
        //Ondersteuning
        //Heeft u voor de maatregelen aan uw woning ondersteuning aangevraagd vanuit de Wet maatschappelijke ondersteuning (WMO)?
        $id = Uuid::fromString('c61437cc-684e-4e3e-ae9f-8ee60cf7904a');
        $property = new Property();
        $property->setTitle('Heeft u voor de maatregelen aan uw woning ondersteuning aangevraagd vanuit de Wet maatschappelijke ondersteuning (WMO)?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Heeft u voor de maatregelen aan uw woning subsidie of ondersteuning ontvangen vanuit een andere instantie of regeling?
        $id = Uuid::fromString('e389e377-bd92-4493-a8b9-cdfe1f8024c3');
        $property = new Property();
        $property->setTitle('Heeft u voor de maatregelen aan uw woning subsidie of ondersteuning ontvangen vanuit een andere instantie of regeling?');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Zo ja, voor welke maatregelen heeft u subsidie of ondersteuning ontvangen?
        $id = Uuid::fromString('c2b90250-70d2-47b0-b031-38a34c188d85');
        $property = new Property();
        $property->setTitle('Zo ja, voor welke maatregelen heeft u subsidie of ondersteuning ontvangen?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Welk bedrag heeft u aan subsidie of ondersteuning ontvangen?
        $id = Uuid::fromString('89a39f41-9ede-4b1c-a480-021d9e732efd');
        $property = new Property();
        $property->setTitle('Welk bedrag heeft u aan subsidie of ondersteuning ontvangen?');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Geeft u de gemeente toestemming om de informatie in te zien?
        // description = Dit helpt de gemeente om uw aanvraag sneller af te handelen.
        $id = Uuid::fromString('69077361-27b0-4017-bf73-c2c83990071c');
        $property = new Property();
        $property->setTitle('Geeft u de gemeente toestemming om de informatie in te zien?');
        $property->setDescription('Dit helpt de gemeente om uw aanvraag sneller af te handelen');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //lening
        //description = Een lening is alleen mogelijk voor de geoffreerde kosten min de ontvangen subsidies of ondersteuning.
        //Welk bedrag wilt u lenen?
        $id = Uuid::fromString('135d2d77-5d61-4115-b0b9-08d76139230d');
        $property = new Property();
        $property->setTitle('Welk bedrag wilt u lenen?');
        $property->setType('string');
        $property->setFormat('number');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //Wat voor lening vraagt u aan?
        $id = Uuid::fromString('2fb057a5-06c0-43f3-b605-0adffc383f9a');
        $property = new Property();
        $property->setTitle('Wat voor lening vraagt u aan?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Hypothecaire lening', 'Consumptieve lening']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //bijlagen
        //description = Stuur bij uw aanvraag de volgende bijlagen mee:
        // Kopie recente offerte(s) van een aannemer/installateur/leverancier voor de te treffen maatregelen
        // Kopie van de benodigde vergunning(en) (indien van toepassing)
        // Kopie van uw identiteitsbewijs
        $id = Uuid::fromString('fe9c3737-1a02-44f1-ba57-940173bf99af');
        $property = new Property();
        $property->setTitle('Bijlagen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //ondersteuning
        //Ik verklaar:
        // bekend te zijn met de voorwaarden van de blijverslening van de SVn en de gemeente Delft
        // dat de werkzaamheden waarvoor de blijverslening wordt aangevraagd nog niet uitgevoerd zijn
        // alle verstrekte gegevens naar waarheid te hebben ingevuld inclusief de bijlage(n)
        //akkoord verklaring
        $id = Uuid::fromString('8064ccf3-f853-4a65-9109-ce2dc11abcf9');
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

        //formulier Vraag stellen over (ver)bouwen
        $id = Uuid::fromString('15fa03c2-a654-45be-8153-f2df32bcc6cb');
        $requestType = new RequestType();
        $requestType->setName('Vraag stellen over (ver)bouwen');
        $property->setTitle('Vraag stellen over (ver)bouwen');
        $property->setDescription('Wilt u iets (ver)bouwen vraag diit hier aan.');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Vraag
        $id = Uuid::fromString('55d44ad8-8dca-44a3-9b5d-c001d0149a34');
        $property = new Property();
        $property->setTitle('Uw vraag:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Adres
        $id = Uuid::fromString('0309ca91-7c12-4046-a7b0-f390acddff40');
        $property = new Property();
        $property->setTitle('Wat is adres van de locatie?');
        $property->setName('locatie_verbouwing');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //omschrijving locatie
        $id = Uuid::fromString('6330becc-b082-48e6-9517-a6000dfc8826');
        $property = new Property();
        $property->setTitle('omschrijf de locatie:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //telefoonnummer
        $id = Uuid::fromString('56568eef-388e-4549-b3c2-c10dce672453');
        $property = new Property();
        $property->setTitle('Wat zijn uw gegevens?');
        $property->setName('gegevens_verbouwer');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //formulier begraven
        $id = Uuid::fromString('b24a6663-2691-4568-8b3e-74e8e1b17c3f');
        $requestType = new RequestType();
        $requestType->setName('Begraven');
        $requestType->setDescription('Hier kunt u een begravenis melden');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Stage 1
        //kvknummer
        $id = Uuid::fromString('39ec384d-4209-4234-ad68-0d43592f236f');
        $property = new Property();
        $property->setTitle('KvK-nummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('d6f14882-5720-43e6-96be-69b2551720ab');
        $property = new Property();
        $property->setTitle('Vestigingsnummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //naam bedrijf
        $id = Uuid::fromString('6996b2fe-c4e5-43e9-b5e9-34deb886842e');
        $property = new Property();
        $property->setTitle('Naam bedrijf:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //adres bedrijf
        $id = Uuid::fromString('1f479217-9ee0-4a62-acb0-8ef9160cfa17');
        $property = new Property();
        $property->setTitle('Wat is het adres van uw bedrijf?');
        $property->setName('adres_uitvaart');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //stage 2
        //gegevens contactpersoon
        $id = Uuid::fromString('2e82f135-1258-4c48-a34b-b8bd8a0b7cc6');
        $property = new Property();
        $property->setTitle('Wat zijn de gegevens van de contactpersoon?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //beroep
        $id = Uuid::fromString('62e33ac8-3122-4b0d-bbaa-af127c90fafe');
        $property = new Property();
        $property->setTitle('Beroep:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //afdeling
        $id = Uuid::fromString('4ce30cab-96de-406d-b3f2-cccb8dd79e68');
        $property = new Property();
        $property->setTitle('Afdeling:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Akkoord verklaring
        $id = Uuid::fromString('7acf03f2-4730-4e46-bdaf-f2dbcf89c618');
        $property = new Property();
        $property->setTitle('Hiermee verklaar ik dat de opgegeven persoon dit formulier in mag vullen namens bovenstaande rechtspersoon');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['akkoord']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Stage 3
        //Geslacht
        $id = Uuid::fromString('baea7811-3aef-447a-82e2-841f96e3e31d');
        $property = new Property();
        $property->setTitle('Geslacht');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['man', 'vrouw']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //voornamen
        $id = Uuid::fromString('734fc710-ce4d-4ee6-9b02-8e8288e99edd');
        $property = new Property();
        $property->setTitle('wat zijn de gegevens van de overledene?');
        $property->setName('gegevens_overleidene');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboorte
        $id = Uuid::fromString('a5fc48a3-1d2a-4934-910e-1e8e9e8c5d2b');
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

        //overleiden
        $id = Uuid::fromString('718ae5fe-e672-407a-b56e-47924af0e685');
        $property = new Property();
        $property->setTitle('Overlijdensdatum:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Gegevens van de rechthebbende / opdrachtgever
        //Geslacht
        $id = Uuid::fromString('efc87f8a-e503-4648-b465-28d7c98f25ba');
        $property = new Property();
        $property->setTitle('Geslacht');
        $property->setName('opdrachtgever_geslacht');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['man', 'vrouw']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b0530640-9213-4b06-a213-14fbcdf763d2');
        $property = new Property();
        $property->setTitle('Gegevens van de rechthebbende?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Adres
        $id = Uuid::fromString('95c5a62b-d8c8-464d-8059-cd3b8995ab0f');
        $property = new Property();
        $property->setTitle('Wat is het adres van de rechthebbende?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //gegevens begraafplaats
        //datum
        $id = Uuid::fromString('c2e71f55-3e7a-4a89-ac52-d0c11e091aa3');
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

        //tijd
        $id = Uuid::fromString('8c7040d0-7f55-4ee3-b039-173e17f56b98');
        $property = new Property();
        $property->setTitle('Tijd:');
        $property->setType('string');
        $property->setFormat('time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //befraafplaats
        $id = Uuid::fromString('10ddf74e-3c4d-4d86-b713-b6d7b1260003');
        $property = new Property();
        $property->setTitle('Welke begraafplaats kiest u?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Berkhouterweg', 'Keern', 'Zuiderveld', 'Zwaag']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //soort graf
        $id = Uuid::fromString('261744fd-507d-47c7-8887-e3a1c2a22048');
        $property = new Property();
        $property->setTitle('Soort graf:');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['bestaand graf', 'particulier graf']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //grafnumer
        $id = Uuid::fromString('35800e31-0227-4537-89fd-ff8a4cc0275c');
        $property = new Property();
        $property->setTitle('Grafnummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //extra info
        $id = Uuid::fromString('fb1f9e6e-e149-443a-aa40-689f6b0df1de');
        $property = new Property();
        $property->setTitle('Extra informatie:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Gegevens uitvaart
        $id = Uuid::fromString('55298664-0121-4272-933c-ee217628dc33');
        $property = new Property();
        $property->setTitle('Rijdende baar?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['ja', 'nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //schep
        $id = Uuid::fromString('8c00a8d2-041d-4b97-a479-d64cfcc63f9f');
        $property = new Property();
        $property->setTitle('Schepje klaar leggen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['ja', 'nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //gebruik maken van
        $id = Uuid::fromString('07fe5203-ba2d-416c-87b1-ea29b4f6273e');
        $property = new Property();
        $property->setTitle(' Gebruik maken van:');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Een graflift', 'touwen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //formulier aangeven overlijden
        $id = Uuid::fromString('24962583-a3a2-4453-88b8-970114ebb89b');
        $requestType = new RequestType();
        $requestType->setName('Aangeven overlijden');
        $requestType->setDescription('Met dit formulier kan de uitvaartverzorger een overleden persoon digitaal aangeven bij de gemeente Zuid-Drecht. ');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //Stage 1
        //kvknummer
        $id = Uuid::fromString('cb4bbbdc-74d5-461c-accd-dd032dfefb75');
        $property = new Property();
        $property->setTitle('KvK-nummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('4e9697ac-b44f-4094-84cf-4552ae8859f0');
        $property = new Property();
        $property->setTitle('Vestigingsnummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //naam bedrijf
        $id = Uuid::fromString('486950fe-f884-4f28-99d4-82058a29cbca');
        $property = new Property();
        $property->setTitle('Wat is het adres van uw bedrijf?');
        $property->setName('bedrijf_uitvaartverzorger');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequestType($requestType);
        $property->setRequired(true);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //stage 2 Gegevens aangever

        //naam
        $id = Uuid::fromString('b3aa2e1e-8d3f-458e-96e9-c37aa194512f');
        $property = new Property();
        $property->setTitle('Wat zijn de gegevens van de aangever?');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //locatie overleiden
        $id = Uuid::fromString('1abb6b5a-4534-4957-8ab1-6e5a46a864bf');
        $property = new Property();
        $property->setTitle('Woonde de overledenen in Nederland?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Gegevens van de overledene
        //BSN
        $id = Uuid::fromString('9c90a629-5aab-4194-a8bf-39ea57f219a6');
        $property = new Property();
        $property->setTitle('Gegevens van de overledene');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //laatste woonplaats
        $id = Uuid::fromString('dd1bdc9a-87bd-429e-921c-7b39f53c6033');
        $property = new Property();
        $property->setTitle('Laatste woonplaats:');
        $property->setTitle('overledenen_woonplaats');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Gegevens van overlijden
        //oorzaak overleiden
        $id = Uuid::fromString('ed48ccc3-da5f-406a-8c91-9b47d0d361b9');
        $property = new Property();
        $property->setTitle('Oorzaak overlijden?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['natuuriijk', 'niet natuuriijk']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //lijkvinding
        $id = Uuid::fromString('469bbdb8-78cf-4d03-bdcd-d14db3d3054c');
        $property = new Property();
        $property->setTitle('Betreft het een lijkvinding?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setRequired(true);
        $property->setEnum(['Ja', 'Nee']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //datum overleiden
        $id = Uuid::fromString('eb896755-7731-4c9b-8b3d-57ccffce9e3b');
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

        //tijd overleiden
        $id = Uuid::fromString('b6669bed-9c50-4bb5-9e9d-4c9a36e7ff2c');
        $property = new Property();
        $property->setTitle('Tijd:');
        $property->setType('string');
        $property->setFormat('time');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //gemeente
        $id = Uuid::fromString('8cb78060-35a6-4deb-9e2c-8bcf305739b5');
        $property = new Property();
        $property->setTitle('Gemeente:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setIri('wrc/organization');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //verklaaring
        $id = Uuid::fromString('447168d3-2fb7-4bfc-bcb6-1289d9eb83f3');
        $property = new Property();
        $property->setTitle('Verklaring van overlijden:');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Gegevens uitvaart
        //ssort uitvaart
        $id = Uuid::fromString('eff0bd13-1e5d-4f00-a0c1-3d1ebaa80948');
        $property = new Property();
        $property->setTitle('Soort uitvaart:');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Begraven', 'Crematie', 'Ter beschikkingstelling aan de wetenschap']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //plaats uitvaart
        $id = Uuid::fromString('737aeb0d-286d-40fc-86d1-8b225e5d42eb');
        $property = new Property();
        $property->setTitle('Plaats uitvaart:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Datum uitvaart
        $id = Uuid::fromString('c3d72ffd-c198-4152-a95b-4f5186a03bf9');
        $property = new Property();
        $property->setTitle('Datum uitvaart:');
        $property->setType('string');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //verzoek tot uitstel
        $id = Uuid::fromString('e5d63601-c550-4c41-bdb2-cffa182647ed');
        $property = new Property();
        $property->setTitle('Verzoek tot uitstel?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['ja', 'nee']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //overige informatie
        $id = Uuid::fromString('a87b32e4-783d-41ae-a94d-effcee8cea9b');
        $property = new Property();
        $property->setTitle('Hoeveel afschriften van de akte van overlijden zijn nodig?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //extra aanvulling
        $id = Uuid::fromString('d712e935-5b4d-4b9c-ad5e-e79f689f49eb');
        $property = new Property();
        $property->setTitle('Extra aanvulling:');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //waarheid gegevens
        $id = Uuid::fromString('1cb147b1-d0b2-4110-ba2d-fa069c825955');
        $property = new Property();
        $property->setTitle(' Zijn de gegevens juist en naar waarheid ingevuld?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Formulier naamswijzeging (voornaam veranderen voor jezelf)

        $id = Uuid::fromString('f77affba-0b0d-4c7c-9a39-09463f4af6f7');
        $requestType = new RequestType();
        $requestType->setName('Naamsweizeging');
        $requestType->setDescription('Met dit formulier kunt u uw naam wijzigen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //welke naam wijzigen
        $id = Uuid::fromString('14885914-4ba4-4613-a7b0-a9f9d50d2d0a');
        $property = new Property();
        $property->setTitle('Welke naam wilt u veranderen?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Voornaam', 'Achternaam']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //voor wie invullen
        $id = Uuid::fromString('8c1517d7-3341-4e52-883c-8cef7abd1da5');
        $property = new Property();
        $property->setTitle('Voor wie vult u dit formulier in?');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Mijzelf', 'Voor iemand anders als gemachtigde']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Stage 2
        //gewenste voornaam
        $id = Uuid::fromString('299ccd12-8aa1-4822-9e92-b73024079ede');
        $property = new Property();
        $property->setTitle('Wat is de gewenste voornaam/voornamen?');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Reden verandering
        $id = Uuid::fromString('baa6b31d-bb9b-494e-b6f7-55da288c691f');
        $property = new Property();
        $property->setTitle('Wat is de reden van verandering?');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //voornaam
        $id = Uuid::fromString('6818aeee-1935-49e1-92ba-a5a8b73a9c78');
        $property = new Property();
        $property->setTitle('Voornaam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //achternaam
        $id = Uuid::fromString('8d2a3dfe-b083-4c9c-a165-73b87dab4c96');
        $property = new Property();
        $property->setTitle('Achternaam:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //BSN
        $id = Uuid::fromString('4117e4ee-79e5-428c-b158-6c5c408c35f9');
        $property = new Property();
        $property->setTitle('burgerservicenummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //geboortedatum
        $id = Uuid::fromString('ed60f66f-a86b-464c-9396-e089fecc1770');
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
        $id = Uuid::fromString('63770545-0148-4ecc-bc0b-ef8d81eb90ee');
        $property = new Property();
        $property->setTitle('Telefoonnummer:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //e-mailadress
        $id = Uuid::fromString('2d152f7d-f73e-4da4-afb0-28310ae4a995');
        $property = new Property();
        $property->setTitle('E-mailadres:');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Stage 4 BRP ophalen
        /*
         * knop ophalen BRP moet gemaakt worden
         */

        //BRP correct
        $id = Uuid::fromString('44aa44ec-cdce-475e-b592-8313ed044bb0');
        $property = new Property();
        $property->setTitle('Zijn de gegevens correct?');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setEnum(['Ja']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //Geboorteakte
        $id = Uuid::fromString('4aee4ce8-8b0c-4ef9-96b8-21936bc9dd5a');
        $property = new Property();
        $property->setTitle('Hier de geboorteakte toevoegen:');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        // Stage 5 Gegevens advocaat
        $id = Uuid::fromString('6b191a31-9e2a-42c6-85c5-672765e42793');
        $property = new Property();
        $property->setTitle('gegevens advocaat:');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //e-mailadress advocaat
        $id = Uuid::fromString('15ee65db-0db8-4b2d-8356-f14cea67a8d0');
        $property = new Property();
        $property->setTitle('adres advocaat');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
