<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

use WellRested\OpenApiModel\Utils\HasCustomAttributes;
use WellRested\OpenApiModel\Utils\CustomAttributeDictionary;

class HasCustomAttributesStub
{
	use HasCustomAttributes;

	/**
	 * Just return the value so we can verify the behaviour of the trait...
	 */
	public function getCustomAttributes(): ?CustomAttributeDictionary
	{
		return $this->customAttributes;
	}
}
