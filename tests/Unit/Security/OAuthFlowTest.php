<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Security\OAuthFlow;
use OpenApiSchema\Utils\StringDictionary;

class OAuthFlowTest extends TestCase
{
	public function test_defaults(): void
	{
		$flow = new OAuthFlow();

		$this->assertNull($flow->getAuthorizationUrl());
		$this->assertNull($flow->getTokenUrl());
		$this->assertNull($flow->getRefreshUrl());
		$this->assertInstanceOf(StringDictionary::class, $flow->getScopes());
		$this->assertTrue($flow->getScopes()->isEmpty());
	}

	public function test_string_setters_and_getters(): void
	{
		$flow = new OAuthFlow();

		$flow->setAuthorizationUrl('https://example.com/oauth/authorize');
		$this->assertEquals('https://example.com/oauth/authorize', $flow->getAuthorizationUrl());

		$flow->setTokenUrl('https://example.com/oauth/token');
		$this->assertEquals('https://example.com/oauth/token', $flow->getTokenUrl());

		$flow->setRefreshUrl('https://example.com/oauth/refresh');
		$this->assertEquals('https://example.com/oauth/refresh', $flow->getRefreshUrl());
	}

	public function test_scopes(): void
	{
		$flow = new OAuthFlow();

		$flow->addScope('read:pets', 'Read access to pets');
		$flow->addScope('write:pets', 'Write access to pets');

		$this->assertFalse($flow->getScopes()->isEmpty());
		$this->assertEquals('Read access to pets', $flow->getScopes()->get('read:pets'));
		$this->assertEquals('Write access to pets', $flow->getScopes()->get('write:pets'));
	}
}
