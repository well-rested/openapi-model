<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Security\SecurityRequirements;
use OpenApiSchema\Utils\Marshallable;

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
