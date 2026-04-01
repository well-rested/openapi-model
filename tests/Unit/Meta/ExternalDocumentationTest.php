<?php

declare(strict_types=1);

namespace Tests\Unit\Meta;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Meta\ExternalDocumentation;

class ExternalDocumentationTest extends TestCase
{
	public function test_defaults(): void
	{
		$docs = new ExternalDocumentation();

		$this->assertNull($docs->getDescription());
	}

	public function test_string_setters_and_getters(): void
	{
		$docs = new ExternalDocumentation();

		$docs->setDescription('Find more info here');
		$this->assertEquals('Find more info here', $docs->getDescription());

		$docs->setDescription(null);
		$this->assertNull($docs->getDescription());

		$docs->setUrl('https://example.com/docs');
		$this->assertEquals('https://example.com/docs', $docs->getUrl());
	}
}
