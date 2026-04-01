<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Utils;

/**
 * @extends Dictionary<mixed>
 */
class CustomAttributeDictionary extends Dictionary
{
	protected static function isType(mixed $value): bool
	{
		return true;
	}
}
