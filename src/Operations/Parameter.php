<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Schema\Schema;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\Marshallable;

class Parameter implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $name;

	protected ParameterLocation $in;

	protected ?string $description = null;

	protected ?bool $required = null;

	protected ?bool $deprecated = null;

	protected ?bool $allowEmptyValue = null;

	protected ?Schema $schema = null;

	protected ?string $style = null;

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setIn(ParameterLocation $in): self
	{
		$this->in = $in;
		return $this;
	}

	public function getIn(): ParameterLocation
	{
		return $this->in;
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

	public function setRequired(bool $required): self
	{
		$this->required = $required;
		return $this;
	}

	public function getRequired(): ?bool
	{
		return $this->required;
	}

	public function setAllowsEmptyValue(bool $allowed): self
	{
		$this->allowEmptyValue = $allowed;
		return $this;
	}

	public function getAllowsEmptyValue(): ?bool
	{
		return $this->allowEmptyValue;
	}

	public function setSchema(Schema $schema): self
	{
		$this->schema = $schema;
		return $this;
	}

	public function getSchema(): ?Schema
	{
		return $this->schema;
	}

	public function setStyle(?string $style): self
	{
		$this->style = $style;
		return $this;
	}

	public function getStyle(): ?string
	{
		return $this->style;
	}
}
