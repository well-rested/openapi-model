<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Meta;

use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class License implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $name;

	protected ?string $identifier = null;

	protected ?string $url = null;

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setIdentifier(?string $identifier): self
	{
		$this->identifier = $identifier;
		return $this;
	}

	public function getIdentifier(): ?string
	{
		return $this->identifier;
	}

	public function setUrl(?string $url): self
	{
		$this->url = $url;
		return $this;
	}

	public function getUrl(): ?string
	{
		return $this->url;
	}
}
