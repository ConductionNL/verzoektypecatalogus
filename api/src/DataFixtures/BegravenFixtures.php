<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BegravenFixtures extends Fixture
{
	private $params;

	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if ($this->params->get('app_domain') != "begraven.zaakonline.nl" && strpos($this->params->get('app_domain'), "begraven.zaakonline.nl") == false) {
            return false;
        }

        $id = Uuid::fromString('c2e9824e-2566-460f-ab4c-905f20cddb6c');
        $requestType = new RequestType();
        $requestType->setOrganization('https://wrc.begraven.zaakonline.nl/organizations/d736013f-ad6d-4885-b816-ce72ac3e1384');
        $requestType->setIcon("fa fa-headstone");
        $requestType->setName("Begravenisplanner");
        $requestType->setDescription("Met dit verzoek kunt u een begrafenis plannen");
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(array('id'=> $id));

        $id = Uuid::fromString('72fdd281-c60d-4e2d-8b7d-d266303bdc46');
        $property1 = new Property();
        $property1->setTitle("Gemeente");
        $property1->setIcon("fa fa-headstone");
        $property1->setType("string");
        $property1->setFormat("string");
        $property1->setIri("wrc/organizations");
        $property1->setRequired(true);
        $property1->setRequestType($requestType);
        $manager->persist($property1);
        $property1->setId($id);
        $manager->persist($property1);
        $manager->flush();
        $property1 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('bdae2f7b-21c3-4d88-be6d-a35b31c13916');
        $property2 = new Property();
        $property2->setTitle("Begraafplaats");
        $property2->setType("string");
        $property2->setFormat("string");
        $property2->setIri("grc/cemetery");
        $property2->setRequired(true);
        $property2->setRequestType($requestType);

        $manager->persist($property2);
        $property2->setId($id);
        $manager->persist($property2);
        $manager->flush();
        $property2 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3b6a637d-19c6-4730-b322-c03d0d8301b6');
        $property3 = new Property();
        $property3->setTitle("Soort graf");
        $property3->setType("string");
        $property3->setFormat("string");
        $property3->setIri("grc/grave_type");
        $property3->setRequired(true);
        $property3->setRequestType($requestType);

        $manager->persist($property3);
        $property3->setId($id);
        $manager->persist($property3);
        $manager->flush();
        $property3 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('b1fd7b38-384b-47ec-a0f2-6f81949cdece');
        $property4 = new Property();
        $property4->setTitle("Event");
        $property4->setType("string");
        $property4->setFormat("string");
        $property4->setIri("arc/event");
        $property4->setRequired(true);
        $property4->setRequestType($requestType);

        $manager->persist($property4);
        $property4->setId($id);
        $manager->persist($property4);
        $manager->flush();
        $property4 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('8f9adb13-d5e0-40de-a08c-a2ce5a648b1e');
        $property5 = new Property();
        $property5->setTitle("Artikelen");
        $property5->setType("string");
        $property5->setFormat("string");
        $property5->setRequired(true);
        $property5->setRequestType($requestType);

        $manager->persist($property5);
        $property5->setId($id);
        $manager->persist($property5);
        $manager->flush();
        $property5 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('2631df9f-abca-4f26-bcad-a56d8ec5c856');
        $property6 = new Property();
        $property6->setTitle("Gemeente");
        $property6->setType("string");
        $property6->setFormat("string");
        $property6->setIri("wrc/organizations");
        $property6->setRequired(false);
        $property6->setRequestType($requestType);

        $manager->persist($property6);
        $property6->setId($id);
        $manager->persist($property6);
        $manager->flush();
        $property6 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('24d3e05d-26c2-4adb-acd4-08bde88b4526');
        $property7 = new Property();
        $property7->setTitle("Belanghebbende");
        $property7->setType("string");
        $property7->setFormat("string");
        $property7->setIri("irc/assent");
        $property7->setRequired(true);
        $property7->setRequestType($requestType);

        $manager->persist($property7);
        $property7->setId($id);
        $manager->persist($property7);
        $manager->flush();
        $property7 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('db69ce35-4ae1-4aac-936f-bdb5d4d1ff18');
        $property8 = new Property();
        $property8->setTitle("Overledene");
        $property8->setType("string");
        $property8->setFormat("string");
        $property8->setIri("brp/ingeschrevenpersoon");
        $property8->setRequired(true);
        $property8->setRequestType($requestType);

        $manager->persist($property8);
        $property8->setId($id);
        $manager->persist($property8);
        $manager->flush();
        $property8 = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);
    }
}
