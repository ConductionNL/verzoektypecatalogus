<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SHertogenboschFixtures extends Fixture
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
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'shertogenbosch.commonground.nu' && strpos($this->params->get('app_domain'), 'shertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != 's-hertogenbosch.commonground.nu' && $this->params->get('app_domain') != 'verhuizen.accp.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.accp.s-hertogenbosch.nl') == false && $this->params->get('app_domain') != 'verhuizen=.s-hertogenbosch.nl' &&
            strpos($this->params->get('app_domain'), 'verhuizen.s-hertogenbosch.nl') == false && strpos($this->params->get('app_domain'), 's-hertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        /*
    	 *  Verhuizen
    	 */
        $id = Uuid::fromString('37812338-fa7c-46c5-a914-bcf17339a4c5');
        $requestType = new RequestType();
        $requestType->setIcon('fas fa-truck-moving');
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
        $property->setIcon('fas fa-calendar-day');
        $property->setType('string');
        $property->setFormat('date');
        $property->setDescription('Wat is de verhuisdatum?');
        $property->setUtter('Wat is de verhuisdatum?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('4b77bd59-d198-4aaf-ae0c-f66b16a6893d');
        $property = new Property();
        $property->setTitle('Adres');
        $property->setIcon('fas fa-map-marked');
        $property->setType('string');
        $property->setFormat('url');
        $property->setIri('bag/address');
        $property->setRequired(true);
        $property->setDescription('Wat is het nieuwe adres?');
        $property->setUtter('Ik heb een vraag over uw nieuwe adres');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('58728f7c-cde3-4faa-8c7d-15c3b2cddcb5');
        $property = new Property();
        $property->setTitle('Wie');
        $property->setIcon('fas fa-map-marked');
        $property->setType('array');
        $property->setFormat('bag');
        $property->setRequired(true);
        $property->setDescription('Wie gaan er verhuizen');
        $property->setUtter('Welke personen gaan er verhuizen?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('39402814-8960-47a4-b107-863f20d629ae');
        $property = new Property();
        $property->setTitle('Wiebsn');
        $property->setIcon('fas fa-map-marked');
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
        $property->setName('shertogenboschEmail');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('email');
        $property->setDescription('Op welk e-mail adres kunnen we u bereiken?');
        $property->setUtter('Op welk e-mailadres kunnen we je bereiken als we vragen hebben over deze verhuizing?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('09cac491-a428-47eb-99ac-9717b1690620');
        $property = new Property();
        $property->setTitle('Telefoon');
        $property->setIcon('fas fa-phone');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setDescription('Op welk telefoonnummer kunnen we u bereiken?');
        $property->setUtter('Op welk telefoonnummer kunnen we je bereiken als we vragen hebben over deze verhuizing');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f1964c98-df49-431a-a5e1-64c17d7d956b');
        $property = new Property();
        $property->setTitle('notificatie');
        $property->setIcon('fas fa-bell');
        $property->setType('boolean');
        $property->setFormat('radio');
        $property->setDescription('Mogen wij andere op de hoogte stellen van uw verhuizing?');
        $property->setUtter('Mogen wij deze verhuizing aan anderen doorgeven? Bijvoorbeeld aan postdiensten, sportverenigingen of kerkgenootschappen?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a5f3c372-37b3-495d-b0b2-d1cd24990e46');
        $property = new Property();
        $property->setTitle('Mee verhuizers');
        $property->setIcon('fas fa-map-marked');
        $property->setType('string');
        $property->setFormat('meeverhuizen');
        $property->setDescription('Zijn er mensen die mee verhuizen');
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
        $task->setDescription('Deze task roept een webhook aan als er een verzoek van het type verhuizen wordt gecrieërd');
        $task->setEndpoint($this->commonGroundService->cleanUrl(['component'=>'vs', 'type'=>'webhook']));
        $task->setType('GET');
        $task->setCode('set_bsn');
        $task->setEvent('create');
        $task->setTimeInterval('P0D');
        $manager->persist($task);

        $manager->flush();

        $id = Uuid::fromString('9d76fb58-0711-4437-acc4-9f4d9d403cdf');
        $verhuizenDenBosh = new RequestType();
        $verhuizenDenBosh->setName('Verhuizen');
        $verhuizenDenBosh->setIcon('fal fa-truck-moving');
        $verhuizenDenBosh->setDescription('Het doorgeven van een verhuizing aan de gemeente \'s-Hertogenbosch');
        $verhuizenDenBosh->setOrganization('001709124');
        $verhuizenDenBosh->setExtends($requestType);
        $manager->persist($verhuizenDenBosh);
        $verhuizenDenBosh->setId($id);
        $manager->persist($verhuizenDenBosh);
        $manager->flush();
        $verhuizenDenBosh = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $stage1 = new Property();
        $stage1->setStart(true);
        //$verhuizenNL->setId('');
        $stage1->setTitle('Email');
        $stage1->setName('verhuizenEmail');
        $stage1->setIcon('fas fa-envelope');
        $stage1->setSlug('email');
        $stage1->setDescription('Het e-mail addres dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage1->setType('string');
        $stage1->setFormat('email');
        $stage1->setRequired(true);
        $stage1->setRequestType($verhuizenDenBosh);
        $manager->persist($stage1);

        $stage2 = new Property();
        $stage2->addPrevious($stage1);
        //$verhuizenNL->setId('');
        $stage2->setTitle('Telefoon');
        $stage2->setName('verhuizenTelefoon');
        $stage2->setIcon('fas fa-phone');
        $stage2->setSlug('telefoon');
        $stage2->setDescription('Het telefoonnummer dat wordt gebruikt om contact op te nemen (indien nodig) over deze verhuizing');
        $stage2->setType('string');
        $stage2->setFormat('string');
        $stage2->setRequired(true);
        $stage2->setRequestType($verhuizenDenBosh);
        $manager->persist($stage2);

        $id = Uuid::fromString('ba8506d8-458e-4d6d-b88a-8107f960d9b5');
        $property = new Property();
        $property->setTitle('voornaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDescription('Wat is uw voornaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('009d51f1-c5bd-402c-8be4-bf79a00ea22f');
        $property = new Property();
        $property->setTitle('achternaam');
        $property->setIcon('fas fa-user');
        $property->setType('string');
        $property->setRequired(true);
        $property->setFormat('text');
        $property->setDescription('Wat is uw achternaam?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('42f011f7-a77d-48db-b415-d4bc0f0bf6dc');
        $property = new Property();
        $property->setTitle('organisatie');
        $property->setIcon('fas fa-building');
        $property->setType('string');
        $property->setFormat('text');
        $property->setRequired(true);
        $property->setDescription('Wat is de naam van uw organisatie?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('20d3b9cc-131a-4397-803f-2c43b6deb6ca');
        $property = new Property();
        $property->setTitle('email');
        $property->setName('infoEmail');
        $property->setIcon('fas fa-envelope');
        $property->setType('string');
        $property->setFormat('email');
        $property->setRequired(true);
        $property->setDescription('Wat is uw e-mail adres?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('922f34e2-39db-4e0b-a98c-252ed7243945');
        $property = new Property();
        $property->setTitle('telefoonnummer');
        $property->setIcon('fas fa-phone');
        $property->setType('string');
        $property->setFormat('tel');
        $property->setRequired(true);
        $property->setDescription('Wat is uw telefoonnummer?');
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();

        $id = Uuid::fromString('2cc19bb6-808e-4cd2-80a9-d9404f134280');
        $property = new Property();
        $property->setTitle('Ik geef toestemming voor het gebruiken van deze gegevens om contact met mij op te nemen');
        $property->setIcon('fas fa-check');
        $property->setType('string');
        $property->setFormat('checkbox');
        $property->setRequired(true);
        $property->setDescription("We zouden graag met je contact opnemen om je te vragen wat je van deze manier van demo'en, Zuid-Drecht en het zaaksysteem vindt. ");
        $property->setEnum(['Ik geef toestemming voor het gebruiken van deze gegevens om contact met mij op te nemen']);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
    }
}
