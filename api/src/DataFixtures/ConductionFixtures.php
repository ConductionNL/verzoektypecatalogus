<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ConductionFixtures extends Fixture
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
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'conduction.nl' && strpos($this->params->get('app_domain'), 'conduction.nl') == false
        ) {
            return false;
        }

        /*
         *  Student (Stage)
         */

        $id = Uuid::fromString('8c687f26-e272-4b4f-9a92-337d9bfd7d10');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'6a001c4c-911b-4b29-877d-122e362f519d']));
        $requestType->setIcon('fa fa-graduation-cap');
        $requestType->setName('student');
        $requestType->setDescription('Met dit verzoek kunt u een student aanmelden');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('c76c0211-6035-42ef-b606-6a5d116fbacf');
        $property = new Property();
        $property->setTitle('Student');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setDescription('Vul hier uw contactgegevens in');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('021d5c0b-7518-4cb7-bd2c-b5fb89de1767');
        $property = new Property();
        $property->setTitle('User');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('uc/users');
        $property->setDescription('Vul hier uw contactgegevens in.');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        //Zou dit een organization moeten zijn? gekozen uit een lijst met verschillende onderwijsinstellingen/organizations.
        $id = Uuid::fromString('292c0840-2d4a-4713-82ee-d02437af0e4e');
        $property = new Property();
        $property->setTitle('Onderwijsinstelling');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Op welke onderwijsinstelling zit u?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('1fa6dd24-830a-4fe7-983d-3b211e349794');
        $property = new Property();
        $property->setTitle('Opleiding');
        $property->setIcon('fa fa-graduation-cap');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Welke opleiding volgt u?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('81b94325-5b52-431e-a525-c0e70206f4b4');
        $property = new Property();
        $property->setTitle('LinkedIn profiel');
        $property->setIcon('fa fa-linkedin-square');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Vul hier uw LinkedIn profiel in.');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('68a00f77-99fb-4841-b28a-c671a88e0685');
        $property = new Property();
        $property->setTitle('Github profiel');
        $property->setIcon('fa fa-github');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Heeft u een Github profiel?');
        $property->setRequired(false);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        /*
         *  Organisatie (Stage)
         */

        $id = Uuid::fromString('b45d71d2-9792-4e0e-ac87-0b7cef422e61');
        $requestType = new RequestType();
        $requestType->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'6a001c4c-911b-4b29-877d-122e362f519d']));
        $requestType->setIcon('fa fa-briefcase');
        $requestType->setName('student');
        $requestType->setDescription('Met dit verzoek kunt u een organisatie aanmelden');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('1d202d17-020f-4886-a81c-71a21a47c656');
        $property = new Property();
        $property->setTitle('Naam');
        $property->setIcon('fa fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw naam?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('81bc8823-dfbe-4f02-9c7c-c9ecc6057a13');
        $property = new Property();
        $property->setTitle('Email');
        $property->setIcon('fa fa-envelope');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk E-Mail adres kunnen we u bereiken?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3105f72f-c658-4cd2-bd48-57e480a56201');
        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fa fa-phone-square');
        $property->setType('string');
        $property->setFormat('phone');
        $property->setDescription('Op welk telefoonnummer kunnen wij u bereiken?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('ea654a41-ee59-402c-b353-46a595e77ecc');
        $property = new Property();
        $property->setTitle('Functie');
        $property->setIcon('fa fa-briefcase');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Wat is uw functie?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('682a79cb-56d3-46ee-a4d8-f6f697e98689');
        $property = new Property();
        $property->setTitle('Afdeling');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('Op welke afdeling werkt u?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9df44ef0-9493-4353-8321-9b6fb1ab37d9');
        $property = new Property();
        $property->setTitle('Gemeente');
        $property->setIcon('fa fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setDescription('In welke gemeente werkt u?');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9df44ef0-9493-4353-8321-9b6fb1ab37d9');
        $property = new Property();
        $property->setTitle('Doel');
        $property->setIcon('fa fa-dot-circle-o');
        $property->setType('string');
        $property->setFormat('textarea');
        $property->setDescription('Met welk doel meld u uw organisatie aan?');
        $property->setRequired(false);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);
    }
}
