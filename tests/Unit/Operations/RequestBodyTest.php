<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\RequestBody;
use WellRested\OpenApiModel\Operations\Content;
use WellRested\OpenApiModel\Operations\MediaType;

class RequestBodyTest extends TestCase
{
	public function test_defaults(): void
	{
		$requestBody = new RequestBody();

		$this->assertNull($requestBody->getDescription());
		$this->assertNull($requestBody->getRequired());
		$this->assertInstanceOf(Content::class, $requestBody->getContent());
		$this->assertTrue($requestBody->getContent()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$requestBody = new RequestBody();

		$requestBody->setDescription('The pet to add');
		$this->assertEquals('The pet to add', $requestBody->getDescription());

		$requestBody->setDescription(null);
		$this->assertNull($requestBody->getDescription());
	}

	public function test_bool_setters_and_getters(): void
	{
		$requestBody = new RequestBody();

		$requestBody->setRequired(true);
		$this->assertTrue($requestBody->getRequired());
		$requestBody->setRequired(false);
		$this->assertFalse($requestBody->getRequired());
	}

	public function test_media_type(): void
	{
		$requestBody = new RequestBody();
		$mediaType = $this->createStub(MediaType::class);

		$requestBody->addMediaType('application/json', $mediaType);

		$this->assertFalse($requestBody->getContent()->isEmpty());
		$this->assertSame($mediaType, $requestBody->getContent()->get('application/json'));
	}
}
