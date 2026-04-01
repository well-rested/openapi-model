<?php

declare(strict_types=1);

namespace Tests\Unit\Operations;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Operations\Operation;
use WellRested\OpenApiModel\Operations\Parameter;
use WellRested\OpenApiModel\Operations\Parameters;
use WellRested\OpenApiModel\Operations\RequestBody;
use WellRested\OpenApiModel\Operations\Response;
use WellRested\OpenApiModel\Operations\Responses;
use WellRested\OpenApiModel\Operations\PathItem;
use WellRested\OpenApiModel\Operations\PathItems;
use WellRested\OpenApiModel\Operations\Security;
use WellRested\OpenApiModel\Server\Server;
use WellRested\OpenApiModel\Server\Servers;
use WellRested\OpenApiModel\Meta\ExternalDocumentation;
use WellRested\OpenApiModel\Security\SecurityRequirements;

class OperationTest extends TestCase
{
	public function test_defaults(): void
	{
		$operation = new Operation();

		$this->assertNull($operation->getSummary());
		$this->assertNull($operation->getDescription());
		$this->assertNull($operation->getExternalDocs());
		$this->assertNull($operation->getOperationId());
		$this->assertNull($operation->getRequestBody());
		$this->assertNull($operation->getDeprecated());
		$this->assertEquals([], $operation->getTags());
		$this->assertInstanceOf(Parameters::class, $operation->getParameters());
		$this->assertTrue($operation->getParameters()->isEmpty());
		$this->assertInstanceOf(Responses::class, $operation->getResponses());
		$this->assertTrue($operation->getResponses()->isEmpty());
		$this->assertInstanceOf(PathItems::class, $operation->getCallbacks());
		$this->assertTrue($operation->getCallbacks()->isEmpty());
		$this->assertInstanceOf(Security::class, $operation->getSecurity());
		$this->assertTrue($operation->getSecurity()->isEmpty());
		$this->assertInstanceOf(Servers::class, $operation->getServers());
		$this->assertTrue($operation->getServers()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$operation = new Operation();

		$operation->setSummary('List all pets');
		$this->assertEquals('List all pets', $operation->getSummary());

		$operation->setSummary(null);
		$this->assertNull($operation->getSummary());

		$operation->setDescription('Returns a list of pets');
		$this->assertEquals('Returns a list of pets', $operation->getDescription());

		$operation->setDescription(null);
		$this->assertNull($operation->getDescription());

		$operation->setOperationId('listPets');
		$this->assertEquals('listPets', $operation->getOperationId());

		$operation->setOperationId(null);
		$this->assertNull($operation->getOperationId());
	}

	public function test_bool_setters_and_getters(): void
	{
		$operation = new Operation();

		$operation->setDeprecated(true);
		$this->assertTrue($operation->getDeprecated());
		$operation->setDeprecated(false);
		$this->assertFalse($operation->getDeprecated());
		$operation->setDeprecated(null);
		$this->assertNull($operation->getDeprecated());
	}

	public function test_external_docs(): void
	{
		$operation = new Operation();
		$docs = $this->createStub(ExternalDocumentation::class);

		$operation->setExternalDocs($docs);

		$this->assertSame($docs, $operation->getExternalDocs());

		$operation->setExternalDocs(null);
		$this->assertNull($operation->getExternalDocs());
	}

	public function test_request_body(): void
	{
		$operation = new Operation();
		$requestBody = $this->createStub(RequestBody::class);

		$operation->setRequestBody($requestBody);

		$this->assertSame($requestBody, $operation->getRequestBody());

		$operation->setRequestBody(null);
		$this->assertNull($operation->getRequestBody());
	}

	public function test_tags(): void
	{
		$operation = new Operation();

		$operation->addTag('pets');
		$operation->addTag('store');

		$this->assertEquals(['pets', 'store'], $operation->getTags());
	}

	public function test_parameters(): void
	{
		$operation = new Operation();
		$parameter = $this->createStub(Parameter::class);

		$operation->addParameters($parameter);

		$this->assertFalse($operation->getParameters()->isEmpty());
	}

	public function test_responses(): void
	{
		$operation = new Operation();
		$response = $this->createStub(Response::class);

		$operation->addResponse('200', $response);

		$this->assertFalse($operation->getResponses()->isEmpty());
		$this->assertSame($response, $operation->getResponses()->get('200'));
	}

	public function test_callbacks(): void
	{
		$operation = new Operation();
		$pathItem = $this->createStub(PathItem::class);

		$operation->addCallback('{$url}', $pathItem);

		$this->assertFalse($operation->getCallbacks()->isEmpty());
	}

	public function test_security(): void
	{
		$operation = new Operation();
		$requirement = $this->createStub(SecurityRequirements::class);

		$operation->addSecurityRequirement($requirement);

		$this->assertFalse($operation->getSecurity()->isEmpty());
	}

	public function test_servers(): void
	{
		$operation = new Operation();
		$server = $this->createStub(Server::class);

		$operation->addServers($server);

		$this->assertFalse($operation->getServers()->isEmpty());
	}
}
