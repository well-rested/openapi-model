<?php

declare(strict_types=1);

namespace Tests\Unit\Server;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Server\ServerVariable;

class ServerVariableTest extends TestCase
{
	public function test_defaults(): void
	{
		$variable = new ServerVariable();

		$this->assertNull($variable->getDescription());
	}

	public function test_string_setters_and_getters(): void
	{
		$variable = new ServerVariable();

		$variable->setDefault('8080');
		$this->assertEquals('8080', $variable->getDefault());

		$variable->setDescription('The port number');
		$this->assertEquals('The port number', $variable->getDescription());

		$variable->setDescription(null);
		$this->assertNull($variable->getDescription());
	}

	public function test_enum(): void
	{
		$variable = new ServerVariable();

		$variable->setEnum(['8080', '443', '3000']);
		$this->assertEquals(['8080', '443', '3000'], $variable->getEnum());
	}
}
