<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Server;

use WellRested\OpenApiModel\Utils\Marshallable;
use WellRested\OpenApiModel\Utils\Collection;

/**
 * @extends Collection<Server>
 */
class Servers extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Server;
	}
}
