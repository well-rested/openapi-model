<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Security\SecurityScheme;
use OpenApiSchema\Security\OAuthFlows;
use OpenApiSchema\Security\SecuritySchemeLocation;

class SecuritySchemeTest extends TestCase
{
	public function test_defaults(): void
	{
		$scheme = new SecurityScheme();

		$this->assertNull($scheme->getDescription());
		$this->assertNull($scheme->getType());
		$this->assertNull($scheme->getName());
		$this->assertNull($scheme->getIn());
		$this->assertNull($scheme->getScheme());
		$this->assertNull($scheme->getBearerFormat());
		$this->assertNull($scheme->getOpenIdConnectUrl());
	}

	public function test_string_setters_and_getters(): void
	{
		$scheme = new SecurityScheme();

		$scheme->setDescription('Bearer token authentication');
		$this->assertEquals('Bearer token authentication', $scheme->getDescription());

		$scheme->setDescription(null);
		$this->assertNull($scheme->getDescription());

		$scheme->setType('http');
		$this->assertEquals('http', $scheme->getType());

		$scheme->setType(null);
		$this->assertNull($scheme->getType());

		$scheme->setName('Authorization');
		$this->assertEquals('Authorization', $scheme->getName());

		$scheme->setName(null);
		$this->assertNull($scheme->getName());

		$scheme->setIn(SecuritySchemeLocation::Header);
		$this->assertEquals(SecuritySchemeLocation::Header, $scheme->getIn());

		$scheme->setIn(null);
		$this->assertNull($scheme->getIn());

		$scheme->setScheme('bearer');
		$this->assertEquals('bearer', $scheme->getScheme());

		$scheme->setScheme(null);
		$this->assertNull($scheme->getScheme());

		$scheme->setBearerFormat('JWT');
		$this->assertEquals('JWT', $scheme->getBearerFormat());

		$scheme->setBearerFormat(null);
		$this->assertNull($scheme->getBearerFormat());

		$scheme->setOpenIdConnectUrl('https://example.com/.well-known/openid-configuration');
		$this->assertEquals('https://example.com/.well-known/openid-configuration', $scheme->getOpenIdConnectUrl());

		$scheme->setOpenIdConnectUrl(null);
		$this->assertNull($scheme->getOpenIdConnectUrl());
	}

	public function test_oauth_flows(): void
	{
		$scheme = new SecurityScheme();
		$flows = $this->createStub(OAuthFlows::class);

		$scheme->setOAuthFlows($flows);

		$this->assertSame($flows, $scheme->getOAuthFlows());
	}
}
