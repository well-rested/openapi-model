<?php

declare(strict_types=1);

namespace OpenApiSchema\Operations;

enum ParameterLocation: string
{
	case Query = 'query';
	case Path = 'path';
	case Cookie = 'cookie';
	case Header = 'header';
}
