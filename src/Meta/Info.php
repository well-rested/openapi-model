<?php

declare(strict_types=1);

namespace OpenApiSchema\Meta;

use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Info implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $title;

	protected ?string $summary = null;

	protected ?string $description = null;

	protected ?string $termsOfService = null;

	protected ?Contact $contact = null;

	protected ?License $license = null;

	protected string $version;

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	public function getTitle(): string
	{
		return $this->title;
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

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setTermsOfService(?string $termsOfService): self
	{
		$this->termsOfService = $termsOfService;
		return $this;
	}

	public function getTermsOfService(): ?string
	{
		return $this->termsOfService;
	}

	public function setContact(?Contact $contact): self
	{
		$this->contact = $contact;
		return $this;
	}

	public function getContact(): ?Contact
	{
		return $this->contact;
	}

	public function setLicense(?License $license): self
	{
		$this->license = $license;
		return $this;
	}

	public function getLicense(): ?License
	{
		return $this->license;
	}

	public function setVersion(string $version): self
	{
		$this->version = $version;
		return $this;
	}

	public function getVersion(): string
	{
		return $this->version;
	}
}
