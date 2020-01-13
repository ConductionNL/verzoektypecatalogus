<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;

/**
 * All properties contained in the RequestType type
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *  collectionOperations={
 *  	"get",
 *  	"post"
 *  },
 * 	itemOperations={
 *     "get"={
 *  		"swagger_context" = {
 *                  "parameters" = {
 *                      {
 *                          "name" = "extend",
 *                          "in" = "query",
 *                          "description" = "Add the properties of the requestType that this requestType extends",
 *                          "required" = false,
 *                          "type" : "boolean"
 *                      }
 *                  }
 *          }
 *  	},
 *     "put",
 *     "delete"
 *  }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RequestTypeRepository")
 */
class RequestType
{
	/**
	 * @var UuidInterface $id The UUID identifier of this object
	 * @example e2984465-190a-4562-829e-a8cca81aa35d
	 *
   * @Groups({"read"})
	 * @Assert\Uuid
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	private $id;

    /**
     * @var string $sourceOrganization The RSIN of the organization that owns this process
     * @example 002851234
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 8,
     *      max = 11
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(SearchFilter::class, strategy="exact")
     */
    private $sourceOrganization;

    /**
	 * @var string $name The name of this RequestType
     * @example My RequestType
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
	 * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
	 * @var string $description An short description of this RequestType
     * @example This is the best request ever
     * @Assert\Length(
     *      max = 2550
     * )
	 * @Groups({"read"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Property[]|ArrayCollection The properties for this request type
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Property", mappedBy="requestType", orphanRemoval=true, fetch="EAGER", cascade={"persist"})
     * @Assert\Valid
     */
    private $properties;


    /**
     * @Groups({"read"})
     * @MaxDepth(1)
     */
    private $stages;

    /**
	 * @var object $extends The requestType that this requestType extends
     *
     * @Groups({"write-requesttype"})
     * @ORM\ManyToOne(targetEntity="App\Entity\RequestType", inversedBy="extendedBy", fetch="EAGER")
     */
    private $extends;

    /**
	 * @var object $extendedBy The requestTypes that extend this requestType
	 *
     * @ORM\OneToMany(targetEntity="App\Entity\RequestType", mappedBy="extends")
     */
    private $extendedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $availableFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $availableUntil;


    public function __construct()
    {
    	$this->properties= new ArrayCollection();
     	$this->extendedBy = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): self
    {
    	$this->id = $id;

    	return $this;
    }

    public function getSourceOrganization(): ?string
    {
    	return $this->sourceOrganization;
    }

    public function setSourceOrganization(string $sourceOrganization): self
    {
    	$this->sourceOrganization = $sourceOrganization;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Properties[]
     */
    public function getProperties(): Collection
    {
    	return $this->properties;
    }

    public function addProperty(Property $property): self
    {
    	if (!$this->properties->contains($property)) {
    		$this->properties[] = $property;
    		$property->setRequestType($this);
        }

        return $this;
    }

    /*
     * Used for soft adding properties for the extension functionality
     */
    public function extendProperty(Property $property): self
    {
    	if (!$this->properties->contains($property)) {
    		$this->properties[] = $property;
    	}

    	return $this;
    }

    public function removeProperty(Property $property): self
    {
    	if ($this->properties->contains($property)) {
    		$this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
    		if ($property->getRequestType() === $this) {
    			$property->setRequestType(null);
            }
        }

        return $this;
    }

    public function getExtends(): ?self
    {
        return $this->extends;
    }

    public function setExtends(?self $extends): self
    {
        $this->extends = $extends;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getExtendedBy(): Collection
    {
        return $this->extendedBy;
    }

    public function addExtendedBy(self $extendedBy): self
    {
        if (!$this->extendedBy->contains($extendedBy)) {
            $this->extendedBy[] = $extendedBy;
            $extendedBy->setExtends($this);
        }

        return $this;
    }

    public function removeExtendedBy(self $extendedBy): self
    {
        if ($this->extendedBy->contains($extendedBy)) {
            $this->extendedBy->removeElement($extendedBy);
            // set the owning side to null (unless already changed)
            if ($extendedBy->getExtends() === $this) {
                $extendedBy->setExtends(null);
            }
        }

        return $this;
    }

    public function getAvailableFrom(): ?\DateTimeInterface
    {
        return $this->availableFrom;
    }

    public function setAvailableFrom(\DateTimeInterface $availableFrom): self
    {
        $this->availableFrom = $availableFrom;

        return $this;
    }

    public function getAvailableUntil(): ?\DateTimeInterface
    {
        return $this->availableUntil;
    }

    public function setAvailableUntil(?\DateTimeInterface $availableUntil): self
    {
        $this->availableUntil = $availableUntil;

        return $this;
    }


    public function getStages()
    {
    	$stages = [];
    	$stage = $this->getFirstStage();
    	while ($stage){

    		$array = [
    				"id"=>$stage->getId(),
    				"name"=>$stage->getName(),
    				"description"=>$stage->getDescription(),
    				"icon"=>$stage->getIcon(),
    				"slug"=>$stage->getSlug()
    		];

    		if($stage->getNext()){
    			$array["next"] = $stage->getNext()->getSlug();
    		}

    		if($stage->getPrevious()->first()){
    			$array["previous"] = $stage->getPrevious()->first()->getSlug();
    		}

    		$stages[] = $array;

    		$stage = $stage->getNext();
    	}

    	return $stages;
    }

    public function getFirstStage()
    {
    	$criteria = Criteria::create()
    	->andWhere(Criteria::expr()->eq('start', true));

    	return $this->getProperties()->matching($criteria)->first();
    }
}
