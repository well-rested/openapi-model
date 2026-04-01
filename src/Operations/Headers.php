<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Reference;
use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Collection<Header|Reference>
 */
class Headers extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Header || $value instanceof Reference;
	}
}
