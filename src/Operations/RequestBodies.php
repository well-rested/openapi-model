<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

use OpenApiSchema\Utils\Dictionary;
use OpenApiSchema\Reference;
use OpenApiSchema\Utils\Marshallable;

/**
 * @extends Dictionary<RequestBody|Reference>
 */
class RequestBodies extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof RequestBody || $value instanceof Reference;
	}
}
