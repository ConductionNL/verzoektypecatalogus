<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This property follows the following schemes (in order of importance)
 * https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.2.md
 * https://tools.ietf.org/html/draft-wright-json-schema-validation-00
 * http://json-schema.org/.
 *
 * @ApiResource(
 *     attributes={"order"={"order"="ASC"}},
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/properties/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/properties/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     },
 * )
 *
 *  @ORM\Table(
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="property_unique_name",
 *            columns={"request_type", "name"})
 *    }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 * @ORM\HasLifecycleCallbacks
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class)
 */
class Property
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
     * @var object The requestType that this property belongs to
     *
     * @Assert\NotBlank
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\RequestType", inversedBy="properties",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, name="request_type")
     */
    private $requestType;

    /**
     * @var string The title of this property
     *
     * @example My Property
     * @Assert\NotBlank
     * @Assert\Length(min = 3, max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string The name of the property as used in api calls, extracted from title on snake_case basis
     *
     * @example my_property
     * @Assert\Length(min = 15, max = 255)
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var int The order in wichs this propertie is desplayed
     *
     * @example 1
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true, name="p_order")
     */
    private $order;

    /**
     * @var string The type of this property
     *
     * @example string
     *
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     * @Assert\Choice({"string", "integer", "boolean", "number","array"})
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string The swagger type of the property as used in api calls
     *
     * @example string
     *
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $format;

    /**
     * @var string The iri type of the property used to standarize datas
     *
     * @example https://schema.org/name
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iri;

    /**
     * @var array An array of aditional query values that need to be applied to the iri, for example anly accept products from a specific catagory
     *
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $query = [];

    /**
     * @var string *Can only be used in combination with type integer* Specifies a number where the value should be a multiple of, e.g. a multiple of 2 would validate 2,4 and 6 but would prevent 5
     *
     * @example 2
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $multipleOf;

    /**
     * @var string *Can only be used in combination with type integer* The maximum allowed value
     *
     * @example 2
     *
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maximum;

    /**
     * @var string *Can only be used in combination with type integer* Defines if the maximum is exclusive, e.g. a exclusive maximum of 5 would invalidate 5 but validate 4
     *
     * @example true
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $exclusiveMaximum;

    /**
     * @var string *Can only be used in combination with type integer* The minimum allowed value
     *
     * @example 2
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minimum;

    /**
     * @var string *Can only be used in combination with type integer* Defines if the minimum is exclusive, e.g. a exclusive minimum of 5 would invalidate 5 but validate 6
     *
     * @example true
     *
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $exclusiveMinimum;

    /**
     * @var string The maximum amount of characters in the value
     *
     * @example 2
     *
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxLength;

    /**
     * @var int The minimal amount of characters in the value
     *
     * @example 2
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minLength;

    /**
     * @var string A [regular expression](https://en.wikipedia.org/wiki/Regular_expression) that the value should comply to
     *
     * @example regex
     *
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pattern;

    /**
     * Not yet supported by business logic.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Property")
     */
    private $items;

    /**
     * @var bool Not yet supported by business logic
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $additionalItems;

    /**
     * @var string *Can only be used in combination with type array* The maximum array length
     *
     * @example 2
     *
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxItems;

    /**
     * @var string *Can only be used in combination with type array* The minimum allowed value
     *
     * @example 2
     *
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minItems;

    /**
     * @var bool *Can only be used in combination with type array* Define whether or not values in an array should be unique
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $uniqueItems;

    /**
     * @var string *Can only be used in combination with type integer* The maximum amount of properties an object should contain
     *
     * @example 2
     *
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxProperties;

    /**
     * @var int *Can only be used in combination with type object* The minimum amount of properties an object should contain
     *
     * @example 2
     *
     * @Assert\Type("integer")
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minProperties;

    /**
     * @var bool Only whether or not this property is required
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $required;

    /**
     * @var Property[]|ArrayCollection Not yet supported by business logic
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="object", nullable=true)
     */
    private $properties;

    /**
     * @var Property[]|ArrayCollection Not yet supported by business logic
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="object", nullable=true)
     */
    private $additionalProperties;

    /**
     * @var object Not yet supported by business logic
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="object", nullable=true)
     */
    private $object;

    /**
     * @var array An array of possible values, input is limited to this array]
     *
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $enum = [];

    /**
     * @var array *mutually exclusive with using type* An array of possible types that an property should confirm to]
     *
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $allOf = [];

    /**
     * @var array *mutually exclusive with using type* An array of possible types that an property might confirm to]
     *
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $anyOf = [];

    /**
     * @var array *mutually exclusive with using type* An array of possible types that an property must confirm to]
     *
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $oneOf = [];

    /**
     * Not yet supported by business logic.
     *
     * @ORM\Column(type="object", nullable=true)
     */
    private $definitions;

    /**
     * @var string An description of the value asked, supports markdown syntax as described by [CommonMark 0.27.](https://spec.commonmark.org/0.27/)
     *
     * @example My value
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string An default value for this value that will be used if a user doesn't supply a value
     *
     * @example My value
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defaultValue;

    /**
     * @var bool Whether or not this property can be left empty
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $nullable;

    /**
     * @var string To help API consumers detect the object type, you can add the discriminator/propertyName keyword to model definitions. This keyword points to the property that specifies the data type name
     *
     * @example name
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discriminator;

    /**
     * @var bool Whether or not this property is read only
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $readOnly;

    /**
     * @var bool Whether or not this property is write only
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $writeOnly;

    /**
     * @var string An XML representation of the swagger docs
     *
     * @example '<xml></xml>'
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $xml;

    /**
     * @var string An link to any external documentation for the value
     *
     * @example https://www.w3.org/TR/NOTE-datetime
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $externalDoc;

    /**
     * @var string An example of the value that should be supplied
     *
     * @example My value
     *
     * @Assert\Length(max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $example;

    /**
     * @var bool Whether or not this property has been deprecated and wil be removed in the future
     *
     * @example false
     *
     * @Assert\Type("bool")
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $deprecated;

    /**
     * @var string The moment from which this value is available
     *
     * @example 2019-09-16T14:26:51+00:00
     *
     * @Groups({"read", "write"})
     * @Assert\DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $availableFrom;

    /**
     * @var string *should be used in combination with deprecated* The moment where until this value is available
     *
     * @example 2019-09-16T14:26:51+00:00
     *
     * @Groups({"read", "write"})
     * @Assert\DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $availableUntil;

    /**
     * @var string The minimal date for value, either a date, datetime or duration (ISO_8601)
     *
     * @example 2019-09-16T14:26:51+00:00
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $minDate;

    /**
     * @var string The maximum date for value, either a date, datetime or duration (ISO_8601)
     *
     * @example 2019-09-16T14:26:51+00:00
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maxDate;

    /**
     * @var Property The next property of the request type
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Property", inversedBy="previous", cascade={"persist"})
     */
    private $next;

    /**
     * @var Property The previous property of the request type
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Property", mappedBy="next", cascade={"persist"})
     */
    private $previous;

    /**
     * @var string The icon of this property
     *
     * @example My Property
     *
     * @Assert\Length(min = 3, max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @var string The slug of this property
     *
     * @example my-slug
     *
     * @Assert\Length(min = 3, max = 255)
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string Whether or not this proerty is the starting oint of a process
     *
     * @example true
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $start = false;

    /**
     * @var array  An array of possible configuration options for form ellements
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $configuration = [];


    /**
     * @var Datetime The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     *  @ORM\PrePersist
     *  @ORM\PreUpdate
     *
     *  */
    public function prePersist()
    {
        if (!$this->name) {
            // titles wil be used as strings so lets convert the to camelcase
            $string = $this->title;
            $string = trim($string); //removes whitespace at begin and ending
            $string = preg_replace('/\s+/', '_', $string); // replaces other whitespaces with _
            $string = strtolower($string);

            $this->name = $string;
        }
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->previous = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getRequestType(): ?RequestType
    {
        return $this->requestType;
    }

    public function setRequestType(?RequestType $requestType): self
    {
        $this->requestType = $requestType;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        if ($this->name) {
            return $this->name;
        }
        // titles wil be used as strings so lets convert the to camelcase
        $string = $this->title;
        $string = trim($string); //removes whitespace at begin and ending
        $string = preg_replace('/\s+/', '_', $string); // replaces other whitespaces with _
        $string = strtolower($string);

        return $string;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getMultipleOf(): ?int
    {
        return $this->multipleOf;
    }

    public function setMultipleOf(?int $multipleOf): self
    {
        $this->multipleOf = $multipleOf;

        return $this;
    }

    public function getMaximum(): ?int
    {
        return $this->maximum;
    }

    public function setMaximum(?int $maximum): self
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function getExclusiveMaximum(): ?bool
    {
        return $this->exclusiveMaximum;
    }

    public function setExclusiveMaximum(?bool $exclusiveMaximum): self
    {
        $this->exclusiveMaximum = $exclusiveMaximum;

        return $this;
    }

    public function getMinimum(): ?int
    {
        return $this->minimum;
    }

    public function setMinimum(?int $minimum): self
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getExclusiveMinimum(): ?bool
    {
        return $this->exclusiveMinimum;
    }

    public function setExclusiveMinimum(?bool $exclusiveMinimum): self
    {
        $this->exclusiveMinimum = $exclusiveMinimum;

        return $this;
    }

    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    public function setMaxLength(?int $maxLength): self
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    public function setMinLength(?int $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(?string $pattern): self
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(self $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function removeItem(self $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }

        return $this;
    }

    public function getAdditionalItems(): ?bool
    {
        return $this->additionalItems;
    }

    public function setAdditionalItems(?bool $additionalItems): self
    {
        $this->additionalItems = $additionalItems;

        return $this;
    }

    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    public function setMaxItems(?int $maxItems): self
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function getMinItems(): ?int
    {
        return $this->minItems;
    }

    public function setMinItems(int $minItems): self
    {
        $this->minItems = $minItems;

        return $this;
    }

    public function getUniqueItems(): ?bool
    {
        return $this->uniqueItems;
    }

    public function setUniqueItems(?bool $uniqueItems): self
    {
        $this->uniqueItems = $uniqueItems;

        return $this;
    }

    public function getMaxProperties(): ?int
    {
        return $this->maxProperties;
    }

    public function setMaxProperties(?int $maxProperties): self
    {
        $this->maxProperties = $maxProperties;

        return $this;
    }

    public function getMinProperties(): ?int
    {
        return $this->minProperties;
    }

    public function setMinProperties(?int $minProperties): self
    {
        $this->minProperties = $minProperties;

        return $this;
    }

    public function getRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(?bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function setProperties($properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    public function getAdditionalProperties()
    {
        return $this->additionalProperties;
    }

    public function setAdditionalProperties($additionalProperties): self
    {
        $this->additionalProperties = $additionalProperties;

        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getEnum(): ?array
    {
        return $this->enum;
    }

    public function setEnum(?array $enum): self
    {
        $this->enum = $enum;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAllOf(): ?array
    {
        return $this->allOf;
    }

    public function setAllOf(?array $allOf): self
    {
        $this->allOf = $allOf;

        return $this;
    }

    public function getAnyOf(): ?array
    {
        return $this->anyOf;
    }

    public function setAnyOf(?array $anyOf): self
    {
        $this->anyOf = $anyOf;

        return $this;
    }

    public function getOneOf(): ?array
    {
        return $this->oneOf;
    }

    public function setOneOf(?array $oneOf): self
    {
        $this->oneOf = $oneOf;

        return $this;
    }

    public function getDefinitions()
    {
        return $this->definitions;
    }

    public function setDefinitions($definitions): self
    {
        $this->definitions = $definitions;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getIri(): ?string
    {
        return $this->iri;
    }

    public function setIri(?string $iri): self
    {
        $this->iri = $iri;

        return $this;
    }

    public function getQuery(): ?array
    {
        return $this->query;
    }

    public function setQuery(?array $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getNullable(): ?bool
    {
        return $this->nullable;
    }

    public function setNullable(bool $nullable): self
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    public function setDiscriminator($discriminator): self
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setReadOnly(?bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function getWriteOnly(): ?bool
    {
        return $this->writeOnly;
    }

    public function setWriteOnly(?bool $writeOnly): self
    {
        $this->writeOnly = $writeOnly;

        return $this;
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function setXml($xml): self
    {
        $this->xml = $xml;

        return $this;
    }

    public function getExternalDoc()
    {
        return $this->externalDoc;
    }

    public function setExternalDoc($externalDoc): self
    {
        $this->externalDoc = $externalDoc;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }

    public function setExample(?string $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getDeprecated(): ?bool
    {
        return $this->deprecated;
    }

    public function setDeprecated(?bool $deprecated): self
    {
        $this->deprecated = $deprecated;

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

    public function getMinDate(): ?string
    {
        return $this->minDate;
    }

    public function setMinDate(?string $minDate): self
    {
        $this->minDate = $minDate;

        return $this;
    }

    public function getMaxDate(): ?string
    {
        return $this->maxDate;
    }

    public function setMaxDate(?string $maxDate): self
    {
        $this->maxDate = $maxDate;

        return $this;
    }

    public function getNext(): ?self
    {
        return $this->next;
    }

    public function setNext(?self $next): self
    {
        $this->next = $next;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPrevious(): Collection
    {
        return $this->previous;
    }

    public function addPrevious(self $previous): self
    {
        if (!$this->previous->contains($previous)) {
            $this->previous[] = $previous;
            $previous->setNext($this);
        }

        return $this;
    }

    public function removePrevious(self $previous): self
    {
        if ($this->previous->contains($previous)) {
            $this->previous->removeElement($previous);
            // set the owning side to null (unless already changed)
            if ($previous->getNext() === $this) {
                $previous->setNext(null);
            }
        }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStart(): ?bool
    {
        return $this->start;
    }

    public function setStart(bool $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getConfiguration(): ?array
    {
        return $this->configuration;
    }

    public function setConfiguration(array $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }


    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

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
}
