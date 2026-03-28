<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Operations\PathItem;
use OpenApiSchema\Operations\Operation;
use OpenApiSchema\Operations\Parameter;
use OpenApiSchema\Operations\Parameters;
use OpenApiSchema\Server\Server;
use OpenApiSchema\Server\Servers;

class PathItemTest extends TestCase
{
	public function test_defaults(): void
	{
		$pathItem = new PathItem();

		$this->assertNull($pathItem->getRef());
		$this->assertNull($pathItem->getSummary());
		$this->assertNull($pathItem->getDescription());
		$this->assertNull($pathItem->getGet());
		$this->assertNull($pathItem->getPut());
		$this->assertNull($pathItem->getPost());
		$this->assertNull($pathItem->getDelete());
		$this->assertNull($pathItem->getOptions());
		$this->assertNull($pathItem->getHead());
		$this->assertNull($pathItem->getPatch());
		$this->assertNull($pathItem->getTrace());
		$this->assertInstanceOf(Servers::class, $pathItem->getServers());
		$this->assertTrue($pathItem->getServers()->isEmpty());
		$this->assertInstanceOf(Parameters::class, $pathItem->getParameters());
		$this->assertTrue($pathItem->getParameters()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$pathItem = new PathItem();

		$pathItem->setRef('#/components/pathItems/pets');
		$this->assertEquals('#/components/pathItems/pets', $pathItem->getRef());

		$pathItem->setRef(null);
		$this->assertNull($pathItem->getRef());

		$pathItem->setSummary('Pets operations');
		$this->assertEquals('Pets operations', $pathItem->getSummary());

		$pathItem->setSummary(null);
		$this->assertNull($pathItem->getSummary());

		$pathItem->setDescription('Operations for managing pets');
		$this->assertEquals('Operations for managing pets', $pathItem->getDescription());

		$pathItem->setDescription(null);
		$this->assertNull($pathItem->getDescription());
	}

	public function test_http_method_setters_and_getters(): void
	{
		$pathItem = new PathItem();
		$operation = $this->createStub(Operation::class);

		$pathItem->setGet($operation);
		$this->assertSame($operation, $pathItem->getGet());

		$pathItem->setPut($operation);
		$this->assertSame($operation, $pathItem->getPut());

		$pathItem->setPost($operation);
		$this->assertSame($operation, $pathItem->getPost());

		$pathItem->setDelete($operation);
		$this->assertSame($operation, $pathItem->getDelete());

		$pathItem->setOptions($operation);
		$this->assertSame($operation, $pathItem->getOptions());

		$pathItem->setHead($operation);
		$this->assertSame($operation, $pathItem->getHead());

		$pathItem->setPatch($operation);
		$this->assertSame($operation, $pathItem->getPatch());

		$pathItem->setTrace($operation);
		$this->assertSame($operation, $pathItem->getTrace());
	}

	public function test_http_methods_nullable(): void
	{
		$pathItem = new PathItem();
		$operation = $this->createStub(Operation::class);

		$pathItem->setGet($operation);
		$pathItem->setGet(null);
		$this->assertNull($pathItem->getGet());
	}

	public function test_servers(): void
	{
		$pathItem = new PathItem();
		$server = $this->createStub(Server::class);

		$pathItem->addServer($server);

		$this->assertFalse($pathItem->getServers()->isEmpty());
	}

	public function test_parameters(): void
	{
		$pathItem = new PathItem();
		$parameter = $this->createStub(Parameter::class);

		$pathItem->addParameters($parameter);

		$this->assertFalse($pathItem->getParameters()->isEmpty());
	}
}
