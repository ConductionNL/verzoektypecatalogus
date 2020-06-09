<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Conduction\CommonGroundBundle\Service\CommonGroundService;

class AppFixtures extends Fixture
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
        // Lets make sure we only run these fixtures on larping enviroment
        if (strpos($this->params->get('app_domain'), 'conduction.nl') == false) {
            return false;
        }

        $manager->flush();

        /*
    	 *  Voorbeeld vrerzoek
    	 */
        $id = Uuid::fromString('f21685a4-947f-48b3-9922-26dcb4ae2786');
        $request = new RequestType();
        $request->setIcon('fal fa-truck-moving');
        $request->setOrganization('0000');
        $request->setName('Vooreeld verzoek');
        $request->setDescription('Dit is een voorbeeld verzoek');
        $manager->persist($request);
        $request->setId($id);
        $manager->persist($request);
        $request->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('1cf0c80b-df0c-4677-a98a-aefaf3ef101e');
        $property = new Property();
        $property->setTitle('Datum');
        $property->setIcon('fal fa-calendar-day');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de verhuisdatum?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);

        $id = Uuid::fromString('cfb73004-115d-4c98-9824-0f338080e066');
        $property = new Property();
        $property->setTitle('Adres');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('bag');
        $property->setRequired(true);
        $property->setDescription('Wat is het nieuwe adres?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=>$id]);
    }
}
