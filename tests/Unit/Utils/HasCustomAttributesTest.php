<?php

declare(strict_types=1);

namespace Tests\Unit\Utils;

use PHPUnit\Framework\TestCase;
use OpenApiSchema\Utils\CustomAttributeDictionary;
use Tests\Unit\Utils\Stubs\HasCustomAttributesStub;

class HasCustomAttributesTest extends TestCase
{
	public function test_when_none_are_set_its_null(): void
	{
		$subject = new HasCustomAttributesStub();

		$this->assertNull($subject->getCustomAttributes());
	}

	public function test_attributes_can_be_added(): void
	{
		$subject = new HasCustomAttributesStub();

		$subject->addCustomAttribute("custom", "attribute");
		$subject->addCustomAttribute("other", "value");

		$this->assertEquals(
			(new CustomAttributeDictionary())->add("custom", "attribute")->add('other', 'value'),
			$subject->getCustomAttributes(),
		);
	}
}
