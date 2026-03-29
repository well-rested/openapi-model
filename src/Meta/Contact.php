<?php

declare(strict_types=1);

namespace OpenApiSchema\Meta;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Contact implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $name = null;

	protected ?string $url = null;

	protected ?string $email = null;

	public function setName(?string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getName(): ?string
	{
		return $this->name;
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

	public function setEmail(?string $email): self
	{
		$this->email = $email;
		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}
}
