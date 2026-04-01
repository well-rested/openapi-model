<?php

declare(strict_types=1);

namespace Tests\Feature\Specs;

use WellRested\OpenApiModel as OA;

class VeryBasic implements SpecInterface
{
	public function build(): OA\Document
	{
		$doc = new OA\Document();
		$doc->setOpenapi('3.1.0')
			->setInfo(
				(new OA\Meta\Info())
					->setTitle("Example API")
					->setDescription("An example API using the WellRested\OpenApiModel components")
					->setVersion("1.0.0")
					->setSummary("A very basic API"),
			)
			->addServers(
				(new OA\Server\Server())->setUrl("/api/v1"),
			)
			->addPathItem(
				"/v1/resource/{id}",
				(new OA\Operations\PathItem())
					->setPut(
						(new OA\Operations\Operation())
							->setSummary("Update a resource")
							->setDescription("Update a resource by Id.")
							->addParameters(
								(new OA\Operations\Parameter())
									->setName("id")
									->setRequired(true)
									->setIn(OA\Operations\ParameterLocation::Path)
									->setSchema(
										(new OA\Schema\Schema())->setType("integer"),
									),
							)
							->addResponse(
								"200",
								(new OA\Operations\Response())
									->setDescription("Successful operation")
									->addMediaType(
										"application/json",
										(new OA\Operations\MediaType())
											->setSchema(
												(new OA\Schema\Schema())
													->addProperty(
														"id",
														(new OA\Schema\Schema())->setType("integer"),
													)
													->addProperty(
														"name",
														(new OA\Schema\Schema())->setType("string"),
													),
											),
									),
							)
							->addResponse("404", (new OA\Operations\Response())->setDescription("resource not found"))
							->setRequestBody(
								(new OA\Operations\RequestBody())
									->setRequired(true)
									->setDescription("Resource data structure")
									->addMediaType(
										"application/json",
										(new OA\Operations\MediaType())
											->setSchema(
												(new OA\Schema\Schema())
													->addProperty(
														"name",
														(new OA\Schema\Schema())->setType("string"),
													),
											),
									),
							),
					),
			);

		return $doc;
	}

	public function assertFile(): string
	{
		return __DIR__ . '/examples/very_basic.json';
	}
}
