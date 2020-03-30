<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * All properties contained in the RequestType type.
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
 *     "delete",
 *          "get_change_logs"={
 *              "path"="/request_types/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/request_types/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *  }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RequestTypeRepository")
 * @Gedmo\Loggable(logEntryClass="App\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class)
 * @ApiFilter(ExistsFilter::class, properties={"parent","children"})
 */
class RequestType
{
    /**
     * @var UuidInterface The UUID identifier of this object
     *
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
     * @var string The RSIN of the organization that owns this process
     *
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
     * @var string The icon of this property
     *
     * @example My Property
     *
     * @Assert\Length(min = 15, max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @var string The name of this RequestType
     *
     * @example My RequestType
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string An short description of this RequestType
     *
     * @example This is the best request ever
     * @Assert\Length(
     *      max = 2550
     * )
	 * @Groups({"read", "write"})
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
     * @var object The requestType that this requestType extends
     *
     * @Groups({"write-requesttype"})
     * @ORM\ManyToOne(targetEntity="App\Entity\RequestType", inversedBy="extendedBy", fetch="EAGER")
     */
    private $extends;

    /**
     * @var object The requestTypes that extend this requestType
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

    /**
     * @var bool Whether or not this request is unique to a submitter
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true, name="one_of_a_kind")
     */
    private $unique;

    /**
     * @var bool $parentRequired If this request type needs a parent request
     *
     * @Groups({"read","write"})
     * @Assert\Type("bool")
     * @ORM\Column(type="boolean")
     */
    private $parentRequired = false;

    /**
     * @var ArrayCollection|RequestType[] The children of this request type
     *
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\RequestType", mappedBy="parent")
     */
    private $children;

    /**
     * @var RequestType The parent of this request type
     *
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\RequestType", inversedBy="children")
     */
    private $parent;

    /**
     * @var Datetime $dateCreated The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime $dateModified  The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->extendedBy = new ArrayCollection();
        $this->children = new ArrayCollection();
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

    public function getIcon(): ?string
    {
    	return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
    	$this->icon = $icon;

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
        while ($stage) {
            $array = [
                'id'         => $stage->getId(),
                'name'       => $stage->getName(),
                'description'=> $stage->getDescription(),
                'icon'       => $stage->getIcon(),
                'slug'       => $stage->getSlug(),
            ];

            if ($stage->getNext()) {
                $array['next'] = $stage->getNext()->getSlug();
            }

            if ($stage->getPrevious()->first()) {
                $array['previous'] = $stage->getPrevious()->first()->getSlug();
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

    public function getUnique(): ?bool
    {
    	return $this->unique;
    }

    public function setUnique(?bool $unique): self
    {
    	$this->unique = $unique;

    	return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
    	$this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
    	if (!$this->children->contains($child)) {
    		$this->children[] = $child;
    		$child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
    	if ($this->children->contains($child)) {
    		$this->children->removeElement($child);
            // set the owning side to null (unless already changed)
    		if ($child->getParent() === $this) {
    			$child->setParent(null);
            }
        }

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
    	return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
    	$this->dateCreated= $dateCreated;

    	return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
    	return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
    	$this->dateModified = $dateModified;

    	return $this;
    }

    public function getParentRequired(): ?bool
    {
        return $this->parentRequired;
    }

    public function setParentRequired(bool $parentRequired): self
    {
        $this->parentRequired = $parentRequired;

        return $this;
    }
}
