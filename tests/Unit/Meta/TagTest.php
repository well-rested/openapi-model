<?php

declare(strict_types=1);

namespace Tests\Unit\Meta;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Meta\Tag;
use WellRested\OpenApiModel\Meta\ExternalDocumentation;

class TagTest extends TestCase
{
	public function test_defaults(): void
	{
		$tag = new Tag();

		$this->assertNull($tag->getDescription());
		$this->assertNull($tag->getExternalDocs());
	}

	public function test_string_setters_and_getters(): void
	{
		$tag = new Tag();

		$tag->setName('pets');
		$this->assertEquals('pets', $tag->getName());

		$tag->setDescription('Everything about pets');
		$this->assertEquals('Everything about pets', $tag->getDescription());

		$tag->setDescription(null);
		$this->assertNull($tag->getDescription());
	}

	public function test_external_docs(): void
	{
		$tag = new Tag();
		$docs = $this->createStub(ExternalDocumentation::class);

		$tag->setExternalDocs($docs);
		$this->assertSame($docs, $tag->getExternalDocs());

		$tag->setExternalDocs(null);
		$this->assertNull($tag->getExternalDocs());
	}
}
