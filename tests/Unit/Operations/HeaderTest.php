<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\Header;
use WellRested\OpenApiModel\Schema\Schema;
use WellRested\OpenApiModel\Operations\Content;

class HeaderTest extends TestCase
{
	public function test_defaults(): void
	{
		$header = new Header();

		$this->assertNull($header->getDescription());
		$this->assertFalse($header->getRequired());
		$this->assertFalse($header->getDeprecated());
		$this->assertNull($header->getSchema());
		$this->assertNull($header->getContent());
	}

	public function test_string_setters_and_getters(): void
	{
		$header = new Header();

		$header->setDescription('The number of allowed requests');
		$this->assertEquals('The number of allowed requests', $header->getDescription());

		$header->setDescription(null);
		$this->assertNull($header->getDescription());
	}

	public function test_bool_setters_and_getters(): void
	{
		$header = new Header();

		$header->setRequired(true);
		$this->assertTrue($header->getRequired());
		$header->setRequired(false);
		$this->assertFalse($header->getRequired());

		$header->setDeprecated(true);
		$this->assertTrue($header->getDeprecated());
		$header->setDeprecated(false);
		$this->assertFalse($header->getDeprecated());
	}

	public function test_schema(): void
	{
		$header = new Header();
		$schema = $this->createStub(Schema::class);

		$header->setSchema($schema);

		$this->assertSame($schema, $header->getSchema());
	}

	public function test_content(): void
	{
		$header = new Header();
		$content = $this->createStub(Content::class);

		$header->setContent($content);

		$this->assertSame($content, $header->getContent());
	}
}
