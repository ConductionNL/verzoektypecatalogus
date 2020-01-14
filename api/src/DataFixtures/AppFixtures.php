<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*
    	 *  Verhuizen
    	 */
        $id = Uuid::fromString('2bfb3cea-b5b5-459c-b3e0-e1100089a11a');

        $verhuizenNL = new RequestType();
        $verhuizenNL->setId($id);
        $verhuizenNL->setSourceOrganization('0000');
        $verhuizenNL->setName('Verhuizen');
        $verhuizenNL->setDescription('Het doorgeven van een verhuizing aan een gemeente');
        $manager->persist($verhuizenNL);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Datum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de verhuisdatum?');
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Adress');
        $property->setType('string');
        $property->setFormat('bag');
        $property->setRequired(true);
        $property->setDescription('Wat is het nieuwe adres?');
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $property = new Property();
        //$property->setId('');
        $property->setTitle('Wie');
        $property->setType('array');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Wie gaan er verhuizen?');
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $id = Uuid::fromString('9d76fb58-0711-4437-acc4-9f4d9d403cdf');
        $verhuizenDenBosh = new RequestType();
        $verhuizenDenBosh->setName('Verhuizen');
        $verhuizenDenBosh->setDescription('Het doorgeven van een verhuizing aan de gemeente \'s-Hertogenbosch');
        $verhuizenDenBosh->setSourceOrganization('001709124');
        $verhuizenDenBosh->setExtends($verhuizenNL);
        $manager->persist($verhuizenDenBosh);
        $verhuizenDenBosh->setId($id);
        $manager->persist($verhuizenDenBosh);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Email');
        $property->setDescription('Het e-mail addres dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Telefoon');
        $property->setDescription('Het telefoon nummer dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequired(true);
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $verhuizenEindhoven = new RequestType();
        //$verhuizenEindhoven->setId('fc79c4c9-b3b3-4258-bdbb-449262f3e5d7');
        $verhuizenEindhoven->setName('Verhuizen');
        $verhuizenEindhoven->setDescription('Het doorgeven van een verhuizing aan de gemeente Eindhoven');
        $verhuizenEindhoven->setSourceOrganization('001902763');
        $verhuizenEindhoven->setExtends($verhuizenNL);
        $manager->persist($verhuizenEindhoven);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Eigenaar');
        $property->setDescription('Bent u de eigenaar van de woning waar u heen verhuist?');
        $property->setType('boolean');
        $property->setFormat('boolean');
        $property->setRequired(true);
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Doorgeven gegevens');
        $property->setDescription('Wilt u dat we uw verhuizing ook doorgeven aan postNl?');
        $property->setType('boolean');
        $property->setFormat('boolean');
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        /*
    	 *  Trouwen
    	 */
        $meldingTrouwenNL = new RequestType();
        //$meldingTrouwenNL->setId('d009032d-8fdd-4d09-bf43-5000f19737a7');
        $meldingTrouwenNL->setSourceOrganization('0000');
        $meldingTrouwenNL->setName('Melding voorgenomen huwelijk');
        $meldingTrouwenNL->setDescription('Melding voorgenomen huwelijk');

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Partner1');
        $property->setType('string');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Welke partners willen hun partnerschap omzetten?');
        $property->setRequestType($meldingTrouwenNL);
        $manager->persist($property);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Partner2');
        $property->setType('string');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Welke partners willen hun partnerschap omzetten?');
        $property->setRequestType($meldingTrouwenNL);
        $manager->persist($property);

        $omzettingNL = new RequestType();
        //$omzettingNL->setId('dc65cbe9-d608-4946-b3d4-368b5b0c4061');
        $omzettingNL->setSourceOrganization('0000');
        $omzettingNL->setName('Omzetting');
        $omzettingNL->setDescription('Het omzetten van een bestaand partnerschap in een huwelijk.');
        $manager->persist($omzettingNL);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Ingangsdatum');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de datum voor de omzetting naar huwelijk?');
        $property->setRequestType($verhuizenNL);
        $manager->persist($property);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Partner1');
        $property->setType('string');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Welke partners willen hun partnerschap omzetten');
        $property->setRequestType($omzettingNL);
        $manager->persist($property);

        $property = new Property();
        //$verhuizenNL->setId('');
        $property->setTitle('Partner 2');
        $property->setType('string');
        $property->setFormat('bsn');
        $property->setRequired(true);
        $property->setDescription('Welke partners willen hun partnerschap omzetten');
        $property->setRequestType($omzettingNL);
        $manager->persist($property);

        $id = Uuid::fromString('5b10c1d6-7121-4be2-b479-7523f1b625f1');
        $trouwenNL = new RequestType();
        $trouwenNL->setSourceOrganization('000');
        $trouwenNL->setName('Huwelijk / Partnerschap');
        $trouwenNL->setDescription('Huwelijk / Partnerschap');
        $manager->persist($trouwenNL);
        $trouwenNL->setId($id);
        $manager->persist($trouwenNL);
        $manager->flush();
        $trouwenNL = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        $stage1->setTitle('Type');
        $stage1->setIcon('fas fa-ring');
        $stage1->setSlug('ceremonies');
        $stage1->setType('string');
        $stage1->setFormat('strin');
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
        $stage2->setSlug('partners');
        $stage2->setType('array');
        $stage2->setFormat('bsn');
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
        $stage3->setFormat('uri');
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
        $stage5->setSlug('locaties');
        $stage5->setType('string');
        $stage5->setFormat('uri');
        $stage5->setMaxLength('255');
        $stage5->setRequired(true);
        $stage5->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $stage5->setRequestType($trouwenNL);
        $manager->persist($stage5);

        $stage6 = new Property();
        $stage6->addPrevious($stage5);
        $stage6->setTitle('Ambtenaar');
        $stage6->setIcon('fas fa-user-tie');
        $stage6->setSlug('ambtenaren');
        $stage6->setType('string');
        $stage6->setFormat('uri');
        $stage6->setMaxLength('255');
        $stage6->setRequired(true);
        $stage6->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $stage6->setRequestType($trouwenNL);
        $manager->persist($stage6);

        $stage7 = new Property();
        $stage7->addPrevious($stage6);
        $stage7->setTitle('Getuigen');
        $stage7->setIcon('fas fa-users');
        $stage7->setSlug('getuigen');
        $stage7->setType('array');
        $stage7->setFormat('bsn');
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
        $stage8->setSlug('extras');
        $stage8->setType('array');
        $stage8->setFormat('bsn');
        $stage8->setRequired(true);
        $stage8->setDescription('Wie zijn de getuigen van partner?');
        $stage8->setRequestType($trouwenNL);
        $manager->persist($stage8);

        $stage9 = new Property();
        $stage9->addPrevious($stage8);
        $stage9->setTitle('Melding ');
        $stage9->setIcon('fas fa-envelope');
        $stage9->setSlug('melding');
        $stage9->setType('string');
        $stage9->setFormat('uri');
        $stage9->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
        $stage9->setRequestType($trouwenNL);
        $manager->persist($stage9);

        $stage10 = new Property();
        $stage10->addPrevious($stage9);
        $stage10->setTitle('Betalen ');
        $stage10->setIcon('fas fa-cash-register');
        $stage10->setSlug('betalen');
        $stage10->setType('string');
        $stage10->setFormat('uri');
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
        $property->setTitle('Order');
        $property->setType('string');
        $property->setFormat('uri');
        $property->setMaxLength('255');
        $property->setRequired(true);
        $property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
        $property->setRequestType($trouwenNL);
        $manager->persist($property);

        $id = Uuid::fromString('47577f44-0ede-4655-a629-027f051d2b07');
        $trouwenUtrecht = new RequestType();
        $trouwenUtrecht->setExtends($trouwenNL);
        $trouwenUtrecht->setSourceOrganization('002220647');
        $trouwenUtrecht->setName('Trouwen of Partnerschap in Utrecht');
        $trouwenUtrecht->setDescription('Trouwen of Partnerschap in Utrecht');
        $manager->persist($trouwenUtrecht);
        $trouwenUtrecht->setId($id);
        $manager->persist($trouwenUtrecht);

        $manager->flush();
    }
}
