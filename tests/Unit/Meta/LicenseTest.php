<?php

declare(strict_types=1);

namespace Tests\Unit\Meta;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Meta\License;

class LicenseTest extends TestCase
{
	public function test_defaults(): void
	{
		$license = new License();

		$this->assertNull($license->getIdentifier());
		$this->assertNull($license->getUrl());
	}

	public function test_string_setters_and_getters(): void
	{
		$license = new License();

		$license->setName('MIT');
		$this->assertEquals('MIT', $license->getName());

		$license->setIdentifier('MIT');
		$this->assertEquals('MIT', $license->getIdentifier());

		$license->setIdentifier(null);
		$this->assertNull($license->getIdentifier());

		$license->setUrl('https://opensource.org/licenses/MIT');
		$this->assertEquals('https://opensource.org/licenses/MIT', $license->getUrl());

		$license->setUrl(null);
		$this->assertNull($license->getUrl());
	}
}
