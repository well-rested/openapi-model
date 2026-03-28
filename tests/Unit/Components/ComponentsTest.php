<?php

declare(strict_types=1);

namespace Tests\Unit\Components;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Components\Components;
use OpenApiSchema\Components\Examples;
use OpenApiSchema\Components\Example;
use OpenApiSchema\Components\Links;
use OpenApiSchema\Components\Link;
use OpenApiSchema\Operations\Headers;
use OpenApiSchema\Operations\Header;
use OpenApiSchema\Operations\Parameters;
use OpenApiSchema\Operations\Parameter;
use OpenApiSchema\Operations\PathItems;
use OpenApiSchema\Operations\PathItem;
use OpenApiSchema\Operations\RequestBodies;
use OpenApiSchema\Operations\RequestBody;
use OpenApiSchema\Operations\Response;
use OpenApiSchema\Operations\Responses;
use OpenApiSchema\Operations\Schema;
use OpenApiSchema\Operations\Schemas;
use OpenApiSchema\Security\SecurityScheme;
use OpenApiSchema\Security\SecuritySchemes;

class ComponentsTest extends TestCase
{
	public function test_defaults(): void
	{
		$components = new Components();

		$this->assertInstanceOf(Responses::class, $components->getResponses());
		$this->assertTrue($components->getResponses()->isEmpty());

		$this->assertInstanceOf(Parameters::class, $components->getParameters());
		$this->assertTrue($components->getParameters()->isEmpty());

		$this->assertInstanceOf(Schemas::class, $components->getSchemas());
		$this->assertTrue($components->getSchemas()->isEmpty());

		$this->assertInstanceOf(Headers::class, $components->getHeaders());
		$this->assertTrue($components->getHeaders()->isEmpty());

		$this->assertInstanceOf(RequestBodies::class, $components->getRequestBodies());
		$this->assertTrue($components->getRequestBodies()->isEmpty());

		$this->assertInstanceOf(PathItems::class, $components->getPathItems());
		$this->assertTrue($components->getPathItems()->isEmpty());

		$this->assertInstanceOf(Examples::class, $components->getExamples());
		$this->assertTrue($components->getExamples()->isEmpty());

		$this->assertInstanceOf(Links::class, $components->getLinks());
		$this->assertTrue($components->getLinks()->isEmpty());

		$this->assertInstanceOf(SecuritySchemes::class, $components->getSecuritySchemes());
		$this->assertTrue($components->getSecuritySchemes()->isEmpty());
	}

	public function test_responses(): void
	{
		$components = new Components();
		$response = $this->createStub(Response::class);

		$components->addResponse('200', $response);

		$this->assertFalse($components->getResponses()->isEmpty());
		$this->assertSame($response, $components->getResponses()->get('200'));
	}

	public function test_parameters(): void
	{
		$components = new Components();
		$parameter = $this->createStub(Parameter::class);

		$components->addParameter($parameter);

		$this->assertFalse($components->getParameters()->isEmpty());
	}

	public function test_schemas(): void
	{
		$components = new Components();
		$schema = $this->createStub(Schema::class);

		$components->addSchema('Pet', $schema);

		$this->assertFalse($components->getSchemas()->isEmpty());
		$this->assertSame($schema, $components->getSchemas()->get('Pet'));
	}

	public function test_headers(): void
	{
		$components = new Components();
		$header = $this->createStub(Header::class);

		$components->addHeader($header);

		$this->assertFalse($components->getHeaders()->isEmpty());
	}

	public function test_request_bodies(): void
	{
		$components = new Components();
		$requestBody = $this->createStub(RequestBody::class);

		$components->addRequestBody('CreatePet', $requestBody);

		$this->assertFalse($components->getRequestBodies()->isEmpty());
		$this->assertSame($requestBody, $components->getRequestBodies()->get('CreatePet'));
	}

	public function test_path_items(): void
	{
		$components = new Components();
		$pathItem = $this->createStub(PathItem::class);

		$components->addPathItem('/pets', $pathItem);

		$this->assertFalse($components->getPathItems()->isEmpty());
		$this->assertSame($pathItem, $components->getPathItems()->get('/pets'));
	}

	public function test_examples(): void
	{
		$components = new Components();
		$example = $this->createStub(Example::class);

		$components->addExample('frog-example', $example);

		$this->assertFalse($components->getExamples()->isEmpty());
		$this->assertSame($example, $components->getExamples()->get('frog-example'));
	}

	public function test_links(): void
	{
		$components = new Components();
		$link = $this->createStub(Link::class);

		$components->addLink('GetUserByUserId', $link);

		$this->assertFalse($components->getLinks()->isEmpty());
		$this->assertSame($link, $components->getLinks()->get('GetUserByUserId'));
	}

	public function test_security_schemes(): void
	{
		$components = new Components();
		$scheme = $this->createStub(SecurityScheme::class);

		$components->addSecurityScheme('bearerAuth', $scheme);

		$this->assertFalse($components->getSecuritySchemes()->isEmpty());
		$this->assertSame($scheme, $components->getSecuritySchemes()->get('bearerAuth'));
	}
}
