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
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'shertogenbosch.commonground.nu' && strpos($this->params->get('app_domain'), 'shertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != 's-hertogenbosch.commonground.nu' && $this->params->get('app_domain') != 'verhuizen.accp.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.accp.s-hertogenbosch.nl') == false && $this->params->get('app_domain') != 'verhuizen=.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.s-hertogenbosch.nl') == false && strpos($this->params->get('app_domain'), 's-hertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != "zuid-drecht.nl" && strpos($this->params->get('app_domain'), "zuid-drecht.nl") == false
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

        $id = Uuid::fromString('58728f7c-cde3-4faa-8c7d-15c3b2cddcb5');
        $property = new Property();
        $property->setTitle('Wie');
        $property->setIcon('fal fa-map-marked');
        $property->setType('array');
        $property->setFormat('bag');
        $property->setRequired(true);
        $property->setDescription('Wie gaan er verhuizen');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('39402814-8960-47a4-b107-863f20d629ae');
        $property = new Property();
        $property->setTitle('Wiebsn');
        $property->setIcon('fal fa-map-marked');
        $property->setType('array');
        $property->setFormat('bsn');
        $property->setDescription('BSN nummers van alle verhuisenden');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('32061b32-1f8d-4bd7-b203-52b22585f3c9');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk E-Mail adders kunnen we u berijken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('09cac491-a428-47eb-99ac-9717b1690620');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setIcon('fal fa-map-marked');
        $property->setType('string');
        $property->setFormat('phonenumber');
        $property->setDescription('Op welk telefoon nummer kunnen we u berijken?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f1964c98-df49-431a-a5e1-64c17d7d956b');
        $property = new Property();
        $property->setTitle('notificatie');
        $property->setIcon('fal fa-map-marked');
        $property->setType('boolean');
        $property->setFormat('bsn');
        $property->setDescription('Mogen wij andere op de hoogte stellen van uw verhuizing');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Updaten burger service nummers');
        $task->setDescription('Deze task roept een webhook aan als er een verzoek vanhet type verhuizen wordt gecrieërd');
        $task->setEndpoint($this->commonGroundService->cleanUrl(["component"=>"vs","type"=>"webhook"]));
        $task->setType('GET');
        $task->setCode('set_bsn');
        $task->setEvent('create');
        $task->setTimeInterval('P0D');
        $manager->persist($task);

        $manager->flush();
    }
}
