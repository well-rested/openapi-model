<?php

declare(strict_types=1);

namespace Tests\Unit\Spec;

use stdClass;
use WellRested\OpenApiModel\Document;
use WellRested\OpenApiModel\Meta\Tag;
use WellRested\OpenApiModel\Meta\Info;
use WellRested\OpenApiModel\Meta\Tags;
use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Server\Server;
use WellRested\OpenApiModel\Server\Servers;
use WellRested\OpenApiModel\Operations\PathItem;
use WellRested\OpenApiModel\Operations\PathItems;
use WellRested\OpenApiModel\Components\Components;
use WellRested\OpenApiModel\Utils\MarshallingContext;
use WellRested\OpenApiModel\Meta\ExternalDocumentation;
use WellRested\OpenApiModel\Security\SecurityRequirement;
use WellRested\OpenApiModel\Security\SecurityRequirements;

class DocumentTest extends TestCase
{
	public function test_nothing_is_set(): void
	{
		/** @var MarshallingContext */
		$ctx = $this->createStub(MarshallingContext::class);
		$doc = new Document();

		$this->assertEqualsCanonicalizing(
			json_encode(["components" => new stdClass()], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
			$doc->toJson($ctx),
		);
	}

	public function test_getters_and_setters(): void
	{
		$doc = new Document();

		// Openapi
		$this->assertEquals(null, $doc->getOpenapi());
		$doc->setOpenapi('3.0.0');
		$this->assertEquals('3.0.0', $doc->getOpenapi());

		// Info
		$this->assertEquals(null, $doc->getInfo());
		/** @var Info $info */
		$info = $this->createStub(Info::class);
		$doc->setInfo($info);
		$this->assertSame($info, $doc->getInfo());

		// JsonSchemaDialect
		$this->assertEquals(null, $doc->getJsonSchemaDialect());
		$doc->setJsonSchemaDialect('blah');
		$this->assertSame('blah', $doc->getJsonSchemaDialect());

		// Servers
		$this->assertTrue($doc->getServers()->isEmpty());
		/** @var Server $server1 */
		$server1 = $this->createStub(Server::class);
		/** @var Server $server2 */
		$server2 = $this->createStub(Server::class);
		/** @var Servers $servers */
		$servers = $this->createStub(Servers::class);
		$doc->addServers($server1, $server2);
		$this->assertEquals((new Servers())->add($server1, $server2), $doc->getServers());
		$doc->setServers($servers);
		$this->assertSame($servers, $doc->getServers());

		// Paths
		$this->assertTrue($doc->getPathItems()->isEmpty());
		/** @var PathItem $pathItem1 */
		$pathItem1 = $this->createStub(PathItem::class);
		/** @var PathItem $pathItem2 */
		$pathItem2 = $this->createStub(PathItem::class);
		/** @var PathItems $pathItems */
		$pathItems = $this->createStub(PathItems::class);
		$doc->addPathItem('path_1', $pathItem1);
		$doc->addPathItem('path_2', $pathItem2);
		$this->assertEquals(
			(new PathItems())
				->add('path_1', $pathItem1)
				->add('path_2', $pathItem2),
			$doc->getPathItems(),
		);
		$doc->setPathItems($pathItems);
		$this->assertSame($pathItems, $doc->getPathItems());

		// Components
		$this->assertInstanceOf(Components::class, $doc->getComponents());
		/** @var Components $components */
		$components = $this->createStub(Components::class);
		$this->assertNotSame($components, $doc->getComponents());
		$doc->setComponents($components);
		$this->assertSame($components, $doc->getComponents());

		// Webhooks
		$this->assertTrue($doc->getWebhooks()->isEmpty());
		/** @var PathItem $webhook1 */
		$webhook1 = $this->createStub(PathItem::class);
		/** @var PathItem $webhook2 */
		$webhook2 = $this->createStub(PathItem::class);
		/** @var PathItems $webhooks */
		$webhooks = $this->createStub(PathItems::class);
		$doc->addWebhook("webhook_1", $webhook1);
		$doc->addWebhook("webhook_2", $webhook2);
		$this->assertEquals(
			(new PathItems())
				->add('webhook_1', $webhook1)
				->add('webhook_2', $webhook2),
			$doc->getWebhooks(),
		);
		$doc->setWebhooks($webhooks);
		$this->assertSame($webhooks, $doc->getWebhooks());

		// Security
		$this->assertTrue($doc->getSecurityRequirements()->isEmpty());
		/** @var SecurityRequirement $secReq1 */
		$secReq1 = $this->createStub(SecurityRequirement::class);
		/** @var SecurityRequirement $secReq2 */
		$secReq2 = $this->createStub(SecurityRequirement::class);
		/** @var SecurityRequirements $secReqs */
		$secReqs = $this->createStub(SecurityRequirements::class);
		$doc->addSecurityRequirement('req_1', $secReq1);
		$doc->addSecurityRequirement('req_2', $secReq2);
		$this->assertEquals(
			(new SecurityRequirements())
				->add('req_1', $secReq1)
				->add('req_2', $secReq2),
			$doc->getSecurityRequirements(),
		);

		$doc->setSecurityRequirements($secReqs);
		$this->assertSame($secReqs, $doc->getSecurityRequirements());

		// Tags
		$this->assertTrue($doc->getTags()->isEmpty());
		/** @var Tag $tag1 */
		$tag1 = $this->createStub(Tag::class);
		/** @var Tag $tag2 */
		$tag2 = $this->createStub(Tag::class);
		/** @var Tags $tags */
		$tags = $this->createStub(Tags::class);
		$doc->addTags($tag1, $tag2);
		$this->assertEquals(
			(new Tags())->add($tag1, $tag2),
			$doc->getTags(),
		);
		$doc->setTags($tags);
		$this->assertSame($tags, $doc->getTags());

		// External docs
		$this->assertNull($doc->getExternalDocs());
		/** @var ExternalDocumentation $extDoc */
		$extDoc = $this->createStub(ExternalDocumentation::class);
		$doc->setExternalDocs($extDoc);
		$this->assertSame($extDoc, $doc->getExternalDocs());
		$doc->setExternalDocs(null);
		$this->assertNull($doc->getExternalDocs());
	}

	public function test_to_json_when_everything_is_set(): void
	{
		$ctx = $this->createStub(MarshallingContext::class);

		$info = $this->createStub(Info::class);
		$info->method('toMarshallable')->willReturn([
			'component' => 'info',
		]);

		$server1 = $this->createStub(Server::class);
		$server1->method('toMarshallable')->willReturn(['server' => '1']);

		$server2 = $this->createStub(Server::class);
		$server2->method('toMarshallable')->willReturn(['server' => '2']);

		$pathItem1 = $this->createStub(PathItem::class);
		$pathItem1->method('toMarshallable')->willReturn(['pathItem' => '1']);

		$pathItem2 = $this->createStub(PathItem::class);
		$pathItem2->method('toMarshallable')->willReturn(['pathItem' => '2']);

		$components = $this->createStub(Components::class);
		$components->method('toMarshallable')->willReturn(['component' => 'components']);

		$secRequirement1 = $this->createStub(SecurityRequirement::class);
		$secRequirement1->method('toMarshallable')->willReturn(['secreq' => '1']);

		$secRequirement2 = $this->createStub(SecurityRequirement::class);
		$secRequirement2->method('toMarshallable')->willReturn(['secreq' => '2']);

		$tag1 = $this->createStub(Tag::class);
		$tag1->method('toMarshallable')->willReturn(['tag' => '1']);

		$tag2 = $this->createStub(Tag::class);
		$tag2->method('toMarshallable')->willReturn(['tag' => '2']);

		$extDoc = $this->createStub(ExternalDocumentation::class);
		$extDoc->method('toMarshallable')->willReturn(['component' => 'extdoc']);

		$webhook1 = $this->createStub(PathItem::class);
		$webhook1->method('toMarshallable')->willReturn(['webhook' => '1']);

		$webhook2 = $this->createStub(PathItem::class);
		$webhook2->method('toMarshallable')->willReturn(['webhook' => '2']);

		$doc = new Document();
		$doc->setOpenapi("3.0.0")
			->setInfo($info)
			->setJsonSchemaDialect("some/dialect")
			->addServers($server1, $server2)
			->addPathItem('path_1', $pathItem1)
			->addPathItem('path_2', $pathItem2)
			->setComponents($components)
			->addSecurityRequirement('req_1', $secRequirement1)
			->addSecurityRequirement('req_2', $secRequirement2)
			->addTags($tag1, $tag2)
			->setExternalDocs($extDoc)
			->addWebhook('webhook_1', $webhook1)
			->addWebhook('webhook_2', $webhook2)
			->addCustomAttribute('some-custom-key', ['some', 'values'])
			->addCustomAttribute('other-custom-key', 'some-string');

		$this->assertEquals(
			json_encode([
				'openapi' => '3.0.0',
				'info' => [
					'component' => 'info',
				],
				'jsonSchemaDialect' => 'some/dialect',
				'externalDocs' => [
					'component' => 'extdoc',
				],
				'servers' => [
					['server' => '1'],
					['server' => '2'],
				],
				'paths' => [
					'path_1' => ['pathItem' => '1'],
					'path_2' => ['pathItem' => '2'],
				],
				'components' => [
					'component' => 'components',
				],
				'webhooks' => [
					'webhook_1' => [
						'webhook' => '1',
					],
					'webhook_2' => [
						'webhook' => '2',
					],
				],
				'security' => [
					'req_1' => ['secreq' => '1'],
					'req_2' => ['secreq' => '2'],
				],
				'tags' => [
					['tag' => '1'],
					['tag' => '2'],
				],
				'some-custom-key' => ['some', 'values'],
				'other-custom-key' => 'some-string',
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
			$doc->toJson($ctx),
		);
	}
}
