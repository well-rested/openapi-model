<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Schema implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $ref = null;

	protected ?string $description = null;

	/** @var string[] $required */
	protected array $required;

	protected ?bool $writeOnly = null;

	protected ?bool $readOnly = null;

	protected ?string $type = null;

	protected ?string $format = null;

	protected ?int $exclusiveMaximum = null;

	protected ?int $exclusiveMinimum = null;

	/** @var string[] $enum */
	protected array $enum;

	protected ?bool $nullable = null;

	protected ?Schema $items = null;

	protected Schemas $properties;

	protected PolymorphicSchemas $oneOf;

	protected PolymorphicSchemas $anyOf;

	protected PolymorphicSchemas $allOf;

	// Not sure if there is a strict schema for this, can be all sorts...
	protected mixed $examples = null;

	public function __construct()
	{
		$this->required = [];
		$this->enum = [];
		$this->properties = new Schemas();
		$this->oneOf = new PolymorphicSchemas();
		$this->anyOf = new PolymorphicSchemas();
		$this->allOf = new PolymorphicSchemas();
	}

	public function setRef(string $ref): self
	{
		$this->ref = $ref;
		return $this;
	}

	public function getRef(): ?string
	{
		return $this->ref;
	}

	public function setType(string $type): self
	{
		$this->type = $type;
		return $this;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setFormat(string $format): self
	{
		$this->format = $format;
		return $this;
	}

	public function getFormat(): ?string
	{
		return $this->format;
	}

	public function addOneOfSchemas(Schema ...$schemas): self
	{
		$this->oneOf->add(...$schemas);

		return $this;
	}

	public function getOneOf(): PolymorphicSchemas
	{
		return $this->oneOf;
	}

	public function addAnyOfSchemas(Schema ...$schemas): self
	{
		$this->anyOf->add(...$schemas);

		return $this;
	}

	public function getAnyOf(): PolymorphicSchemas
	{
		return $this->anyOf;
	}

	public function addAllOfSchemas(Schema ...$schemas): self
	{
		$this->allOf->add(...$schemas);

		return $this;
	}

	public function getAllOf(): PolymorphicSchemas
	{
		return $this->allOf;
	}

	public function setItems(Schema $items): self
	{
		$this->items = $items;
		return $this;
	}

	public function getItems(): ?Schema
	{
		return $this->items;
	}

	public function setExamples(mixed $examples): self
	{
		$this->examples = $examples;
		return $this;
	}

	public function getExamples(): mixed
	{
		return $this->examples;
	}

	public function setExclusiveMaximum(int $exclusiveMaximum): self
	{
		$this->exclusiveMaximum = $exclusiveMaximum;
		return $this;
	}

	public function getExclusiveMaximum(): ?int
	{
		return $this->exclusiveMaximum;
	}

	public function setExclusiveMinimum(int $exclusiveMinimum): self
	{
		$this->exclusiveMinimum = $exclusiveMinimum;
		return $this;
	}

	public function getExclusiveMinimum(): ?int
	{
		return $this->exclusiveMinimum;
	}

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setNullable(bool $nullable): self
	{
		$this->nullable = $nullable;
		return $this;
	}

	public function getNullable(): ?bool
	{
		return $this->nullable;
	}

	public function markFieldsAsRequired(string ...$fields): self
	{
		$this->required = array_unique(
			array_merge($this->required, $fields),
		);

		return $this;
	}

	public function setWriteOnly(bool $writeOnly): self
	{
		$this->writeOnly = $writeOnly;
		return $this;
	}

	public function getWriteOnly(): ?bool
	{
		return $this->writeOnly;
	}

	public function setReadOnly(bool $readOnly): self
	{
		$this->readOnly = $readOnly;
		return $this;
	}

	public function getReadOnly(): ?bool
	{
		return $this->readOnly;
	}

	public function addProperty(string $key, Schema $property): self
	{
		$this->properties->add($key, $property);
		return $this;
	}

	public function getProperties(): Schemas
	{
		return $this->properties;
	}

	public function addEnumCases(string ...$cases): self
	{
		$this->enum = array_merge($this->enum, $cases);
		return $this;
	}

	/** @return string[] */
	public function getEnumCases(): array
	{
		return $this->enum;
	}
}
