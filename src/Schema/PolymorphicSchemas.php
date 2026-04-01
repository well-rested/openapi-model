<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Schema;

use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Utils\Marshallable;

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
