<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SHertogenboschFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'shertogenbosch.commonground.nu' &&
            strpos($this->params->get('app_domain'), 'shertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != 'verhuizen.accp.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.accp.s-hertogenbosch.nl') == false &&
            $this->params->get('app_domain') != 'verhuizen=.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.s-hertogenbosch.nl') == false &&
            $this->params->get('app_domain') != 's-hertogenbosch.commonground.nu' &&
            strpos($this->params->get('app_domain'), 's-hertogenbosch.commonground.nu') == false
        ) {
            return false;
        }

        /*
    	 *  Verhuizen
    	 */
        $id = Uuid::fromString('37812338-fa7c-46c5-a914-bcf17339a4c5');
        $requestType = new RequestType();
        $requestType->setIcon('fal fa-truck-moving');
        $requestType->setOrganization('0000');
        $requestType->setName('Verhuizen');
        $requestType->setDescription('Het doorgeven van een verhuizing aan een gemeente');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('77aa09c9-c3d5-4764-9670-9ea08362341b');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('4b77bd59-d198-4aaf-ae0c-f66b16a6893d');
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
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Aanroepen webhook');
        $task->setDescription('Deze task roept een webhook aan als er een verzoek vanhet type verhuizen wordt gecrieërd');
        $task->setEndpoint('https://webhook.mijncluster.nl');
        $task->setType('GET');
        $task->setCode('webhook_call_pink');
        $task->setEvent('create');
        $task->setTimeInterval('P0D');
        $manager->persist($task);

        $manager->flush();
    }
}
