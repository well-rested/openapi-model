<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Security;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Reference;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<SecurityScheme|Reference>
 */
class SecuritySchemes extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof SecurityScheme || $value instanceof Reference;
	}
}
