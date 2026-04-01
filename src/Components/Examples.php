<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Components;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Reference;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<Example|Reference>
 */
class Examples extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Example || $value instanceof Reference;
	}
}
