<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Operations;

use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Security\SecurityRequirements;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Collection<SecurityRequirements>
 */
class Security extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof SecurityRequirements;
	}
}
