<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Schema\Schema;
use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Parameter implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $name;

	// TODO: enum for this (query, header, path, cookie)
	protected string $in;

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

	public function setIn(string $in): self
	{
		$this->in = $in;
		return $this;
	}

	public function getIn(): string
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

	/** @deprecated use setAllowsEmptyValue */
	public function allowsEmptyValue(): self
	{
		$this->allowEmptyValue = true;
		return $this;
	}

	/** @deprecated use setAllowsEmptyValue */
	public function doesNotAllowEmptyValue(): self
	{
		$this->allowEmptyValue = false;
		return $this;
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
