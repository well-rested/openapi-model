<?php

declare(strict_types=1);

namespace Tests\Unit\Meta;

use PHPUnit\Framework\TestCase;
use WellRested\OpenApiModel\Meta\Contact;

class ContactTest extends TestCase
{
	public function test_defaults(): void
	{
		$contact = new Contact();

		$this->assertNull($contact->getName());
		$this->assertNull($contact->getUrl());
		$this->assertNull($contact->getEmail());
	}

	public function test_string_setters_and_getters(): void
	{
		$contact = new Contact();

		$contact->setName('Jane Doe');
		$this->assertEquals('Jane Doe', $contact->getName());

		$contact->setName(null);
		$this->assertNull($contact->getName());

		$contact->setUrl('https://example.com');
		$this->assertEquals('https://example.com', $contact->getUrl());

		$contact->setUrl(null);
		$this->assertNull($contact->getUrl());

		$contact->setEmail('jane@example.com');
		$this->assertEquals('jane@example.com', $contact->getEmail());

		$contact->setEmail(null);
		$this->assertNull($contact->getEmail());
	}
}
