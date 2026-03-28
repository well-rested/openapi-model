<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Spec\Marshallable;
use OpenApiSchema\Spec\HasCustomAttributes;
use OpenApiSchema\Spec\ConvertsSelfToMarshallable;

class SecurityScheme implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $description = null;

	protected ?string $type = null;

	protected ?string $name = null;

	//TODO: enum (query,header,cookie)
	protected ?string $in = null;

	protected ?string $scheme = null;

	protected ?string $bearerFormat = null;

	protected ?string $openIdConnectUrl = null;

	protected OAuthFlows $flows;

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setType(?string $type): self
	{
		$this->type = $type;
		return $this;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setName(?string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setIn(?string $in): self
	{
		$this->in = $in;
		return $this;
	}

	public function getIn(): ?string
	{
		return $this->in;
	}

	public function setScheme(?string $scheme): self
	{
		$this->scheme = $scheme;
		return $this;
	}

	public function getScheme(): ?string
	{
		return $this->scheme;
	}

	public function setBearerFormat(?string $bearerFormat): self
	{
		$this->bearerFormat = $bearerFormat;
		return $this;
	}

	public function getBearerFormat(): ?string
	{
		return $this->bearerFormat;
	}

	public function setOpenIdConnectUrl(?string $openIdConnectUrl): self
	{
		$this->openIdConnectUrl = $openIdConnectUrl;
		return $this;
	}

	public function getOpenIdConnectUrl(): ?string
	{
		return $this->openIdConnectUrl;
	}

	public function setOAuthFlows(OAuthFlows $flows): self
	{
		$this->flows = $flows;
		return $this;
	}

	public function getOAuthFlows(): OAuthFlows
	{
		return $this->flows;
	}
}
