<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Header implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $description = null;

	protected bool $required = false;

	protected bool $deprecated = false;

	protected ?Schema $schema = null;

	protected ?Content $content = null;

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

	public function getRequired(): bool
	{
		return $this->required;
	}

	public function setDeprecated(bool $deprecated): self
	{
		$this->deprecated = $deprecated;
		return $this;
	}

	public function getDeprecated(): bool
	{
		return $this->deprecated;
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

	public function setContent(Content $content): self
	{
		$this->content = $content;
		return $this;
	}

	public function getContent(): ?Content
	{
		return $this->content;
	}
}
