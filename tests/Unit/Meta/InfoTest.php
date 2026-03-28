<?php

declare(strict_types=1);

namespace Tests\Unit\Meta;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Meta\Info;
use OpenApiSchema\Meta\Contact;
use OpenApiSchema\Meta\License;

class InfoTest extends TestCase
{
	public function test_defaults(): void
	{
		$info = new Info();

		$this->assertNull($info->getSummary());
		$this->assertNull($info->getDescription());
		$this->assertNull($info->getTermsOfService());
		$this->assertNull($info->getContact());
		$this->assertNull($info->getLicense());
	}

	public function test_string_setters_and_getters(): void
	{
		$info = new Info();

		$info->setTitle('My API');
		$this->assertEquals('My API', $info->getTitle());

		$info->setVersion('1.0.0');
		$this->assertEquals('1.0.0', $info->getVersion());

		$info->setSummary('A brief summary');
		$this->assertEquals('A brief summary', $info->getSummary());

		$info->setSummary(null);
		$this->assertNull($info->getSummary());

		$info->setDescription('A longer description');
		$this->assertEquals('A longer description', $info->getDescription());

		$info->setDescription(null);
		$this->assertNull($info->getDescription());

		$info->setTermsOfService('https://example.com/tos');
		$this->assertEquals('https://example.com/tos', $info->getTermsOfService());

		$info->setTermsOfService(null);
		$this->assertNull($info->getTermsOfService());
	}

	public function test_contact(): void
	{
		$info = new Info();
		$contact = $this->createStub(Contact::class);

		$info->setContact($contact);
		$this->assertSame($contact, $info->getContact());

		$info->setContact(null);
		$this->assertNull($info->getContact());
	}

	public function test_license(): void
	{
		$info = new Info();
		$license = $this->createStub(License::class);

		$info->setLicense($license);
		$this->assertSame($license, $info->getLicense());

		$info->setLicense(null);
		$this->assertNull($info->getLicense());
	}
}
