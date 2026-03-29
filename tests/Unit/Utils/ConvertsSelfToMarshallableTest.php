<?php

declare(strict_types=1);

namespace Tests\Unit\Utils;

use stdClass;
use Generator;
use PHPUnit\Framework\TestCase;
use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Utils\MarshallingContext;
use Tests\Unit\Utils\Stubs\MarshallableBase;
use OpenApiSchema\Utils\CustomAttributeDictionary;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Unit\Utils\Stubs\MarshallableArrayWhenEmpty;
use Tests\Unit\Utils\Stubs\MarshallableRetainEmptyArrays;
use Tests\Unit\Utils\Stubs\MarshallableWithCustomAttributes;
use Tests\Unit\Utils\Stubs\MarshallableRetainEmptyCollections;

class ConvertsSelfToMarshallableTest extends TestCase
{
	#[DataProvider('scenarios')]
	public function test_to_marshallable(callable $buildSubject, array|stdClass $expect): void
	{
		/** ConvertsSelfToMarshallable $subject */
		$subject = $buildSubject($this);

		$ctx = $this->createStub(MarshallingContext::class);
		$output = $subject->toMarshallable($ctx);

		$this->assertEqualsCanonicalizing($expect, $output);
	}

	public static function scenarios(): Generator
	{
		yield 'everything populated' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(false);
				$collection->method('toMarshallable')->willReturn([
					'my-collection',
				]);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(false);
				$dict->method('toMarshallable')->willReturn([
					'my' => 'dict',
				]);

				return new MarshallableBase(
					$collection,
					[
						'some-array',
					],
					$dict,
					'some-string',
				);
			},
			[
				'someCollection' => [
					'my-collection',
				],
				'someArray' => [
					'some-array',
				],
				'someDict' => [
					'my' => 'dict',
				],
				'someString' => 'some-string',
			],
		];

		yield 'all collections/dictionaries are empty' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableBase(
					$collection,
					[],
					$dict,
					'some-string',
				);
			},
			[
				'someString' => 'some-string',
			],
		];

		yield 'everything is empty' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableBase(
					$collection,
					[],
					$dict,
					null,
				);
			},
			new stdClass(),
		];

		yield 'empty collections are not omitted' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableRetainEmptyCollections(
					$collection,
					[],
					$dict,
					null,
				);
			},
			[
				'someCollection' => [],
			],
		];

		yield 'empty arrays are not omitted' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableRetainEmptyArrays(
					$collection,
					[],
					$dict,
					null,
				);
			},
			[
				'someArray' => [],
			],
		];

		yield 'empty dictionaires are not omitted' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableRetainEmptyArrays(
					$collection,
					[],
					$dict,
					null,
				);
			},
			[
				'someDict' => [],
			],
		];

		yield 'overrides to return array when empty' => [
			function (self $test) {
				$collection = $test->createStub(Collection::class);
				$collection->method('isEmpty')->willReturn(true);

				$dict = $test->createStub(Dictionary::class);
				$dict->method('isEmpty')->willReturn(true);

				return new MarshallableArrayWhenEmpty(
					$collection,
					[],
					$dict,
					null,
				);
			},
			[],
		];

		yield 'custom attributes are included' => [
			function (self $test) {
				$custom = $test->createStub(CustomAttributeDictionary::class);
				$custom->method('toMarshallable')->willReturn([
					'custom' => 'attribute',
				]);

				return new MarshallableWithCustomAttributes(
					$custom,
					'some-string',
				);
			},
			[
				'someString' => 'some-string',
				'custom' => 'attribute',
			],
		];

		yield 'custom attribute overrides class property' => [
			function (self $test) {
				$custom = $test->createStub(CustomAttributeDictionary::class);
				$custom->method('toMarshallable')->willReturn([
					'someString' => 'my-override',
				]);

				return new MarshallableWithCustomAttributes(
					$custom,
					'some-string',
				);
			},
			[
				'someString' => 'my-override',
			],
		];

		yield 'custom attribute with ref prop is prefixed with $' => [
			function (self $test) {
				$custom = $test->createStub(CustomAttributeDictionary::class);
				$custom->method('toMarshallable')->willReturn([
					'ref' => 'blah',
				]);

				return new MarshallableWithCustomAttributes(
					$custom,
					'some-string',
				);
			},
			[
				'someString' => 'some-string',
				'$ref' => 'blah',
			],
		];
	}
}
