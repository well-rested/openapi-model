<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Utils\Marshallable;

/**
 * @extends Collection<Schema>
 */
class PolymorphicSchemas extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Schema;
	}
}
