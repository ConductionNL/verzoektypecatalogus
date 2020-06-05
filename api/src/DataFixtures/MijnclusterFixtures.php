<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\Property;
use App\Entity\RequestType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MijnclusterFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if ($this->params->get('app_domain') != "mijncluster.nl" && strpos($this->params->get('app_domain'), "mijncluster.nl") == false) {
            //return false;
        }


        /*
    	 *  Verhuizen
    	 */
        $id = Uuid::fromString('23d4803a-67cd-4720-82d0-e1e0a776d8c4');
        $request = new RequestType();
        $request->setIcon('fal fa-truck-moving');
        $request->setOrganization('0000');
        $request->setName('Verhuizen');
        $request->setDescription('Het doorgeven van een verhuizing aan een gemeente');
        $manager->persist($request);
        $request->setId($id);
        $manager->persist($request);
        $request->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(array('id' => $id));

        $id = Uuid::fromString('fbc9c518-8971-4257-bf81-68cbd9af84d3');
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
        $property = $manager->getRepository('App:Property')->findOneBy(array('id' => $id));

        $id = Uuid::fromString('c6623907-a2cc-490e-a4cf-4bc3eaaadeba');
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
        $property = $manager->getRepository('App:Property')->findOneBy(array('id' => $id));

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Aanroepen webhook');
        $task->setDescription('Deze task roept een webhook aan als er een verzoek vanhet type verhuizen wordt gecrieërd');
        $task->setEndpoint('https://webhook.mijncluster.nl');
        $task->setType('GET');
        $task->setEvent('create');
        $task->setTimeInterval('P0D');

        $manager->persist($task);
    }
}
