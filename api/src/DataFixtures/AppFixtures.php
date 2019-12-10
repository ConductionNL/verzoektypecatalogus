<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Ramsey\Uuid\Uuid;

use App\Entity\RequestType;
use App\Entity\Property;

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
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Datum');
    	$property->setType('string');
    	$property->setFormat('date');
    	$property->setDescription('Wat is de verhuisdatum?');
    	$property->setRequestType($verhuizenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Adress');
    	$property->setType('string');
    	$property->setFormat('bag');
    	$property->setRequired(true);
    	$property->setDescription('Wat is het nieuwe adres?');
    	$property->setRequestType($verhuizenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Wie');
    	$property->setType('arrays');
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
    	$meldingTrouwenNL= new RequestType();
    	//$meldingTrouwenNL->setId('d009032d-8fdd-4d09-bf43-5000f19737a7');
    	$meldingTrouwenNL->setSourceOrganization('0000');
    	$meldingTrouwenNL->setName('Melding voorgenomen huwelijk');
    	$meldingTrouwenNL->setDescription('Melding voorgenomen huwelijk');
    	
    	$property= new Property();
    	//$verhuizenNL->setId('');
    	$property->setTitle('Partner1');
    	$property->setType('string');
    	$property->setFormat('bsn');
    	$property->setRequired(true);
    	$property->setDescription('Welke partners willen hun partnerschap omzetten?');
    	$property->setRequestType($meldingTrouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
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
    	
    	$property= new Property();
    	//$verhuizenNL->setId('');
    	$property->setTitle('Ingangsdatum');
    	$property->setType('string');
    	$property->setFormat('date');
    	$property->setDescription('Wat is de datum voor de omzetting naar huwelijk?');
    	$property->setRequestType($verhuizenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$verhuizenNL->setId('');
    	$property->setTitle('Partner1');
    	$property->setType('string');
    	$property->setFormat('bsn');
    	$property->setRequired(true);
    	$property->setDescription('Welke partners willen hun partnerschap omzetten');
    	$property->setRequestType($omzettingNL);
    	$manager->persist($property);
    	    	
    	$property= new Property();
    	//$verhuizenNL->setId('');
    	$property->setTitle('Partner 2');
    	$property->setType('string');
    	$property->setFormat('bsn');
    	$property->setRequired(true);
    	$property->setDescription('Welke partners willen hun partnerschap omzetten');
    	$property->setRequestType($omzettingNL);
    	$manager->persist($property);    	
    	
    	$trouwenNL = new RequestType();
    	//$trouwenNL->setId('2a0efa35-e911-44d9-8cf1-54bea575be81');
    	$trouwenNL->setSourceOrganization('000');
    	$trouwenNL->setName('Huwelijk / Partnerschap');
    	$trouwenNL->setDescription('Huwelijk / Partnerschap');
    	$manager->persist($trouwenNL);
    	
    	$property= new Property();
    	//$verhuizenNL->setId('');
    	$property->setTitle('Melding ');
    	$property->setType('string');
    	$property->setFormat('uri');
    	$property->setDescription('Onder welke uri kunnen we de bestaande \'melding voorgenomen huwelijk\' terugvinden?');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Datum');
    	$property->setType('string');
    	$property->setFormat('date');
    	$property->setDescription('Selecteer een datum voor de omzetting naar huwelijk');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Type');
    	$property->setType('string');
    	$property->setFormat('strin');
    	$property->setMaxLength('12');
    	$property->setMinLength('7');
    	$property->setEnum(['trouwen','partnerschap']);
    	$property->setRequired(true);
    	$property->setDescription('Selecteer een huwelijk of partnerschap?');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Partner 1');
    	$property->setType('string');
    	$property->setFormat('bsn');
    	$property->setMaxLength('9');
    	$property->setMinLength('9');
    	$property->setRequired(true);
    	$property->setDescription('Wie is de eerste partner?');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Partner 2');
    	$property->setType('string');
    	$property->setFormat('bsn');
    	$property->setMaxLength('12');
    	$property->setMinLength('7');
    	$property->setRequired(true);
    	$property->setDescription('Wie is de tweede partner?');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);    	
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Getuigen van partner 1');
    	$property->setType('arrays');
    	$property->setFormat('bsn');
    	$property->setMaxLength('9');
    	$property->setMinLength('9');
    	$property->setRequired(true);
    	$property->setDescription('Wie zijn de getuigen van partner 1?');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Getuigen2');
    	$property->setType('arrays');
    	$property->setFormat('bsn');
    	$property->setMinProperties(1);
    	$property->setMaxProperties(2);
    	$property->setRequired(true);
    	$property->setDescription('Wie zijn de getuigen van partner 2?');
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
    	
    	$property= new Property();
    	//$property->setId('');
    	$property->setTitle('Order');
    	$property->setType('string');
    	$property->setFormat('uri');
    	$property->setMaxLength('255');
    	$property->setRequired(true);
    	$property->setDescription('We gebruiken de order om de bestelling (bestaande uit locatie, ambtenaar en eventuele extra\'s) op te slaan');
    	$property->setRequestType($trouwenNL);
    	$manager->persist($property);
    	
        $manager->flush();
    }
}
