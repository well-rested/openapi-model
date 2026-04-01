<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\Response;
use WellRested\OpenApiModel\Operations\Headers;
use WellRested\OpenApiModel\Operations\Header;
use WellRested\OpenApiModel\Operations\Content;
use WellRested\OpenApiModel\Operations\MediaType;

class ResponseTest extends TestCase
{
	public function test_defaults(): void
	{
		$response = new Response();

		$this->assertEquals('', $response->getDescription());
		$this->assertInstanceOf(Headers::class, $response->getHeaders());
		$this->assertTrue($response->getHeaders()->isEmpty());
		$this->assertInstanceOf(Content::class, $response->getContent());
		$this->assertTrue($response->getContent()->isEmpty());
	}

	public function test_description(): void
	{
		$response = new Response();

		$response->setDescription('A list of pets');
		$this->assertEquals('A list of pets', $response->getDescription());
	}

	public function test_headers(): void
	{
		$response = new Response();
		$header = $this->createStub(Header::class);

		$response->addHeaders($header);

		$this->assertFalse($response->getHeaders()->isEmpty());
	}

	public function test_media_type(): void
	{
		$response = new Response();
		$mediaType = $this->createStub(MediaType::class);

		$response->addMediaType('application/json', $mediaType);

		$this->assertFalse($response->getContent()->isEmpty());
		$this->assertSame($mediaType, $response->getContent()->get('application/json'));
	}
}
