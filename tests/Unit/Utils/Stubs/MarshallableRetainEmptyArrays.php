<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

class MarshallableRetainEmptyArrays extends MarshallableBase
{
	protected function omitEmptyArrays(): bool
	{
		return false;
	}
}
