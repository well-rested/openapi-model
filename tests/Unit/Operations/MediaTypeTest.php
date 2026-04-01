<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\MediaType;
use WellRested\OpenApiModel\Schema\Schema;
use WellRested\OpenApiModel\Operations\Encoding;

class MediaTypeTest extends TestCase
{
	public function test_schema(): void
	{
		$mediaType = new MediaType();
		$schema = $this->createStub(Schema::class);

		$mediaType->setSchema($schema);

		$this->assertSame($schema, $mediaType->getSchema());
	}

	public function test_encoding(): void
	{
		$mediaType = new MediaType();
		$encoding = $this->createStub(Encoding::class);

		$mediaType->setEncoding($encoding);

		$this->assertSame($encoding, $mediaType->getEncoding());
	}
}
