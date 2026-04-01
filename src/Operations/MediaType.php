<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Schema\Schema;
use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

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
