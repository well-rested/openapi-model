<?php

declare(strict_types=1);

namespace Tests\Unit\Spec;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Server\Server;
use WellRested\OpenApiModel\Components\Link;
use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\StringDictionary;
use WellRested\OpenApiModel\Utils\MarshallingContext;
use PHPUnit\Framework\MockObject\MockObject;

class LinkTest extends TestCase
{
	public function test_initialization()
	{
		$link = new Link();
		$this->assertNull($link->getDescription());
		$this->assertNull($link->getOperationRef());
		$this->assertNull($link->getOperationId());
		$this->assertNull($link->getRequestBody());
		$this->assertNull($link->getServer());
		$this->assertEquals(new StringDictionary(), $link->getParameters());

		$this->assertInstanceOf(Marshallable::class, $link);
	}

	public function test_getters_and_setters()
	{
		$link = new Link();
		$link->setDescription('description');
		$link->setOperationRef('op_ref');
		$link->setOperationId('op_id');
		$link->setRequestBody('request_body');
		/** @var Server $server */
		$server = $this->createStub(Server::class);
		$link->setServer($server);
		$link->addParameter('blah', 'meh');

		$this->assertEquals('description', $link->getDescription());
		$this->assertEquals('op_ref', $link->getOperationRef());
		$this->assertEquals('op_id', $link->getOperationId());
		$this->assertEquals('request_body', $link->getRequestBody());
		$this->assertSame($server, $link->getServer());
		$this->assertEquals(
			(new StringDictionary())
				->add('blah', 'meh'),
			$link->getParameters(),
		);

		$newParams = (new StringDictionary())
			->add('key1', 'val1')
			->add('key2', 'val2');

		$link->setParameters($newParams);

		$this->assertEquals($newParams, $link->getParameters());
	}

	public function test_its_marshallable()
	{
		$link = new Link();
		$link->setDescription('description');
		$link->setOperationRef('op_ref');
		$link->setOperationId('op_id');
		$link->setRequestBody('request_body');
		/** @var Server|MockObject $server */
		$server = $this->createMock(Server::class);
		$server->expects($this->once())->method('toMarshallable')->willReturn(['server']);
		$link->setServer($server);
		$link->addParameter('blah', 'meh');

		/** @var MarshallingContext $ctx */
		$ctx = $this->createStub(MarshallingContext::class);

		$this->assertEquals([
			'description' => 'description',
			'operationRef' => 'op_ref',
			'operationId' => 'op_id',
			'requestBody' => 'request_body',
			'server' => ['server'],
			'parameters' => [
				'blah' => 'meh',
			],
		], $link->toMarshallable($ctx));
	}
}
