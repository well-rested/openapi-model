<?php

declare(strict_types=1);

namespace Tests\Unit\Utils;

use Generator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use OpenApiSchema\Utils\CustomAttributeDictionary;

class CustomAttributeDictionaryTest extends TestCase
{
	#[DataProvider('scenarios')]
	public function test_allows_any_type(mixed $val): void
	{
		$subject = new CustomAttributeDictionary();

		$subject->add("blah", $val);
		// We just don't wanna throw an exception...
		$this->expectNotToPerformAssertions();
	}

	/**
	 * Could probably do more, but this covers most of it...
	 */
	public static function scenarios(): Generator
	{
		yield "int" => [1234];
		yield "bool" => [true];
		yield "array" => [["some", "array"]];
		yield "object" => [(object) ["someProp" => "object"]];
		yield "string" => ["blah"];
	}
}
