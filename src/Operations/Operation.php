<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Reference;
use OpenApiSchema\Server\Server;
use OpenApiSchema\Server\Servers;
use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Meta\ExternalDocumentation;
use OpenApiSchema\Security\SecurityRequirements;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class Operation implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	/** @var string[] $tags */
	protected array $tags;

	protected ?string $summary = null;

	protected ?string $description = null;

	protected ?ExternalDocumentation $externalDocs = null;

	protected ?string $operationId = null;

	protected Parameters $parameters;

	protected ?RequestBody $requestBody = null;

	protected Security $security;

	protected Responses $responses;

	protected Servers $servers;

	protected ?bool $deprecated = null;

	// Need to deal with this one still...
	protected PathItems $callbacks;

	public function __construct()
	{
		$this->servers = new Servers();
		$this->tags = [];
		$this->parameters = new Parameters();
		$this->responses = new Responses();
		$this->callbacks = new PathItems();
		$this->security = new Security();
	}

	public function addTag(string $tag): self
	{
		$this->tags[] = $tag;
		return $this;
	}

	/** @return string[] */
	public function getTags(): array
	{
		return $this->tags;
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

	public function setExternalDocs(?ExternalDocumentation $externalDocs): self
	{
		$this->externalDocs = $externalDocs;
		return $this;
	}

	public function getExternalDocs(): ?ExternalDocumentation
	{
		return $this->externalDocs;
	}

	public function setOperationId(?string $operationId): self
	{
		$this->operationId = $operationId;
		return $this;
	}

	public function getOperationId(): ?string
	{
		return $this->operationId;
	}

	public function addParameters(Parameter ...$parameters): self
	{
		$this->parameters->add(...$parameters);
		return $this;
	}

	public function getParameters(): Parameters
	{
		return $this->parameters;
	}

	public function setRequestBody(?RequestBody $requestBody): self
	{
		$this->requestBody = $requestBody;
		return $this;
	}

	public function getRequestBody(): ?RequestBody
	{
		return $this->requestBody;
	}

	public function addResponse(string $key, Response|Reference $response): self
	{
		$this->responses->add($key, $response);
		return $this;
	}

	public function getResponses(): Responses
	{
		return $this->responses;
	}

	public function addCallback(string $key, PathItem $pathItem): self
	{
		$this->callbacks->add($key, $pathItem);
		return $this;
	}

	public function getCallbacks(): PathItems
	{
		return $this->callbacks;
	}

	public function setDeprecated(?bool $deprecated): self
	{
		$this->deprecated = $deprecated;
		return $this;
	}

	public function getDeprecated(): ?bool
	{
		return $this->deprecated;
	}

	public function addSecurityRequirement(SecurityRequirements $requirement): self
	{
		$this->security->add($requirement);
		return $this;
	}

	public function getSecurity(): Security
	{
		return $this->security;
	}

	public function addServers(Server ...$servers): self
	{
		$this->servers->add(...$servers);
		return $this;
	}

	public function getServers(): Servers
	{
		return $this->servers;
	}
}
