<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

use WellRested\OpenApiModel\Utils\CustomAttributeDictionary;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class MarshallableWithCustomAttributes
{
	use ConvertsSelfToMarshallable;

	public function __construct(
		protected CustomAttributeDictionary $customAttributes,
		protected ?string $someString,
	) {}
}
