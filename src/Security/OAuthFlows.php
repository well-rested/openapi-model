<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class OAuthFlows implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?OAuthFlow $implicit = null;

	protected ?OAuthFlow $password = null;

	protected ?OAuthFlow $clientCredentials = null;

	protected ?OAuthFlow $authorizationCode = null;

	public function setImplicit(OAuthFlow $oAuthFlow): self
	{
		$this->implicit = $oAuthFlow;
		return $this;
	}

	public function getImplicit(): ?OAuthFlow
	{
		return $this->implicit;
	}

	public function setPassword(OAuthFlow $oAuthFlow): self
	{
		$this->password = $oAuthFlow;
		return $this;
	}

	public function getPassword(): ?OAuthFlow
	{
		return $this->password;
	}

	public function setClientCredentials(OAuthFlow $oAuthFlow): self
	{
		$this->clientCredentials = $oAuthFlow;
		return $this;
	}

	public function getClientCredentials(): ?OAuthFlow
	{
		return $this->clientCredentials;
	}

	public function setAuthorizationCode(OAuthFlow $oAuthFlow): self
	{
		$this->authorizationCode = $oAuthFlow;
		return $this;
	}

	public function getAuthorizationCode(): ?OAuthFlow
	{
		return $this->authorizationCode;
	}
}
