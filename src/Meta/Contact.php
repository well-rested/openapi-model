<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Meta;

use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

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
