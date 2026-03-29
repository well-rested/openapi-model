<?php

declare(strict_types=1);

namespace Tests\Feature\Specs;

use OpenApiSchema\Document;

interface SpecInterface
{
	public function build(): Document;

	public function assertFile(): string;
}
