<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CommongroundNuFixtures
{
    private CommonGroundService $commonGroundService;
    private ParameterBagInterface $params;

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
            $this->params->get('app_domain') != 'commonground.nu' && strpos($this->params->get('app_domain'), 'commonground.nu') == false
        ) {
            return false;
        }

        $id = Uuid::fromString('3d69a87a-d9c7-403d-9ee3-be5fe5f50671');
        $requestType = new RequestType();
        $requestType->setOrganization();
        $requestType->setIcon('');
        $requestType->setName('cluster aanvragen');
        $requestType->setDescription('Met dit verzoek kunt u een commonground cluster aanvragen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9121aa72-3803-4755-87d3-156a73123bbc');
        $property = new Property();
        $property->setTitle('Wat zijn de gegevens van u en uw gemeente?');
        $property->setName('organization');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/organizations');
        $property->setConfiguration(['person'=>true, 'address'=>true]);
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $id = Uuid::fromString('fe5d83c9-d3bc-47b1-a926-c00ef1d564fa');
        $property = new Property();
        $property->setTitle('Contactpersoon');
        $property->setIcon('');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('cc/people');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3ffe864c-e755-4464-b8cc-4f4b7a08fb9d');
        $property = new Property();
        $property->setTitle('Factuur persoon');
        $property->setDescription('Naar wie moet de factuur worden gestuurd voor deze begravenis');
        $property->setType('string');
        $property->setFormat('url');
        $property->setConfiguration(['email'=>true, 'telephone'=>true, 'givenName'=>true, 'familyName'=>true, 'address'=>true]);
        $property->setIri('cc/people');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('f9f5ee7f-ccf9-45e9-af1d-f9fa708575f5');
        $property = new Property();
        $property->setTitle('betaalgegevens');
        $property->setName('betaalgegevens');
        $property->setRequired(true);
        $property->setType('array');
        $property->setFormat('iban');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('234d4603-32db-4fd8-8513-813e103ad49c');
        $property = new Property();
        $property->setTitle('Clusternaam');
        $property->setRequired(true);
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequestType($requestType);
        $manager->persist($id);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
