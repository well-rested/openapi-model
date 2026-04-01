<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Components;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Reference;
use WellRested\OpenApiModel\Utils\Marshallable;

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
