<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Schema\Schema;
use OpenApiSchema\Utils\Marshallable;
use OpenApiSchema\Utils\HasCustomAttributes;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

class MediaType implements Marshallable
{
	use ConvertsSelfToMarshallable;
	use HasCustomAttributes;

	protected Schema $schema;

	protected Encoding $encoding;

	public function setSchema(Schema $schema): self
	{
		$this->schema = $schema;
		return $this;
	}

	public function getSchema(): Schema
	{
		return $this->schema;
	}

	public function setEncoding(Encoding $encoding): self
	{
		$this->encoding = $encoding;
		return $this;
	}

	public function getEncoding(): Encoding
	{
		return $this->encoding;
	}
}
