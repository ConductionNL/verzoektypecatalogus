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
        // Inlichtingen BRP / Burgerlijke stand

        $id = Uuid::fromString('d6b1f1ab-82f5-4a0d-b808-b0a63c72a201');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Inlichtingen BRP/BurgerlijkeStand');
        $requestType->setDescription('Advocaten, notarissen en gerechtsdeurwaarders gebruiken dit formulier voor een verzoek om inlichtingen uit de Basisregistratie Personen (BRP) of Burgerlijke stand');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        // wat vraagt u aan?
        $id = Uuid::fromString('898ba684-a579-4690-8a44-42f3bc7c132c');
        $property = new Property();
        $property->setTitle('Aantal keer Uittreksels Basisregistratie personen (BRP) à € 8,77');
        $property->setName('xKeerBRP');
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
        $property->setTitle('Aantal keer Afschriften Burgerlijke stand à € 13,80');
        $property->setName('xKeerABS');
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
        $property->setTitle('Aantal keer Nalatenschap / Erfgenamenonderzoek à € 25,64');
        $property->setName('xKeerNalatenschapErfgenamenondrzoek');
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
        $property->setTitle('Bijlage toevoegen');
        $property->setName('BijlageToevoegen');
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
        $property->setTitle('Inschrijfnummer Kvk');
        $property->setName('KvkNummer');
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
        $property->setTitle('Vestigingsnummer');
        $property->setName('vestegingsnummer');
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
        $property->setTitle('Bedrijfsnaam');
        $property->setName('bedrijfsnaam');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('38f796bc-d31c-4285-957b-1efbec38a653');
        $property = new Property();
        $property->setTitle('vestegings adres');
        $property->setName('AdresVesteging');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //5e pagina
        $id = Uuid::fromString('2d8a9acb-653b-468e-8d0d-d5beb16e1c26');
        $property = new Property();
        $property->setTitle('persoons gegevens');
        $property->setName('GegevensContactPersoon');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('a32e1ed1-a03d-445d-a4c1-27d741a3329c');
        $property = new Property();
        $property->setTitle('Functie');
        $property->setName('functieContactPersoon');
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
        $property->setTitle('Afdeling');
        $property->setName('AfdelingPersoon');
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
        $property->setTitle('Akkoord verklaring');
        $property->setName('AkkoordVerklaring');
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
        $property->setTitle('Naar waarheid ingevult?');
        $property->setName('NaarWaarheidIngevult?');
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

        //gegevens inzien en aanpassen

        $id = Uuid::fromString('4dcf25f2-c2dc-4a82-8a78-33e4d3d7241d');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Gegevens Inzien en aanpassen');
        $requestType->setDescription('hier_kunt_u_uw_eigen_gegevens_aanpassen_en/of_bekijken');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        // section 1  inloggen met digiD

        // section 2
        $id = Uuid::fromString('1293b6df-12ac-4d3d-a35f-3b51d9c0a27a');
        $property = new Property();
        $property->setTitle('persoons gegevens invullen');
        $property->setName('persoonsGegevens');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('e1257a68-651f-4ef9-a161-2e27e94d52e1');
        $property = new Property();
        $property->setTitle('adres gegevens invullen');
        $property->setName('PersoonAdres');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //section 3
        $id = Uuid::fromString('195c7e03-e3f5-4c71-bf66-b023d9f1bfe9');
        $property = new Property();
        $property->setTitle('Maak uw keuze');
        $property->setName('MaakKeuze');
        $property->setType('string');
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
        $property->setTitle('Redening voor product of dienst');
        $property->setName('RedenProductDienst');
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
        $property->setTitle('Zaaknummers');
        $property->setName('zaaknummers');
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
        $property->setTitle('Bijlagen');
        $property->setName('bijlagen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // section 5 controleren
        $id = Uuid::fromString('f44234ab-1e3e-403e-87a0-6b2945f84969');
        $property = new Property();
        $property->setTitle('Maak uw keuze');
        $property->setName('maakKeuze');
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
        //1e pagina
        $id = Uuid::fromString('1fb54451-4622-4c44-93b0-5b47d0718f99');
        $property = new Property();
        $property->setTitle('persons gegevens aanvrager');
        $property->setName('PersoonAanvrager');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('d0322d63-d10f-4463-998e-09b569625c37');
        $property = new Property();
        $property->setTitle('adres gegevens aanvrager');
        $property->setName('AdresAanvrager');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        // 2e pagina
        $id = Uuid::fromString('16dde21d-f1ee-44af-a3b5-ee9c8fe18da2');
        $property = new Property();
        $property->setTitle('persons gegevens verzorger');
        $property->setName('GegevensVerzorger');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('25ff8ecc-2ac1-4fa5-8098-114997107092');
        $property = new Property();
        $property->setTitle('adres gegevens verzorger');
        $property->setName('AdresVerzorger');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('e2db271d-349f-40f9-b2ef-b89c555a1416');
        $property = new Property();
        $property->setTitle('E-relatie met verzorger');
        $property->setName('ErelatieVerzorger');
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
        $property->setTitle('Aantal uur per week');
        $property->setName('AantalUur');
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
        $property->setTitle('Omschrijving van de activiteiten');
        $property->setName('OmschrijvingActiviteiten');
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
        $property->setTitle('Zijn de gegevens juist ingevult?');
        $property->setName('JuistIngevult?');
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

        // aanspraakelijk stellen
        $id = Uuid::fromString('60f392ca-fdf7-497c-baef-6dfb44f1a56d');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Aanspraakelijk stellen');
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
        $property->setTitle('gegevens invoeren');
        $property->setName('PersoonsGegevens');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('6442816e-4657-4eb2-9d1b-ace895d01bd0');
        $property = new Property();
        $property->setTitle('Wat is uw adres?');
        $property->setName('Adres');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //3e pagina schade
        $id = Uuid::fromString('0aea6d71-cc37-4385-96aa-d0840ec98c63');
        $property = new Property();
        $property->setTitle('Op welke datum is uw schade ontstaan?');
        $property->setName('DatumSchade');
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
        $property->setTitle('Wat is het bedrag van de schade');
        $property->setName('BedragSchade');
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
        $property->setTitle('Waar is de schade ontstaan');
        $property->setName('LocatieSchade');
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
        $property->setTitle('Hoe is de schade ontstaan');
        $property->setName('OorzaakSchade');
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
        $property->setTitle('Omschrijf de schade');
        $property->setName('BeschrijvingSchade');
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
        $property->setTitle('Waarom vind u dat de gemeente uw schade moet vergoeden?');
        $property->setName('RedenVergoeding');
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
        $property->setTitle('Bijlagen');
        $property->setName('bijlagen');
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
        $property->setTitle('Controleren van gegevens');
        $property->setName('GegevensControleren');
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

        // formulier rioolaansluitng aanvragen
        $id = Uuid::fromString('7c19dc55-f2dd-403d-a317-768a043c302c');
        $requestType = new RequestType();
        $requestType->setOrganization('002220647');
        $requestType->setName('Rioolaansluiting aanvragen');
        $requestType->setDescription('met dit formulier kunt u een aansluiting aanvragen op het rioolnetwerk van de stad');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        //1e pagina is belangrijke informatie
        $id = Uuid::fromString('0959b819-c203-417c-a5be-6626a785cb2e');
        $property = new Property();
        $property->setTitle('Datum van de aansluiting');
        $property->setName('DatumAansluiting');
        $property->setType('string');
        $property->setDescription('Kies een datum voor de aansluiting. Het verwerken van een aanvraag duurt 3 weken - date -required');
        $property->setFormat('date');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        //2e pagina
        $id = Uuid::fromString('dddeecc9-3f18-401e-835f-175f678b87e8');
        $property = new Property();
        $property->setTitle('uw gegevens');
        $property->setName('PersoonsGegevens');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f0deada6-fc15-4935-b282-6b9f27bb5680');
        $property = new Property();
        $property->setTitle('uw adres');
        $property->setName('Adres');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //3e pagina
        $id = Uuid::fromString('72a28b02-37c4-4509-93db-061d2d76548e');
        $property = new Property();
        $property->setTitle('welke soort rioolaansluiting wilt u?');
        $property->setName('SoortAansluiting');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['vaste rioolaansluiting', 'een tijdelijke rioolaansluting']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('f8c28a4c-f9f3-4c06-b774-bc65ceb7026e');
        $property = new Property();
        $property->setTitle('Wat is de locatie van de aansluiting?');
        $property->setName('LocatieAansluiting');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['Eén adres', 'Meerdere adressen', 'Een locatie ter hoogte van']);
        $property->setRequired(true);
        $property->setDescription('Locatie ter hoogte van: bijvoorbeeld een bouwkeet op een parkeerplaats of een bouwplaats.');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('4b8e3d0b-c65c-4f2e-a253-1d94778b2f65');
        $property = new Property();
        $property->setTitle('adres van aansluiting');
        $property->setName('AdresAansluiting');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setIri('bag/address');
        $property->setDescription('Alleen invullen als u een rioolaansluitng wilt aanvragen op een andere locatie dan uw thuis adres');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //4e pagina
        $id = Uuid::fromString('5ed9c4b1-2e59-4532-b6bf-14eb56eeba77');
        $property = new Property();
        $property->setTitle('wat voor een gebouw wilt u aansluiten op het riool?');
        $property->setName('GebouwAansluiting');
        $property->setType('string');
        $property->setFormat('radio');
        $property->setEnum(['een bedrijfspand', 'een woning']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('b979a4dd-ae8d-4d0b-94a4-9548a4a9d80f');
        $property = new Property();
        $property->setTitle('waarvoor wilt u een rioolaansluitng aanvragen?');
        $property->setName('WaarvoorAansluiting');
        $property->setType('array');
        $property->setFormat('checkbox');
        $property->setEnum(['schoon hemelwater(HWA)', 'vuil afvalwater(DWA)', 'drainagewater', 'anders']);
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('a00f26c6-cb03-47f5-96ad-bf1c099a75e6');
        $property = new Property();
        $property->setTitle('Anders namelijk');
        $property->setName('WaarvoorAansluitingAnders');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Alleen invoeren als u anders heeft aangevinkt bij de vorige vraag');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //5e pagina
        $id = Uuid::fromString('5cbd70b2-e4d3-4a78-ac7e-67cc91ca10ba');
        $property = new Property();
        $property->setTitle('bijlagen toevoegen');
        $property->setName('Bijlagen');
        $property->setType('string');
        $property->setFormat('file');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        //6e pagina
        $id = Uuid::fromString('2df9cd9f-45f6-4aa5-a4d1-767c4a621ce7');
        $property = new Property();
        $property->setTitle('zijn uw gegevens juis en naarwaarheid ingevult?');
        $property->setName('ControlerenGegevens');
        $property->setType('boolian');
        $property->setFormat('radio');
        $property->setEnum(['ja']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
