<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Spec\Marshallable;
use OpenApiSchema\Spec\HasCustomAttributes;
use OpenApiSchema\Spec\ConvertsSelfToMarshallable;

class RequestBody implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $description = null;

	protected Content $content;

	protected ?bool $required = null;

	public function __construct()
	{
		$this->content = new Content();
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

	public function addMediaType(string $key, MediaType $mediaType): self
	{
		$this->content->add($key, $mediaType);
		return $this;
	}

	public function getContent(): Content
	{
		return $this->content;
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
}
