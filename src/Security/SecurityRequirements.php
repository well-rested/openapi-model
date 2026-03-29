<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Utils\Marshallable;

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
