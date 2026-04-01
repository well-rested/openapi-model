<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\Encoding;
use WellRested\OpenApiModel\Operations\Headers;
use WellRested\OpenApiModel\Operations\Header;

class EncodingTest extends TestCase
{
	public function test_defaults(): void
	{
		$encoding = new Encoding();

		$this->assertNull($encoding->getContentType());
		$this->assertNull($encoding->getStyle());
		$this->assertNull($encoding->getExplode());
		$this->assertFalse($encoding->getAllowReserved());
		$this->assertInstanceOf(Headers::class, $encoding->getHeaders());
		$this->assertTrue($encoding->getHeaders()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$encoding = new Encoding();

		$encoding->setContentType('application/json');
		$this->assertEquals('application/json', $encoding->getContentType());

		$encoding->setStyle('form');
		$this->assertEquals('form', $encoding->getStyle());
	}

	public function test_bool_setters_and_getters(): void
	{
		$encoding = new Encoding();

		$encoding->setExplode(true);
		$this->assertTrue($encoding->getExplode());
		$encoding->setExplode(false);
		$this->assertFalse($encoding->getExplode());

		$encoding->setAllowReserved(true);
		$this->assertTrue($encoding->getAllowReserved());
		$encoding->setAllowReserved(false);
		$this->assertFalse($encoding->getAllowReserved());
	}

	public function test_headers(): void
	{
		$encoding = new Encoding();
		$header = $this->createStub(Header::class);

		$encoding->addHeaders($header);

		$this->assertFalse($encoding->getHeaders()->isEmpty());
	}
}
