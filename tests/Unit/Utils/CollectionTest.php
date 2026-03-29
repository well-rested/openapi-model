<?php

declare(strict_types=1);

namespace Tests\Unit\Utils;

use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use OpenApiSchema\Utils\MarshallingContext;
use Tests\Unit\Utils\Stubs\StringCollection;

class CollectionTest extends TestCase
{
	public function test_is_empty(): void
	{
		$coll = new StringCollection();
		$this->assertTrue($coll->isEmpty());

		$coll->add("blah");

		$this->assertFalse($coll->isEmpty());
	}

	#[DataProvider('invalidTypes')]
	public function test_adding_invalid_types(mixed $val): void
	{
		$this->expectExceptionObject(
			new InvalidArgumentException('incorrect type for ' . StringCollection::class),
		);
		$coll = new StringCollection();

		/** @phpstan-ignore argument.type */
		$coll->add($val);
	}

	public static function invalidTypes(): Generator
	{
		yield "int" => [1234];
		yield "bool" => [true];
		yield "array" => [["some", "array"]];
	}

	public function test_to_marshallable(): void
	{
		$ctx = $this->createStub(MarshallingContext::class);
		$coll = new StringCollection();
		$coll->add("some");
		$coll->add("strings");

		$this->assertEquals(
			["some", "strings"],
			$coll->toMarshallable($ctx),
		);
	}

	public function test_can_iterate(): void
	{
		$coll = new StringCollection();
		$coll->add("some", "strings");
		$coll->add("other");

		$values = [];
		foreach ($coll as $key => $value) {
			$values[$key] = $value;
		}

		$this->assertEquals([
			0 => 'some',
			1 => 'strings',
			2 => 'other',
		], $values);
	}
}
