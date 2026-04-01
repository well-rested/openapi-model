<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Schema\Schema;
use WellRested\OpenApiModel\Schema\Schemas;
use WellRested\OpenApiModel\Schema\PolymorphicSchemas;

class SchemaTest extends TestCase
{
	public function test_defaults(): void
	{
		$schema = new Schema();

		$this->assertNull($schema->getRef());
		$this->assertNull($schema->getType());
		$this->assertNull($schema->getFormat());
		$this->assertNull($schema->getDescription());
		$this->assertNull($schema->getItems());
		$this->assertNull($schema->getExclusiveMaximum());
		$this->assertNull($schema->getExclusiveMinimum());
		$this->assertNull($schema->getNullable());
		$this->assertNull($schema->getWriteOnly());
		$this->assertNull($schema->getReadOnly());
		$this->assertNull($schema->getExamples());
		$this->assertEmpty($schema->getEnumCases());
		$this->assertTrue($schema->getOneOf()->isEmpty());
		$this->assertTrue($schema->getAnyOf()->isEmpty());
		$this->assertTrue($schema->getAllOf()->isEmpty());
		$this->assertTrue($schema->getProperties()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$schema = new Schema();

		$schema->setRef('#/components/schemas/Pet');
		$this->assertEquals('#/components/schemas/Pet', $schema->getRef());

		$schema->setType('object');
		$this->assertEquals('object', $schema->getType());

		$schema->setFormat('date-time');
		$this->assertEquals('date-time', $schema->getFormat());

		$schema->setDescription('A pet object');
		$this->assertEquals('A pet object', $schema->getDescription());

		$schema->setDescription(null);
		$this->assertNull($schema->getDescription());
	}

	public function test_int_setters_and_getters(): void
	{
		$schema = new Schema();

		$schema->setExclusiveMaximum(100);
		$this->assertEquals(100, $schema->getExclusiveMaximum());

		$schema->setExclusiveMinimum(0);
		$this->assertEquals(0, $schema->getExclusiveMinimum());
	}

	public function test_bool_setters_and_getters(): void
	{
		$schema = new Schema();

		$schema->setNullable(true);
		$this->assertTrue($schema->getNullable());
		$schema->setNullable(false);
		$this->assertFalse($schema->getNullable());

		$schema->setWriteOnly(true);
		$this->assertTrue($schema->getWriteOnly());
		$schema->setWriteOnly(false);
		$this->assertFalse($schema->getWriteOnly());

		$schema->setReadOnly(true);
		$this->assertTrue($schema->getReadOnly());
		$schema->setReadOnly(false);
		$this->assertFalse($schema->getReadOnly());
	}

	public function test_examples(): void
	{
		$schema = new Schema();

		$schema->setExamples(['first', 'second']);
		$this->assertEquals(['first', 'second'], $schema->getExamples());
	}

	public function test_items(): void
	{
		$schema = new Schema();
		$items = $this->createStub(Schema::class);

		$schema->setItems($items);

		$this->assertSame($items, $schema->getItems());
	}

	public function test_enum_cases(): void
	{
		$schema = new Schema();

		$schema->addEnumCases('draft', 'published');
		$schema->addEnumCases('archived');

		$this->assertEquals(['draft', 'published', 'archived'], $schema->getEnumCases());
	}

	public function test_properties(): void
	{
		$schema = new Schema();
		$property = $this->createStub(Schema::class);

		$this->assertInstanceOf(Schemas::class, $schema->getProperties());
		$this->assertTrue($schema->getProperties()->isEmpty());

		$schema->addProperty('name', $property);

		$this->assertFalse($schema->getProperties()->isEmpty());
		$this->assertSame($property, $schema->getProperties()->get('name'));
	}

	public function test_oneOf(): void
	{
		$schema = new Schema();
		$a = $this->createStub(Schema::class);
		$b = $this->createStub(Schema::class);

		$this->assertInstanceOf(PolymorphicSchemas::class, $schema->getOneOf());

		$schema->addOneOfSchemas($a, $b);

		$this->assertFalse($schema->getOneOf()->isEmpty());
	}

	public function test_anyOf(): void
	{
		$schema = new Schema();
		$a = $this->createStub(Schema::class);

		$schema->addAnyOfSchemas($a);

		$this->assertInstanceOf(PolymorphicSchemas::class, $schema->getAnyOf());
		$this->assertFalse($schema->getAnyOf()->isEmpty());
	}

	public function test_allOf(): void
	{
		$schema = new Schema();
		$a = $this->createStub(Schema::class);

		$schema->addAllOfSchemas($a);

		$this->assertInstanceOf(PolymorphicSchemas::class, $schema->getAllOf());
		$this->assertFalse($schema->getAllOf()->isEmpty());
	}
}
