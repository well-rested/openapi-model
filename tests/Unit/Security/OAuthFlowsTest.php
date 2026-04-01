<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Security\OAuthFlows;
use WellRested\OpenApiModel\Security\OAuthFlow;

class OAuthFlowsTest extends TestCase
{
	public function test_defaults(): void
	{
		$flows = new OAuthFlows();

		$this->assertNull($flows->getImplicit());
		$this->assertNull($flows->getPassword());
		$this->assertNull($flows->getClientCredentials());
		$this->assertNull($flows->getAuthorizationCode());
	}

	public function test_flow_setters_and_getters(): void
	{
		$flows = new OAuthFlows();
		$implicit = $this->createStub(OAuthFlow::class);
		$password = $this->createStub(OAuthFlow::class);
		$clientCredentials = $this->createStub(OAuthFlow::class);
		$authorizationCode = $this->createStub(OAuthFlow::class);

		$flows->setImplicit($implicit);
		$this->assertSame($implicit, $flows->getImplicit());

		$flows->setPassword($password);
		$this->assertSame($password, $flows->getPassword());

		$flows->setClientCredentials($clientCredentials);
		$this->assertSame($clientCredentials, $flows->getClientCredentials());

		$flows->setAuthorizationCode($authorizationCode);
		$this->assertSame($authorizationCode, $flows->getAuthorizationCode());
	}
}
