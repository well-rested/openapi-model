<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Meta;

use WellRested\OpenApiModel\Utils\Collection;
use WellRested\OpenApiModel\Utils\Marshallable;

/**
 * @extends Collection<Tag>
 */
class Tags extends Collection implements Marshallable
{
	protected static function isType(mixed $value): bool
	{
		return $value instanceof Tag;
	}
}
