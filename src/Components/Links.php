<?php

declare(strict_types=1);

namespace OpenApiSchema\Components;

use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Reference;
use OpenApiSchema\Utils\Marshallable;

/**
 * @extends Dictionary<Link|Reference>
 */
class Links extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Link || $value instanceof Reference;
	}
}
