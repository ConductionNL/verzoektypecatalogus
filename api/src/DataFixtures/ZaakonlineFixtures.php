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
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zaakonline.nl' && strpos($this->params->get('app_domain'), 'zaakonline.nl') == false) {
            return false;
        }

        /*
    	 *  Corona crisis
    	 */

        // Verztype Babs andere gemeente
        $id = Uuid::fromString('90ad9841-bb57-44ee-beaa-b3e0a144626e');
        $request = new RequestType();
        $request->setOrganization('https://wrc.zaakonline.nl/organizations/68b64145-0740-46df-a65a-9d3259c2fec8'); // dit moet de wrc verwijzing van utrecht zijn
        $request->setIcon('fas fa-user-tie');
        $request->setName('Ondersteunings aanvraag ZZP');
        $request->setDescription('Met dit verzoek kunt u als ZZPer financiele hulp aanvragen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('e-Mailadres');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk e-mailadres kunnen wij u bereiken?');
        $property->setRequestType($request);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('phone');
        $property->setDescription('Op welk telefoonnummer kunnen wij u bereiken?');
        $property->setRequestType($request);
        $manager->persist($property);

        $property = new Property();
        $property->setStart(true);
        $property->setSlug('noodvoorziening-corona');
        $property->setTitle('Bedrijf');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('kvk');
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

        // Verztype Babs andere gemeente
        $id = Uuid::fromString('d78197df-af77-4b5e-bed0-054cba047550');
        $request = new RequestType();
        $request->setOrganization('https://wrc.zaakonline.nl/organizations/68b64145-0740-46df-a65a-9d3259c2fec8'); // dit moet de wrc verwijzing van utrecht zijn
        $request->setIcon('fas fa-user-tie');
        $request->setName('Aanvraag bijzonder bijstand');
        $request->setDescription('Met dit verzoek kunt bijzondere bijstand aanvragen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('e-Mailadres');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk e-mailadres kunnen wij u berijken?');
        $property->setRequestType($request);
        $manager->persist($property);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('phone');
        $property->setDescription('Op welk telefoonnummer kunnen wij u berijken?');
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

        // Verztype Babs andere gemeente
        $id = Uuid::fromString('64127a29-c452-4600-a9a0-b3f827b4d2e5');
        $request = new RequestType();
        $request->setOrganization('https://wrc.zaakonline.nl/organizations/68b64145-0740-46df-a65a-9d3259c2fec8'); // dit moet de wrc verwijzing van utrecht zijn
        $request->setIcon('fas fa-user-tie');
        $request->setName('Ik wil helpen');
        $request->setDescription('Met dit verzoek kunt u aangeven dat u wilt bijdragen');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('e-Mailadres');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk e-mailadres kunnen wij u berijken?');
        $property->setRequestType($request);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('phone');
        $property->setDescription('Op welk telefoonnummer kunnen wij u berijken?');
        $property->setRequestType($request);
        $manager->persist($property);

        // Verztype Babs andere gemeente
        $id = Uuid::fromString('2201ebbd-f2b0-4ece-88e0-18ba0d2949e0');
        $request = new RequestType();
        $request->setOrganization('https://wrc.zaakonline.nl/organizations/68b64145-0740-46df-a65a-9d3259c2fec8'); // dit moet de wrc verwijzing van utrecht zijn
        $request->setIcon('fas fa-user-tie');
        $request->setName('Ik heb hulp nodig');
        $request->setDescription('Met dit verzoek kunt u aangeven dat u hulp nodig heeft');
        $manager->persist($request);

        // Dit is hacky tacky karig
        $request->setId($id);
        $manager->persist($request);
        $manager->flush();
        $request = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);
        // einde hacky tacky

        $property = new Property();
        $property->setTitle('e-Mailadres');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk e-mailadres kunnen wij u berijken?');
        $property->setRequestType($request);
        $manager->persist($property);

        $property = new Property();
        $property->setTitle('Telefoonnummer');
        $property->setIcon('fal fa-user');
        $property->setType('string');
        $property->setFormat('phone');
        $property->setDescription('Op welk telefoonnummer kunnen wij u berijken?');
        $property->setRequestType($request);
        $manager->persist($property);

        $manager->flush();
    }
}
