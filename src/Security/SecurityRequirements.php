<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Security;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<SecurityRequirement>
 */
class SecurityRequirements extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof SecurityRequirement;
	}
}
