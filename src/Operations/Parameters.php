<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Reference;
use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Utils\Marshallable;

/**
 * @extends Collection<Parameter|Reference>
 */
class Parameters extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Parameter || $value instanceof Reference;
	}
}
