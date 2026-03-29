<?php

declare(strict_types=1);

namespace OpenApiSchema\Security;

use OpenApiSchema\Utils\Collection;
use OpenApiSchema\Utils\Marshallable;

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
