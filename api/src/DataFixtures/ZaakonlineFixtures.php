<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZaakonlineFixtures extends Fixture
{
	private $params;
	
	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}
	
    public function load(ObjectManager $manager)
    {
    	// Lets make sure we only run these fixtures on huwelijksplanner enviroments
    	if (!in_array("zaakonline.nl", $this->params->get('app_domains'))) {
    		return false;
    	}
    	
        /*
    	 *  Trouwen
    	 */
        
        // Verztype Babs andere gemeente
        $id = Uuid::fromString('90ad9841-bb57-44ee-beaa-b3e0a144626e');
        $request = new RequestType();
        $request->setSourceOrganization('https://wrc.zaakonline.nl/organizations/68b64145-0740-46df-a65a-9d3259c2fec8'); // dit moet de wrc verwijzing van utrecht zijn
        $request->setIcon('fas fa-user-tie');
        $request->setName('Aanvraag babs andere gemeente');
        $request->setDescription('Met dit verzoek kunt u een ambtenaar voor aan andere gemeente aanvragen');
        $manager->persist($request);   
        
        // Dit is hacky tacky karig
        $request->setId($id);        
        $manager->persist($request);        
        $manager->flush();        
        $request = $manager->getRepository('App:RequestType')->findOneBy(array('id'=> $id));
        // einde hacky tacky
        
        $property = new Property();
        $property->setStart(true);
        $property->setSlug('noodvoorziening-corona');
        $property->setTitle('Bedrijf');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('string');
        $property->setDescription('Wat is het KVK nummer van der ondernemening waarvoor u aanvraagt?');
        $property->setRequestType($request);
        $manager->persist($property);
        
        $property = new Property();
        $property->setTitle('BTW Uitstel');
        $property->setIcon('fal fa-user');
        $property->setType('boolean');
        $property->setDescription('Wilt u BTW uitstel aanvragen?');
        $property->setRequestType($request);
        $manager->persist($property);
        
        $property = new Property();
        $property->setTitle('Noodvoorziening');
        $property->setIcon('fal fa-user');
        $property->setType('boolean');
        $property->setDescription('Wilt u een noodvoorziening van 4000 aanvragen?');
        $property->setRequestType($request);
        $manager->persist($property);
        
        $property = new Property();
        $property->setTitle('Medewerkers');
        $property->setIcon('fal fa-user');
        $property->setType('boolean');
        $property->setDescription('Heeft u medewerkers in dienst?');
        $property->setRequestType($request);
        $manager->persist($property);
        
        $property = new Property();
        $property->setTitle('Toelichting');
        $property->setIcon('fal fa-user');
        $property->setType('text');
        $property->setFormat('string');
        $property->setDescription('Kunt u een toelichting op uw aanvraag geven?');
        $property->setRequestType($request);
        $manager->persist($property);

		$manager->flush();
    }
}
