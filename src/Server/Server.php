<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Server;

use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class Server implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected string $url;

	protected ?string $description = null;

	protected ServerVariables $variables;

	public function __construct()
	{
		$this->variables = new ServerVariables();
	}

	public function setUrl(string $url): self
	{
		$this->url = $url;
		return $this;
	}

	public function getUrl(): string
	{
		return $this->url;
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

	public function addVariable(string $key, ServerVariable $variable): self
	{
		$this->variables->add($key, $variable);
		return $this;
	}

	public function getVariables(): ServerVariables
	{
		return $this->variables;
	}
}
