<?php

declare(strict_types=1);

namespace WellRested\OpenApiModel\Security;

enum SecuritySchemeLocation: string
{
	case Query = 'query';
	case Cookie = 'cookie';
	case Header = 'header';
}
