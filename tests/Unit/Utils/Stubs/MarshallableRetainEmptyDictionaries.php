<?php

declare(strict_types=1);

namespace Tests\Unit\Utils\Stubs;

class MarshallableRetainEmptyDictionaries extends MarshallableBase
{
	protected function omitEmptyDictionaries(): bool
	{
		return false;
	}
}
