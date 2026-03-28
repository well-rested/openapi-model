<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Reference;
use OpenApiSchema\Server\Server;
use OpenApiSchema\Server\Servers;
use OpenApiSchema\Spec\Marshallable;
use OpenApiSchema\Spec\HasCustomAttributes;
use OpenApiSchema\Spec\ConvertsSelfToMarshallable;

class PathItem implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected ?string $ref = null;

	protected ?string $summary = null;

	protected ?string $description = null;

	protected Servers $servers;

	protected Parameters $parameters;

	protected ?Operation $get = null;

	protected ?Operation $put = null;

	protected ?Operation $post = null;

	protected ?Operation $delete = null;

	protected ?Operation $options = null;

	protected ?Operation $head = null;

	protected ?Operation $patch = null;

	protected ?Operation $trace = null;

	public function __construct()
	{
		$this->servers = new Servers();
		$this->parameters = new Parameters();
	}

	public function setRef(?string $ref): self
	{
		$this->ref = $ref;
		return $this;
	}

	public function getRef(): ?string
	{
		return $this->ref;
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

	public function addServer(Server ...$servers): self
	{
		$this->servers->add(...$servers);
		return $this;
	}

	public function getServers(): Servers
	{
		return $this->servers;
	}

	public function addParameters(Parameter|Reference ...$parameters): self
	{
		$this->parameters->add(...$parameters);
		return $this;
	}

	public function getParameters(): Parameters
	{
		return $this->parameters;
	}

	public function setGet(?Operation $get): self
	{
		$this->get = $get;
		return $this;
	}

	public function getGet(): ?Operation
	{
		return $this->get;
	}

	public function setPut(?Operation $put): self
	{
		$this->put = $put;
		return $this;
	}

	public function getPut(): ?Operation
	{
		return $this->put;
	}

	public function setPost(?Operation $post): self
	{
		$this->post = $post;
		return $this;
	}

	public function getPost(): ?Operation
	{
		return $this->post;
	}

	public function setDelete(?Operation $delete): self
	{
		$this->delete = $delete;
		return $this;
	}

	public function getDelete(): ?Operation
	{
		return $this->delete;
	}

	public function setOptions(?Operation $options): self
	{
		$this->options = $options;
		return $this;
	}

	public function getOptions(): ?Operation
	{
		return $this->options;
	}

	public function setHead(?Operation $head): self
	{
		$this->head = $head;
		return $this;
	}

	public function getHead(): ?Operation
	{
		return $this->head;
	}

	public function setPatch(?Operation $patch): self
	{
		$this->patch = $patch;
		return $this;
	}

	public function getPatch(): ?Operation
	{
		return $this->patch;
	}

	public function setTrace(?Operation $trace): self
	{
		$this->trace = $trace;
		return $this;
	}

	public function getTrace(): ?Operation
	{
		return $this->trace;
	}
}
