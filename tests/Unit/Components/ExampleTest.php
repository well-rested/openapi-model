<?php

declare(strict_types=1);

namespace Tests\Unit\Components;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Components\Example;

class ExampleTest extends TestCase
{
	public function test_defaults(): void
	{
		$example = new Example();

		$this->assertNull($example->getDescription());
		$this->assertNull($example->getSummary());
		$this->assertNull($example->getExternalValue());
	}

	public function test_string_setters_and_getters(): void
	{
		$example = new Example();

		$example->setDescription('A sample object');
		$this->assertEquals('A sample object', $example->getDescription());

		$example->setDescription(null);
		$this->assertNull($example->getDescription());

		$example->setSummary('Short summary');
		$this->assertEquals('Short summary', $example->getSummary());

		$example->setSummary(null);
		$this->assertNull($example->getSummary());

		$example->setExternalValue('https://example.com/example.json');
		$this->assertEquals('https://example.com/example.json', $example->getExternalValue());

		$example->setExternalValue(null);
		$this->assertNull($example->getExternalValue());
	}

	public function test_value(): void
	{
		$example = new Example();

		$example->setValue(['key' => 'value']);
		$this->assertEquals(['key' => 'value'], $example->getValue());

		$example->setValue('a string');
		$this->assertEquals('a string', $example->getValue());

		$example->setValue(42);
		$this->assertEquals(42, $example->getValue());
	}
}
