<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Reference;
use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Encoding implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $contentType = null;

	protected Headers $headers;

	protected ?string $style = null;

	protected ?bool $explode = null;

	protected bool $allowReserved = false;

	public function __construct()
	{
		$this->headers = new Headers();
	}

	public function addHeaders(Header|Reference ...$items): self
	{
		$this->headers->add(...$items);
		return $this;
	}

	public function getHeaders(): Headers
	{
		return $this->headers;
	}

	public function setContentType(string $contentType): self
	{
		$this->contentType = $contentType;
		return $this;
	}

	public function getContentType(): ?string
	{
		return $this->contentType;
	}

	public function setStyle(string $style): self
	{
		$this->style = $style;
		return $this;
	}

	public function getStyle(): ?string
	{
		return $this->style;
	}

	public function setExplode(bool $explode): self
	{
		$this->explode = $explode;
		return $this;
	}

	public function getExplode(): ?bool
	{
		return $this->explode;
	}

	public function setAllowReserved(bool $allowReserved): self
	{
		$this->allowReserved = $allowReserved;
		return $this;
	}

	public function getAllowReserved(): bool
	{
		return $this->allowReserved;
	}
}
