<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Security;

use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Collection<string>
 */
class SecurityRequirement extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return is_string($value);
	}
}
