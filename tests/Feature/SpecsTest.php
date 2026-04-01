<?php

declare(strict_types=1);

namespace Tests\Feature;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Specs\SpecInterface;
use Tests\Feature\Specs as Specs;
use WellRested\OpenApiModel as OA;

/**
 * Most of the specs have come from https://github.com/readmeio/oas at v 5.16.1
 *
 * UserGuide, and VeryBasic, were written manually so have no external source.
 */
class SpecsTest extends TestCase
{
	#[DataProvider('specs')]
	public function test_spec(SpecInterface $spec)
	{
		$this->assertJsonStringEqualsJsonFile(
			$spec->assertFile(),
			$spec->build()->toJson(new OA\Utils\MarshallingContext()),
		);
	}

	public static function specs(): Generator
	{
		yield 'very_basic' => [new Specs\VeryBasic()];
		yield 'user_guide' => [new Specs\UserGuide()];
		yield 'pet_store:3.1' => [new Specs\PetStore3_1()];
		yield 'pet_store:3.1:readme_extensions' => [new Specs\PetStore3_1ReadMeExtensions()];
		yield 'pet_store:3.0' => [new Specs\PetStore3_0()];
	}
}
