<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use WellRested\OpenApiModel\Operations\Parameter;
use WellRested\OpenApiModel\Operations\ParameterLocation;
use WellRested\OpenApiModel\Schema\Schema;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
	public function test_defaults(): void
	{
		$parameter = new Parameter();

		$this->assertNull($parameter->getDescription());
		$this->assertNull($parameter->getRequired());
		$this->assertNull($parameter->getAllowsEmptyValue());
		$this->assertNull($parameter->getSchema());
		$this->assertNull($parameter->getStyle());
	}

	public function test_string_setters_and_getters(): void
	{
		$parameter = new Parameter();

		$parameter->setName('petId');
		$this->assertEquals('petId', $parameter->getName());

		$parameter->setIn(ParameterLocation::Path);
		$this->assertEquals(ParameterLocation::Path, $parameter->getIn());

		$parameter->setDescription('The pet identifier');
		$this->assertEquals('The pet identifier', $parameter->getDescription());

		$parameter->setDescription(null);
		$this->assertNull($parameter->getDescription());

		$parameter->setStyle('simple');
		$this->assertEquals('simple', $parameter->getStyle());

		$parameter->setStyle(null);
		$this->assertNull($parameter->getStyle());
	}

	public function test_bool_setters_and_getters(): void
	{
		$parameter = new Parameter();

		$parameter->setRequired(true);
		$this->assertTrue($parameter->getRequired());
		$parameter->setRequired(false);
		$this->assertFalse($parameter->getRequired());

		$parameter->setAllowsEmptyValue(true);
		$this->assertTrue($parameter->getAllowsEmptyValue());
		$parameter->setAllowsEmptyValue(false);
		$this->assertFalse($parameter->getAllowsEmptyValue());
	}

	public function test_schema(): void
	{
		$parameter = new Parameter();
		$schema = $this->createStub(Schema::class);

		$parameter->setSchema($schema);

		$this->assertSame($schema, $parameter->getSchema());
	}
}
