<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Meta;

use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class Tag implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $name;

	protected ?string $description = null;

	protected ?ExternalDocumentation $externalDocs = null;

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
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

	public function setExternalDocs(?ExternalDocumentation $externalDocs): self
	{
		$this->externalDocs = $externalDocs;
		return $this;
	}

	public function getExternalDocs(): ?ExternalDocumentation
	{
		return $this->externalDocs;
	}
}
