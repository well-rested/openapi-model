<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Reference;
use OpenApiSchema\Utils\Marshallable;

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
