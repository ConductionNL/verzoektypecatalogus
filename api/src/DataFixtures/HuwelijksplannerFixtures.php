<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class HuwelijksplannerFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if ($this->params->get('app_domain') != 'huwelijksplanner.online' && strpos($this->params->get('app_domain'), 'huwelijksplanner.online') == false) {
            //return false;
        }

        /*
         *  Bezwaar
         */
        $id = Uuid::fromString('282f203c-4ecf-4578-9597-343ceccf8f43');
        $bezwaar = new RequestType();
        $bezwaar->setIcon('fal fa-file-certificate');
        $bezwaar->setOrganization('0000');
        $bezwaar->setName('VOG');
        $bezwaar->setDescription('Aanvraag verklaring omtrend gedrag');
        $manager->persist($bezwaar);
        $bezwaar->setId($id);
        $manager->persist($bezwaar);
        $manager->flush();
        $bezwaar = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Aanvraag');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Waarvoor vraagt u de vog aan');
        $stage1->setRequestType($bezwaar);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($bezwaar);
        $manager->persist($stage2);

        /*
         *  Bezwaar
         */
        $id = Uuid::fromString('2a86f09a-5cfc-443e-a54e-4f4b2f2693da');
        $bezwaar = new RequestType();
        $bezwaar->setIcon('fal fa-id-card');
        $bezwaar->setOrganization('0000');
        $bezwaar->setName('Rijbewijs');
        $bezwaar->setDescription('Het maken van bezwaar tegen een genomen besluit');
        $manager->persist($bezwaar);
        $bezwaar->setId($id);
        $manager->persist($bezwaar);
        $manager->flush();
        $bezwaar = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Aanvraag');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Waarom maakt u bezwaar');
        $stage1->setRequestType($bezwaar);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($bezwaar);
        $manager->persist($stage2);

        $id = Uuid::fromString('6aa060d4-ca79-45ac-9836-1522fd10eb42');
        $bezwaar = new RequestType();
        $bezwaar->setIcon('fal fa-file-search');
        $bezwaar->setOrganization('0000');
        $bezwaar->setName('Vermissing Rijbewijs');
        $bezwaar->setDescription('Het maken van bezwaar tegen een genomen besluit');
        $manager->persist($bezwaar);
        $bezwaar->setId($id);
        $manager->persist($bezwaar);
        $manager->flush();
        $bezwaar = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Melding');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('WOmschrijf hoe u uw rijbewijs bent kwijt graakt');
        $stage1->setRequestType($bezwaar);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($bezwaar);
        $manager->persist($stage2);

        /*
         *  Bezwaar
         */
        //Bewijs van in leven zijn/attestatie de vita.
        //Bewijs van ongehuwd geregistreerd staan.
        //Bewijs van Nederlanderschap.
        $id = Uuid::fromString('e7e30a18-4bc4-458b-8a66-fd2dc779db13');
        $bezwaar = new RequestType();
        $bezwaar->setIcon('fal fa-file-user');
        $bezwaar->setOrganization('0000');
        $bezwaar->setName('Uitreksel BRP');
        $bezwaar->setDescription('Het maken van bezwaar tegen een genomen besluit');
        $manager->persist($bezwaar);
        $bezwaar->setId($id);
        $manager->persist($bezwaar);
        $manager->flush();
        $bezwaar = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Type');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('string');
        $stage1->setDescription('Wat is de verhuisdatum?');
        $stage1->setRequestType($bezwaar);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($bezwaar);
        $manager->persist($stage2);

        /*
         *  Bezwaar
         */
        $id = Uuid::fromString('5fe5ed51-f9d1-4ece-b78d-e960e6ce3fd1');
        $bezwaar = new RequestType();
        $bezwaar->setIcon('fal fa-surprise');
        $bezwaar->setOrganization('0000');
        $bezwaar->setName('Bezwaar');
        $bezwaar->setDescription('Het maken van bezwaar tegen een genomen besluit');
        $manager->persist($bezwaar);
        $bezwaar->setId($id);
        $manager->persist($bezwaar);
        $manager->flush();
        $bezwaar = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Bezwaar');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('string');
        $stage1->setDescription('Wat is de verhuisdatum?');
        $stage1->setRequestType($bezwaar);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($bezwaar);
        $manager->persist($stage2);

        /*
         *  WOB
         */
        $id = Uuid::fromString('f4c2d525-5c73-4000-ad71-242a37892be7');
        $wob = new RequestType();
        $wob->setIcon('fal fa-binoculars');
        $wob->setOrganization('0000');
        $wob->setName('WOB Verzoek');
        $wob->setDescription('Een verzoek conform de wet openbaarheid bestuur');
        $manager->persist($wob);
        $wob->setId($id);
        $manager->persist($wob);
        $manager->flush();
        $wob = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Verzoek');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('form');
        $stage1->setType('string');
        $stage1->setFormat('string');
        $stage1->setDescription('Wat is de verhuisdatum?');
        $stage1->setRequestType($wob);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($wob);
        $manager->persist($stage2);

        /*
         *  Geboorte
         */
        $id = Uuid::fromString('d8d053cf-573a-4cbd-8b15-4681372cc2c8');
        $geboorte = new RequestType();
        $geboorte->setIcon('fal fa-baby');
        $geboorte->setOrganization('0000');
        $geboorte->setName('Geboorte aangifte');
        $geboorte->setDescription('Het aangeven van een nieuw geboren kind');
        $manager->persist($geboorte);
        $geboorte->setId($id);
        $manager->persist($geboorte);
        $manager->flush();
        $geboorte = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Datum');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('datum');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Wat is de geboorte datum?');
        $stage1->setRequestType($geboorte);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Ouders');
        $stage2->setIcon('fal fa-user-friends');
        $stage2->setSlug('ouder');
        $stage2->setType('array');
        $stage2->setFormat('bsn');
        $stage2->setMinItems(2);
        $stage2->setMaxItems(2);
        $stage2->setRequired(true);
        $stage2->setDescription('Wie zijn de ouders');
        $stage2->setRequestType($geboorte);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Gemeente');
        $stage3->setIcon('fal fa-university');
        $stage3->setSlug('gemeente');
        $stage3->setType('string');
        $stage3->setFormat('uri');
        $stage3->setRequired(true);
        $stage3->setDescription('In welke gemeente heeft de geboorte plaatsgevonden?');
        $stage3->setRequestType($geboorte);
        $manager->persist($stage3);

        $stage4 = new Property();
        $stage4->addPrevious($stage3);
        $stage4->setTitle('Naam');
        $stage4->setIcon('fal fa-user');
        $stage4->setSlug('naam');
        $stage4->setType('string');
        $stage4->setFormat('uri');
        $stage4->setRequired(true);
        $stage4->setDescription('Wat wordt de naamgeving van het kinds');
        $stage4->setRequestType($geboorte);
        $manager->persist($stage4);

        $stage5 = new Property();
        $stage5->addPrevious($stage4);
        $stage5->setTitle('Indienen');
        $stage5->setIcon('fal fa-paper-plane');
        $stage5->setSlug('indienen');
        $stage5->setDescription('Wie zijn de getuigen van partner?');
        $stage5->setRequestType($geboorte);
        $manager->persist($stage5);

        /*
         *  Overleiden
         */
        $id = Uuid::fromString('41ccbba0-241c-4801-a70d-f11894a1098a');
        $overlijden = new RequestType();
        $overlijden->setIcon('fal fa-tombstone');
        $overlijden->setOrganization('0000');
        $overlijden->setName('Overlijdens aangifte');
        $overlijden->setDescription('Het doorgeven van overlijden aan een gemeente');
        $manager->persist($overlijden);
        $overlijden->setId($id);
        $manager->persist($overlijden);
        $manager->flush();
        $overlijden = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Datum');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('datum');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Wat is de verhuisdatum?');
        $stage1->setRequestType($overlijden);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Wie');
        $stage2->setIcon('fal fa-user');
        $stage2->setSlug('overleden');
        $stage2->setType('string');
        $stage2->setFormat('bsn');
        $stage2->setRequired(true);
        $stage2->setDescription('Wat is er overleden');
        $stage2->setRequestType($overlijden);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Waar');
        $stage3->setIcon('fal fa-university');
        $stage3->setSlug('gemeente');
        $stage3->setType('string');
        $stage3->setFormat('uri');
        $stage3->setRequired(true);
        $stage3->setDescription('In welke gemeente heeft het overleiden plaatsgevonden?');
        $stage3->setRequestType($overlijden);
        $manager->persist($stage3);

        $stage4 = new Property();
        $stage4->addPrevious($stage3);
        $stage4->setTitle('Indienen');
        $stage4->setIcon('fal fa-paper-plane');
        $stage4->setSlug('indienen');
        $stage4->setDescription('Wie zijn de getuigen van partner?');
        $stage4->setRequestType($overlijden);
        $manager->persist($stage4);

        /*
         *  Reisdocument
         */
        $id = Uuid::fromString('58d2e5ea-e592-48c1-86c4-93b43d8aac5c');
        $reisdocument = new RequestType();
        $reisdocument->setOrganization('0000');
        $reisdocument->setName('Aanvraag Reisdocument');
        $reisdocument->setDescription('Het aanvragen van een reisdocument');
        $manager->persist($reisdocument);
        $reisdocument->setId($id);
        $manager->persist($reisdocument);
        $manager->flush();
        $reisdocument = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Type');
        $stage1->setIcon('fal fa-passport');
        $stage1->setSlug('document');
        $stage1->setType('string');
        $stage1->setFormat('bsn');
        $stage1->setRequired(true);
        $stage1->setDescription('Wat voor reisdocument wilt u aanvragen?');
        $stage1->setRequestType($reisdocument);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Foto');
        $stage2->setIcon('fal fa-portrait');
        $stage2->setSlug('foto');
        $stage2->setType('string');
        $stage2->setFormat('base64');
        $stage2->setRequired(true);
        $stage2->setDescription('Upload een recente pasfote');
        $stage2->setRequestType($reisdocument);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Indienen');
        $stage3->setIcon('fal fa-paper-plane');
        $stage3->setSlug('indienen');
        $stage3->setDescription('Wie zijn de getuigen van partner?');
        $stage3->setRequestType($reisdocument);
        $manager->persist($stage3);

        $id = Uuid::fromString('690cbb51-50b8-4714-b45b-2dba696b1216');
        $reisdocument = new RequestType();
        $reisdocument->setOrganization('0000');
        $reisdocument->setName('Vermissing Reisdocument');
        $reisdocument->setDescription('Het aanvragen van een reisdocument');
        $manager->persist($reisdocument);
        $reisdocument->setId($id);
        $manager->persist($reisdocument);
        $manager->flush();
        $reisdocument = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Type');
        $stage1->setIcon('fal fa-passport');
        $stage1->setSlug('document');
        $stage1->setType('string');
        $stage1->setFormat('bsn');
        $stage1->setRequired(true);
        $stage1->setDescription('Wat voor reisdocument wilt u aanvragen?');
        $stage1->setRequestType($reisdocument);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage2);
        $stage2->setTitle('Indienen');
        $stage2->setIcon('fal fa-paper-plane');
        $stage2->setSlug('indienen');
        $stage2->setDescription('Wie zijn de getuigen van partner?');
        $stage2->setRequestType($reisdocument);
        $manager->persist($stage2);

        /*
         *  Melding openbare ruimte
         */
        $id = Uuid::fromString('07b9df95-cc8a-43c8-bc1e-5f1392973b39');
        $mob = new RequestType();
        $mob->setIcon('fal fa-map-marker-edit');
        $mob->setOrganization('0000');
        $mob->setName('Melding openbare ruimte');
        $mob->setDescription('Het doorgeven van melding openbare ruimte');
        $manager->persist($mob);
        $mob->setId($id);
        $manager->persist($mob);
        $manager->flush();
        $mob = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Wat');
        $stage1->setIcon('fal fa-map-marked');
        $stage1->setSlug('locatie');
        $stage1->setType('string');
        $stage1->setFormat('bag');
        $stage1->setRequired(true);
        $stage1->setDescription('Wat is het nieuwe adres?');
        $stage1->setRequestType($mob);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Melding');
        $stage2->setIcon('fal fa-comment');
        $stage2->setSlug('melding');
        $stage2->setType('string');
        $stage2->setFormat('text');
        $stage2->setRequired(true);
        $stage2->setDescription('Melding');
        $stage2->setRequestType($mob);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Indiener');
        $stage3->setIcon('fal fa-user');
        $stage3->setSlug('contactgegevens');
        $stage3->setType('string');
        $stage3->setFormat('text');
        $stage3->setDescription('Melding');
        $stage3->setRequestType($mob);
        $manager->persist($stage2);

        /*
    	 *  Verhuizen
    	 */
        $id = Uuid::fromString('2bfb3cea-b5b5-459c-b3e0-e1100089a11a');
        $verhuizenNL = new RequestType();
        $verhuizenNL->setIcon('fal fa-truck-moving');
        $verhuizenNL->setOrganization('0000');
        $verhuizenNL->setName('Verhuizen');
        $verhuizenNL->setDescription('Het doorgeven van een verhuizing aan een gemeente');
        $manager->persist($verhuizenNL);
        $verhuizenNL->setId($id);
        $manager->persist($verhuizenNL);
        $manager->flush();
        $verhuizenNL = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('69d16301-5e45-449d-b208-ba3efdca4f1d');
        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Datum');
        $stage1->setIcon('fal fa-calendar-day');
        $stage1->setSlug('datum');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Wat is de verhuisdatum?');
        $stage1->setRequestType($verhuizenNL);
        $manager->persist($stage1);
        $stage1->setId($id);
        $manager->persist($stage1);
        $manager->flush();
        $stage1 = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);

        $id = Uuid::fromString('368fc9ce-6238-4e7c-ad4c-09c797e1f3f9');
        $stage2 = new Property();
        $stage2->setTitle('Adres');
        $stage2->setIcon('fal fa-map-marked');
        $stage2->setSlug('adres');
        $stage2->setType('string');
        $stage2->setFormat('bag');
        $stage2->setRequired(true);
        $stage2->setDescription('Wat is het nieuwe adres?');
        $stage2->setRequestType($verhuizenNL);
        $manager->persist($stage2);
        $stage2->setId($id);
        $manager->persist($stage2);
        $manager->flush();
        $stage2 = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);
        $stage2->addPrevious($stage1);
        $manager->persist($stage2);
        $manager->flush();

        $id = Uuid::fromString('b6942884-574a-45b3-b2ca-36733d800ca4');
        $stage3 = new Property();
        //$property->setId('');
        $stage3->setTitle('Wie');
        $stage3->setIcon('fal fa-users');
        $stage3->setSlug('verhuizenden');
        $stage3->setType('array');
        $stage3->setFormat('bsn');
        $stage3->setRequired(true);
        $stage3->setDescription('Wie gaan er verhuizen?');
        $stage3->setRequestType($verhuizenNL);
        $manager->persist($stage3);
        $stage3->setId($id);
        $manager->persist($stage3);
        $manager->flush();
        $stage3 = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);
        $stage3->addPrevious($stage2);
        $manager->persist($stage3);
        $manager->flush();

        $id = Uuid::fromString('9d76fb58-0711-4437-acc4-9f4d9d403cdf');
        $verhuizenDenBosh = new RequestType();
        $verhuizenDenBosh->setName('Verhuizen');
        $verhuizenDenBosh->setIcon('fal fa-truck-moving');
        $verhuizenDenBosh->setDescription('Het doorgeven van een verhuizing aan de gemeente \'s-Hertogenbosch');
        $verhuizenDenBosh->setOrganization('001709124');
        $verhuizenDenBosh->setExtends($verhuizenNL);
        $manager->persist($verhuizenDenBosh);
        $verhuizenDenBosh->setId($id);
        $manager->persist($verhuizenDenBosh);
        $manager->flush();
        $verhuizenDenBosh = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        //$verhuizenNL->setId('');
        $stage1->setTitle('Email');
        $stage1->setIcon('fal fa-envelope');
        $stage1->setSlug('email');
        $stage1->setDescription('Het e-mail addres dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage1->setType('string');
        $stage1->setFormat('email');
        $stage1->setRequired(true);
        $stage1->setRequestType($verhuizenDenBosh);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        //$verhuizenNL->setId('');
        $stage2->setTitle('Telefoon');
        $stage2->setIcon('fal fa-phone');
        $stage2->setSlug('telefoon');
        $stage2->setDescription('Het telefoon nummer dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage2->setType('string');
        $stage2->setFormat('string');
        $stage2->setRequired(true);
        $stage2->setRequestType($verhuizenDenBosh);
        $manager->persist($stage2);

        $id = Uuid::fromString('fc79c4c9-b3b3-4258-bdbb-449262f3e5d7');
        $verhuizenEindhoven = new RequestType();
        $verhuizenEindhoven->setName('Verhuizen');
        $verhuizenEindhoven->setIcon('fal fa-truck-moving');
        $verhuizenEindhoven->setDescription('Het doorgeven van een verhuizing aan de gemeente Eindhoven');
        $verhuizenEindhoven->setOrganization('001902763');
        $verhuizenEindhoven->setExtends($verhuizenNL);
        $manager->persist($verhuizenEindhoven);
        $verhuizenEindhoven->setId($id);
        $manager->persist($verhuizenEindhoven);
        $manager->flush();
        $verhuizenEindhoven = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Eigenaar');
        $stage1->setIcon('fal fa-user');
        $stage1->setSlug('eigenaar');
        $stage1->setDescription('Bent u de eigenaar van de woning waar u heen verhuist?');
        $stage1->setType('boolean');
        $stage1->setFormat('boolean');
        $stage1->setRequired(true);
        $stage1->setRequestType($verhuizenEindhoven);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        //$verhuizenNL->setId('');
        $stage2->setTitle('Doorgeven gegevens');
        $stage2->setIcon('');
        $stage2->setSlug('notificatie');
        $stage2->setDescription('Wilt u dat we uw verhuizing ook doorgeven aan postNl?');
        $stage2->setType('boolean');
        $stage2->setFormat('boolean');
        $stage2->setRequestType($verhuizenEindhoven);
        $manager->persist($stage2);

        /*
    	 *  Trouwen
    	 */

        // Aanpassen naamsgebruik
        $id = Uuid::fromString('4830cd4c-d8ce-4f8c-a8ad-f3dc821911f3');
        $request = new RequestType();
        $request->setOrganization('002220647');
        $request->setIcon('fas fa-user-tie');
        $request->setName('Wijziging Naamsgebruik');
        $request->setDescription('Met dit verzoek kunt u achternaam aanpassen');
        $request->setCaseType('1ca29793-b797-4d52-953b-2c231fb8a6cf');
        $request->setCamundaProces('Aanvraag_wijziging_naamgebruik_behandelen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('Partner 1');
        $property->setName('naamgebruikPartner1');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setDescription('Welke naam wilt u');
        $property->setRequestType($request);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Partner 2');
        $property->setName('naamgebruikPartner2');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setDescription('Welke naam wilt partner 2');
        $property->setRequestType($request);
        $manager->persist($property);

        // Verztype Babs andere gemeente
        $id = Uuid::fromString('27f6ecf0-34bb-4100-a375-d14f2d5ee1d0');
        $request = new RequestType();
        $request->setOrganization('002220647');
        $request->setIcon('fas fa-user-tie');
        $request->setName('Aanvraag babs andere gemeente');
        $request->setDescription('Met dit verzoek kunt u een ambtenaar voor aan andere gemeente aanvragen');
        $request->setCaseType('43340378-1c3a-4605-8a64-aa90e400368a');
        $request->setCamundaProces('Aanvraag_eigen_babs_beedigd_behandelen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Gegevens');
        $stage1->setIcon('fal fa-user');
        $stage1->setSlug('babs-andere-gemeente');
        $stage1->setType('array');
        $stage1->setIri('irc/assent');
        $stage1->setDescription('Wat zijn de adress gegevens van uw beoogde babs');
        $stage1->setRequestType($request);
        $manager->persist($stage1);

        // Aanvraag babs voor een dag
        $id = Uuid::fromString('cdd7e88b-1890-425d-a158-7f9ec92c9508');
        $request = new RequestType();
        $request->setIcon('fas fa-user-tie');
        $request->setOrganization('002220647');
        $request->setName('Aanvraag babs (niet beëdigd)');
        $request->setDescription('Aanvraag babs (niet beëdigd)');
        $request->setCaseType('zaaktypen/86dcc827-db64-4466-8d83-5d2976a1926a');
        $request->setCamundaProces('Aanvraag_eigen_Babs_niet_beedigd_behandelen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Gegevens');
        $stage1->setIcon('fal fa-user');
        $stage1->setSlug('babs-voor-een-dag');
        $stage1->setIri('irc/assent');
        $stage1->setType('array');
        $stage1->setDescription('Wat zijn de contact gegevens van uw beoogd BABS');
        $stage1->setRequestType($request);
        $manager->persist($stage1);

        // Aanvraag trouwlocatie
        $id = Uuid::fromString('c8704ea6-4962-4b7e-8d4e-69a257aa9577');
        $aanvraagLocatie = new RequestType();
        $aanvraagLocatie->setIcon('fal fa-rings-wedding');
        $aanvraagLocatie->setOrganization('002220647');
        $aanvraagLocatie->setName('Aanvraag trouwlocatie');
        $aanvraagLocatie->setDescription('Melding voorgenomen huwelijk');
        $aanvraagLocatie->setCaseType('bb1e251f-d7a2-4d2a-a8e4-a7236336fcfd');
        $aanvraagLocatie->setCamundaProces('Aanvraag_eigen_locatie_behandelen');
        $manager->persist($aanvraagLocatie);
        $aanvraagLocatie->setId($id);
        $manager->persist($aanvraagLocatie);
        $manager->flush();
        $aanvraagLocatie = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $property = new Property();
        $property->setStart(true);
        $property->setTitle('Afwijkende trouw locatie');
        $property->setName('afwijkende_trouw_locatie');
        $property->setSlug('afwijkende_trouw_locatie');
        $property->setIcon('fal fa-paper-plane');
        $property->setType('array');
        $property->setDescription('Wat zijn de gegevens van uw locatie');
        $property->setRequestType($aanvraagLocatie);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Naam');
        $property->setName('locatieNaam');
        $property->setIcon('fal fa-paper-plane');
        $property->setType('string');
        $property->setDescription('Wat is de naam van uw beoogde locatie');
        $property->setRequestType($aanvraagLocatie);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setName('locatieTelefoon');
        $property->setIcon('fal fa-paper-plane');
        $property->setType('string');
        $property->setDescription('Wat is het telefoon nummer van uw beoogde locatie');
        $property->setRequestType($aanvraagLocatie);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Adres');
        $property->setName('locatieAdres');
        $property->setIcon('fal fa-paper-plane');
        $property->setType('string');
        $property->setDescription('Wat is het adress van uw beoogde locatie');
        $property->setRequestType($aanvraagLocatie);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Omschrijving');
        $property->setName('locatieOmschrijving');
        $property->setIcon('fal fa-paper-plane');
        $property->setType('string');
        $property->setDescription('Kunt u een korte omschrijving geven van uw beoogde locatie');
        $property->setRequestType($aanvraagLocatie);
        $manager->persist($property);

        // Melding Huwelijk
        $id = Uuid::fromString('146cb7c8-46b9-4911-8ad9-3238bab4313e');
        $meldingTrouwenNL = new RequestType();
        $meldingTrouwenNL->setIcon('fal fa-ring');
        $meldingTrouwenNL->setOrganization('002220647');
        $meldingTrouwenNL->setName('Melding voorgenomen huwelijk');
        $meldingTrouwenNL->setDescription('Melding voorgenomen huwelijk');
        $meldingTrouwenNL->setCaseType('13c5e8e1-27e2-47e0-96df-410541176623');
        $meldingTrouwenNL->setCamundaProces('Melding_voorgenomen_huwelijk_behandelen');
        $manager->persist($meldingTrouwenNL);
        $meldingTrouwenNL->setId($id);
        $manager->persist($meldingTrouwenNL);
        $manager->flush();
        $meldingTrouwenNL = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($meldingTrouwenNL);
        $task->setName('Verlopen melding');
        $task->setDescription('Deze task controleerd na 1 jaar het verlopen van de melding');
        $task->setCode('controleer_meldingin');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('update');
        $task->setTimeInterval('P1Y');

        $manager->persist($task);

        $task = new Task();
        $task->setRequestType($meldingTrouwenNL);
        $task->setName('Informeer Verlopen melding');
        $task->setDescription('Deze task verstuurd na 300 dagen een waarschuwing voor het verlopen van de melding');
        $task->setCode('informeren verlopen melding');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('update');
        $task->setTimeInterval('P300D');

        $manager->persist($task);

        $task = new Task();
        $task->setRequestType($meldingTrouwenNL);
        $task->setName('Bevestig naar burger');
        $task->setDescription('Deze ttaak bevestig het huwelijk naar de burger');
        $task->setCode('bevestig_huwelijk');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('create');
        $task->setTimeInterval('P0D'); // vertraging vna 0 dagen = meteen

        $manager->persist($task);

        $stage0 = new Property();
        $stage0->setStart(true);
        $stage0->setTitle('Info');
        $stage0->setIcon('fas fa-ring');
        $stage0->setSlug('info-melding');
        $stage0->setDescription('Hier wordt de benodigde informatie weergegeven voor het indienen van een melding.');
        $stage0->setRequestType($meldingTrouwenNL);
        $manager->persist($stage0);

        $stage1 = new Property();
        $stage1->addPrevious($stage0);
        $stage1->setTitle('Datum');
        $stage1->setIcon('fas fa-calendar-day');
        $stage1->setSlug('datum-melding');
        $stage1->setType('boolean');
        $stage1->setDescription('Selecteer een datum voor de omzetting naar huwelijk');
        $stage1->setRequestType($meldingTrouwenNL);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Partners');
        $stage2->setIcon('fas fa-user-friends');
        $stage2->setSlug('partner-melding');
        $stage2->setIri('irc/assent');
        $stage2->setType('array');
        $stage2->setFormat('bsn');
        $stage2->setMinItems(2);
        $stage2->setMaxItems(2);
        $stage2->setRequired(true);
        $stage2->setDescription('Wie zijn de partners?');
        $stage2->setRequestType($meldingTrouwenNL);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Getuigen');
        $stage3->setIcon('fas fa-users');
        $stage3->setSlug('getuige-melding');
        $stage3->setIri('irc/assent');
        $stage3->setType('array');
        $stage3->setFormat('bsn');
        $stage3->setMinItems(2);
        $stage3->setMaxItems(4);
        $stage3->setRequired(true);
        $stage3->setDescription('Wie zijn de getuigen van partner?');
        $stage3->setRequestType($meldingTrouwenNL);
        $manager->persist($stage3);

        $stage4 = new Property();
        $stage4->addPrevious($stage3);
        $stage4->setTitle('Indienen');
        $stage4->setIcon('fal fa-paper-plane');
        $stage4->setSlug('indienen-melding');
        $stage4->setDescription('Wie zijn de getuigen van partner?');
        $stage4->setRequestType($meldingTrouwenNL);
        $manager->persist($stage4);

        $id = Uuid::fromString('432d3e81-5930-4c21-ab7f-c5541c948525');
        $omzettingNL = new RequestType();
        $omzettingNL->setIcon('fal fa-rings-wedding');
        $omzettingNL->setOrganization('0000');
        $omzettingNL->setName('Omzetting');
        $omzettingNL->setDescription('Het omzetten van een bestaand partnerschap in een huwelijk.');
        $manager->persist($omzettingNL);
        $omzettingNL->setId($id);
        $manager->persist($omzettingNL);
        $manager->flush();
        $omzettingNL = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Datum');
        $stage1->setIcon('fas fa-calendar-day');
        $stage1->setSlug('datum');
        $stage1->setType('string');
        $stage1->setFormat('date');
        $stage1->setDescription('Selecteer een datum voor de omzetting naar huwelijk');
        $stage1->setRequestType($omzettingNL);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Partners');
        $stage2->setIcon('fas fa-user-friends');
        $stage2->setSlug('partner');
        $stage2->setType('array');
        $stage2->setFormat('bsn');
        $stage2->setMinItems(2);
        $stage2->setMaxItems(2);
        $stage2->setRequired(true);
        $stage2->setDescription('Wie zijn de getuigen van partner 2?');
        $stage2->setRequestType($omzettingNL);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Indienen');
        $stage3->setIcon('fal fa-paper-plane');
        $stage3->setSlug('indienen');
        $stage3->setDescription('Wie zijn de getuigen van partner?');
        $stage3->setRequestType($meldingTrouwenNL);
        $manager->persist($stage3);

        $id = Uuid::fromString('5b10c1d6-7121-4be2-b479-7523f1b625f1');
        $trouwenNL = new RequestType();
        $trouwenNL->setIcon('fal fa-rings-wedding');
        $trouwenNL->setOrganization('002220647');
        $trouwenNL->setName('Huwelijk / Partnerschap');
        $trouwenNL->setDescription('Huwelijk / Partnerschap');
        $trouwenNL->setUnique(true);
        $manager->persist($trouwenNL);
        $trouwenNL->setId($id);
        $manager->persist($trouwenNL);
        $manager->flush();
        $trouwenNL = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($trouwenNL);
        $task->setName('Verlopen reservering');
        $task->setDescription('Deze task controleerd na 5 dagen het verlopen van de reservering');
        $task->setCode('start_huwelijk');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('update');
        $task->setTimeInterval('P5D');

        $manager->persist($task);

        // Inladen van de kinderen
        /*
        $trouwenNL->addChild($aanvraagBabs);
        $trouwenNL->addChild($aanvraagLocatie);
        $trouwenNL->addChild($meldingTrouwenNL);
        */

        $stage0 = new Property();
        $stage0->setStart(true);
        $stage0->setTitle('Start Huwelijk');
        $stage0->setIcon('fas fa-ring');
        $stage0->setName('start_huwelijk');
        $stage0->setSlug('start_huwelijk');
        $stage0->setDescription('Wat moet u zo meteen invullen?');
        $stage0->setRequestType($trouwenNL);
        $manager->persist($stage0);

        $stage1 = new Property();
        $stage1->addPrevious($stage0);
        $stage1->setTitle('Ceremonie');
        $stage1->setName('type');
        $stage1->setIcon('fas fa-ring');
        $stage1->setSlug('ceremonie');
        $stage1->setType('string');
        $stage1->setFormat('string');
        $stage1->setMaxLength('12');
        $stage1->setMinLength('7');
        $stage1->setEnum(['trouwen', 'partnerschap', 'omzetten']);
        $stage1->setRequired(true);
        $stage1->setDescription('Selecteer een huwelijk of partnerschap?');
        $stage1->setRequestType($trouwenNL);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        $stage2->setTitle('Partners');
        $stage2->setIcon('fas fa-user-friends');
        $stage2->setSlug('partner');
        $stage2->setType('array');
        $stage2->setFormat('url');
        $stage2->setIri('irc/assent');
        $stage2->setMinItems(2);
        $stage2->setMaxItems(2);
        $stage2->setRequired(true);
        $stage2->setDescription('Wie zijn de getuigen van partner 2?');
        $stage2->setRequestType($trouwenNL);
        $manager->persist($stage2);

        $stage3 = new Property();
        $stage3->addPrevious($stage2);
        $stage3->setTitle('Plechtigheid  ');
        $stage3->setIcon('fas fa-glass-cheers');
        $stage3->setSlug('plechtigheid');
        $stage3->setType('string');
        $stage3->setFormat('url');
        $stage3->setIri('pdc/offer');
        $stage3->setRequired(true);
        $stage3->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $stage3->setRequestType($trouwenNL);
        $manager->persist($stage3);

        $stage4 = new Property();
        $stage4->addPrevious($stage3);
        $stage4->setTitle('Datum');
        $stage4->setIcon('fas fa-calendar-day');
        $stage4->setSlug('datum');
        $stage4->setType('string');
        $stage4->setFormat('date');
        $stage4->setDescription('Selecteer een datum voor de omzetting naar huwelijk');
        $stage4->setRequestType($trouwenNL);
        $manager->persist($stage4);

        $stage5 = new Property();
        $stage5->addPrevious($stage4);
        $stage5->setTitle('Locatie');
        $stage5->setIcon('fas fa-building');
        $stage5->setSlug('locatie');
        $stage5->setType('string');
        $stage5->setFormat('uri');
        $stage5->setIri('pdc/offer');
        $stage5->setMaxLength('255');
        $stage5->setRequired(true);
        $stage5->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $stage5->setRequestType($trouwenNL);
        $manager->persist($stage5);

        $stage6 = new Property();
        $stage6->addPrevious($stage5);
        $stage6->setTitle('Ambtenaar');
        $stage6->setIcon('fas fa-user-tie');
        $stage6->setSlug('ambtenaar');
        $stage6->setType('string');
        $stage6->setFormat('url');
        $stage6->setIri('pdc/offer');
        $stage6->setMaxLength('255');
        $stage6->setRequired(true);
        $stage6->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $stage6->setRequestType($trouwenNL);
        $manager->persist($stage6);

        $stage7 = new Property();
        $stage7->addPrevious($stage6);
        $stage7->setTitle('Getuigen');
        $stage7->setIcon('fas fa-users');
        $stage7->setSlug('getuige');
        $stage7->setType('array');
        $stage7->setFormat('url');
        $stage7->setIri('irc/assent');
        $stage7->setMinItems(2);
        $stage7->setMaxItems(4);
        $stage7->setRequired(true);
        $stage7->setDescription('Wie zijn de getuigen van partner?');
        $stage7->setRequestType($trouwenNL);
        $manager->persist($stage7);

        $stage8 = new Property();
        $stage8->addPrevious($stage7);
        $stage8->setTitle('Extras');
        $stage8->setIcon('fas fa-gift');
        $stage8->setSlug('extra');
        $stage8->setType('array');
        $stage8->setFormat('url');
        $stage8->setIri('pdc/offer');
        $stage8->setMinItems(1);
        $stage8->setRequired(true);
        $stage8->setDescription('Wie zijn de getuigen van partner?');
        $stage8->setRequestType($trouwenNL);
        $manager->persist($stage8);

        $overige = new Property();
        $overige->addPrevious($stage8);
        $overige->setTitle('Overig');
        $overige->setIcon('fal fa-file-alt');
        $overige->setSlug('overig');
        $overige->setMinItems(3);
        $overige->setMaxItems(3);
        $overige->setType('array');
        $overige->setMinItems(4);
        $overige->setFormat('string');
        $overige->setDescription('Graag zouden wij u om wat extra informatie vragen');
        $overige->setRequestType($trouwenNL);
        $manager->persist($overige);

        $stage9 = new Property();
        $stage9->addPrevious($overige);
        $stage9->setTitle('Melding ');
        $stage9->setIcon('fas fa-envelope');
        $stage9->setSlug('melding');
        $stage9->setType('string');
        $stage9->setFormat('url');
        $stage9->setIri('vrc/request');
        $stage9->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $stage9->setRequestType($trouwenNL);
        $manager->persist($stage9);

        $stage10 = new Property();
        $stage10->addPrevious($stage9);
        $stage10->setTitle('Betaling ');
        $stage10->setName('Betalen');
        $stage10->setIcon('fas fa-cash-register');
        $stage10->setSlug('betalen');
        $stage10->setType('string');
        $stage10->setFormat('url');
        $stage10->setIri('bs/invoice');
        $stage10->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $stage10->setRequestType($trouwenNL);
        $manager->persist($stage10);

        $stage11 = new Property();
        $stage11->addPrevious($stage10);
        $stage11->setTitle('Reserveren ');
        $stage11->setIcon('fas fa-calendar-check');
        $stage11->setSlug('checklist');
        $stage11->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $stage11->setRequestType($trouwenNL);
        $manager->persist($stage11);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Bestelling');
        $property->setName('order');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('orc/order');
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Leeftijd');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/leeftijdscheckhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Zijn bijde parnters op de trouwdatum meerderjarig');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Curatele');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/curatelecheckhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Staan bijde partners niet onder curatele');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Familiaregraad');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('ptc/familiaregraadhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Zijn bijde parnters geen fammilie dichter dan de 4e graad');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('schijnhuwelijk');
        $property->setType('array');
        $property->setFormat('url');
        $property->setIri('ptc/schijnhuwelijk');
        $property->setRequired(true);
        $property->setDescription('Hebben bijde partners aangegeven niet te trouwen onder dwang');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Opmerkingen / Wensen');
        $property->setName('wensen');
        $property->setType('string');
        $property->setFormat('url');
        $property->setDescription('zijn er vanuit de partners nog opmerkingen of wensen?');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $id = Uuid::fromString('47577f44-0ede-4655-a629-027f051d2b07');
        $trouwenUtrecht = new RequestType();
        $trouwenUtrecht->setExtends($trouwenNL);
        $trouwenUtrecht->setOrganization('002220647');
        $trouwenUtrecht->setName('Trouwen of Partnerschap in Utrecht');
        $trouwenUtrecht->setDescription('Trouwen of Partnerschap in Utrecht');
        $manager->persist($trouwenUtrecht);
        $trouwenUtrecht->setId($id);
        $manager->persist($trouwenUtrecht);

        $manager->flush();
    }
}
