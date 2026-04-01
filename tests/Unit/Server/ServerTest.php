<?php

declare(strict_types=1);

namespace Tests\Unit\Server;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Server\Server;
use WellRested\OpenApiModel\Server\ServerVariable;
use WellRested\OpenApiModel\Server\ServerVariables;

class ServerTest extends TestCase
{
	public function test_defaults(): void
	{
		$server = new Server();

		$this->assertNull($server->getDescription());
		$this->assertInstanceOf(ServerVariables::class, $server->getVariables());
		$this->assertTrue($server->getVariables()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$server = new Server();

		$server->setUrl('https://api.example.com/v1');
		$this->assertEquals('https://api.example.com/v1', $server->getUrl());

		$server->setDescription('Production server');
		$this->assertEquals('Production server', $server->getDescription());

		$server->setDescription(null);
		$this->assertNull($server->getDescription());
	}

	public function test_variables(): void
	{
		$server = new Server();
		$variable = $this->createStub(ServerVariable::class);

		$server->addVariable('port', $variable);

		$this->assertFalse($server->getVariables()->isEmpty());
		$this->assertSame($variable, $server->getVariables()->get('port'));
	}
}
