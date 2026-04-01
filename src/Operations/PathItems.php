<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<PathItem>
 */
class PathItems extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof PathItem;
	}
}
