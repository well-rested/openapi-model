<?php

declare(strict_types=1);

namespace OpenApiSchema\Components;

use OpenApiSchema\Spec\Marshallable;
use OpenApiSchema\Spec\HasCustomAttributes;
use OpenApiSchema\Spec\ConvertsSelfToMarshallable;

class Example implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $description = null;

	protected ?string $summary = null;

	protected mixed $value = null;

	protected ?string $externalValue = null;

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setSummary(?string $summary): self
	{
		$this->summary = $summary;
		return $this;
	}

	public function getSummary(): ?string
	{
		return $this->summary;
	}

	public function setValue(mixed $value): self
	{
		$this->value = $value;
		return $this;
	}

	public function getValue(): mixed
	{
		return $this->value;
	}

	public function setExternalValue(?string $externalValue): self
	{
		$this->externalValue = $externalValue;
		return $this;
	}

	public function getExternalValue(): ?string
	{
		return $this->externalValue;
	}
}
