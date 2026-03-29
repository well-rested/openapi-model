<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Utils\ConvertsSelfToMarshallable;

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
