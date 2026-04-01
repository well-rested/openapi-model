<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Server;

use WellRested\OpenApiModel\Utils\Dictionary;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Dictionary<ServerVariable>
 */
class ServerVariables extends Dictionary implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof ServerVariable;
	}
}
