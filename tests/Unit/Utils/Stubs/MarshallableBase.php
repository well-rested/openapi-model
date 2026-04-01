<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Utils\ConvertsSelfToMarshallable;

class MarshallableBase
{
	use ConvertsSelfToMarshallable;

	public function __construct(
		protected Collection $someCollection,
		protected array $someArray,
		protected Dictionary $someDict,
		protected ?string $someString,
	) {}
}
