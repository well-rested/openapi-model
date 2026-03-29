<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\StringDictionary;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class OAuthFlow implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $authorizationUrl = null;

	protected ?string $tokenUrl = null;

	protected ?string $refreshUrl = null;

	protected StringDictionary $scopes;

	public function __construct()
	{
		$this->scopes = new StringDictionary();
	}

	public function setAuthorizationUrl(string $authorizationUrl): self
	{
		$this->authorizationUrl = $authorizationUrl;
		return $this;
	}

	public function getAuthorizationUrl(): ?string
	{
		return $this->authorizationUrl;
	}

	public function setTokenUrl(string $tokenUrl): self
	{
		$this->tokenUrl = $tokenUrl;
		return $this;
	}

	public function getTokenUrl(): ?string
	{
		return $this->tokenUrl;
	}

	public function setRefreshUrl(string $refreshUrl): self
	{
		$this->refreshUrl = $refreshUrl;
		return $this;
	}

	public function getRefreshUrl(): ?string
	{
		return $this->refreshUrl;
	}

	public function addScope(string $key, string $value): self
	{
		$this->scopes->add($key, $value);
		return $this;
	}

	public function getScopes(): StringDictionary
	{
		return $this->scopes;
	}
}
