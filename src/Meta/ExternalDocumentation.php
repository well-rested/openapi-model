<?php

declare(strict_types=1);

namespace OpenApiSchema\Meta;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class ExternalDocumentation implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $description = null;

	protected string $url;

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setUrl(string $url): self
	{
		$this->url = $url;
		return $this;
	}

	public function getUrl(): string
	{
		return $this->url;
	}
}
