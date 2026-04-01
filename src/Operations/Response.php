<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Reference;
use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class Response implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $description = '';

	protected Headers $headers;

	protected Content $content;

	public function __construct()
	{
		$this->headers = new Headers();
		$this->content = new Content();
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

	public function setDescription(string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): string
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
}
