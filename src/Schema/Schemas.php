<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Schema;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<Schema>
 */
class Schemas extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Schema;
	}
}
