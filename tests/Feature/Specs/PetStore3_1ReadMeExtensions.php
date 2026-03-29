<?php

declare(strict_types=1);

namespace Tests\Feature\Specs;

use OpenApiSchema as OA;

class PetStore3_1ReadMeExtensions implements SpecInterface
{
	public function build(): OA\Document
	{
		$doc = new OA\Document();
		$doc->setOpenapi('3.1.0')
			->setInfo(
				(new OA\Meta\Info())
					->setDescription("https://docs.readme.com/docs/openapi-extensions")
					->setVersion("1.0.0")
					->setTitle("ReadMe custom OpenAPI extensions demo"),
			)
			->addServers(
				(new OA\Server\Server())->setUrl("https://httpbin.org/anything"),
			)
			->addTags(
				(new OA\Meta\Tag())
					->setName("Custom code samples")
					->setDescription("https://docs.readme.com/docs/openapi-extensions#custom-code-samples"),
				(new OA\Meta\Tag())
					->setName("Statically defined headers")
					->setDescription("https://docs.readme.com/docs/openapi-extensions#static-headers"),
				(new OA\Meta\Tag())
					->setName("Toggling interactivity")
					->setDescription("https://docs.readme.com/docs/openapi-extensions#disable-the-api-explorer"),
				(new OA\Meta\Tag())
					->setName("Designate code sample languages")
					->setDescription("https://docs.readme.com/docs/openapi-extensions#code-sample-languages"),
				(new OA\Meta\Tag())
					->setName("Toggling our CORS proxy")
					->setDescription("https://docs.readme.com/docs/openapi-extensions#cors-proxy-enabled"),
			);

		$doc->getComponents()->addSecurityScheme(
			"petstore_auth",
			(new OA\Security\SecurityScheme())
				->setType("oauth2")
				->setOAuthFlows(
					(new OA\Security\OAuthFlows())
					->setImplicit(
						(new OA\Security\OAuthFlow())
						->setAuthorizationUrl("http://petstore.swagger.io/oauth/dialog")
						->addScope("write:pets", "modify pets in your account")
						->addScope("read:pets", "read your pets"),
					),
				),
		);

		$doc->addPathItem(
			"/x-code-samples",
			(new Oa\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation()
					->setOperationId("x-readme_code-samples")
					->setSummary("Custom code samples with the \"x-readme.code-samples\" extension")
					->setDescription("This is a demonstration of our handling of our `x-readme.code-samples` extension.\n\nhttps://docs.readme.com/docs/openapi-extensions#custom-code-samples")
					->addTag("Custom code samples")
					->addCustomAttribute("x-readme", [
						"code-samples" => [
							[
								"name" => "Custom cURL snippet",
								"language" => "curl",
								"code" => "curl -X POST https://api.example.com/v2/alert",
							],
							[
								"language" => "curl",
								"code" => "# This custom cURL snippet does not have a custom name so it has the name of \"Default #2\".\n\ncurl -X POST https://api.example.com/v2/alert",
							],
						],
					])
				),
				)->setGet(
					(new OA\Operations\Operation())
				->setOperationId("x-code-samples")
				->setSummary("Custom code samples with the \"x-code-samples\" extension")
				->setDescription("This is a demonstration of our handling of our `x-code-samples` extension.\n\n> If this is present alongside `x-readme.code-samples` then the `x-readme.code-samples` extension will take precedence over this extension.\n\nhttps://docs.readme.com/docs/openapi-extensions#custom-code-samples")
				->addTag("Custom code samples")
				->addCustomAttribute("x-code-samples", [
					[
						"name" => "Custom cURL snippet",
						"language" => "curl",
						"code" => "curl -X POST https://api.example.com/v2/alert",
					],
					[
						"language" => "curl",
						"code" => "# This custom cURL snippet does not have a custom name so it has the name of \"Default #2\".\n\ncurl -X POST https://api.example.com/v2/alert",
					],
				]),
				),
		);

		$doc->addPathItem(
			"/x-headers",
			(new OA\Operations\PathItem())
			->setPost(
				(new OA\Operations\Operation())
				->setOperationId("x-readme_headers")
				->setSummary("Static headers with the \"x-readme.headers\" extension")
				->setDescription("This is a demonstration of our handling of our `x-readme.headers` extension where when present, headers specified within it will be statically sent with API requests made in \"Try It\" and added into generated code snippets.\n\nIn this case we have statically defined an `x-api-key` header with the value of `static-value`.\n\nhttps://docs.readme.com/docs/openapi-extensions#static-headers")
				->addTag("Statically defined headers")
				->addCustomAttribute("x-readme", [
					"headers" => [
						[
							"key" => "x-api-key",
							"value" => "static-value",
						],
					],
				]),
			)->setPatch(
				(new OA\Operations\Operation())
				->setOperationId("x-headers")
				->setSummary("Static headers with the \"x-headers\" extension")
				->setDescription("This is a demonstration of our handling of our `x-readme.headers` extension where when present, headers specified within it will be statically sent with API requests made in \"Try It\" and added into generated code snippets.\n\nIn this case we have statically defined an `x-api-key` header with the value of `static-value`.\n\n> If this is present alongside `x-readme.headers` then the `x-readme.headers` extension will take precedence over this extension.\n\nhttps://docs.readme.com/docs/openapi-extensions#static-headers")
				->addTag("Statically defined headers")
				->addCustomAttribute("x-headers", [
					[
						"key" => "x-api-key",
						"value" => "static-value",
					],
				]),
			),
		);

		$doc->addPathItem(
			"/x-explorer-enabled",
			(new OA\Operations\PathItem())
			->setPost(
				(new OA\Operations\Operation())
				->setOperationId("x-readme_explorer-enabled")
				->setSummary("Disable interactivity with the \"x-readme.explorer-enabled\" extension")
				->setDescription("When `x-readme.explorer-enabled` is present on an operation and set to `false`, the reference guide will be non-interactive and though your users will still be able to fill out a form and receive an auto-generated code sample to use, they will not be able to make requests to your API with our \"Try It\" button.\n\nhttps://docs.readme.com/docs/openapi-extensions#disable-the-api-explorer")
				->addTag("Toggling interactivity")
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
					->add(
						"petstore_auth",
						(new OA\Security\SecurityRequirement())
							->add("write:pets", "read:pets"),
					),
				)
				->addCustomAttribute("x-readme", [
					"explorer-enabled" => false,
				])
				->setRequestBody(
					(new OA\Operations\RequestBody())
					->setRequired(true)
					->addMediaType(
						"application/json",
						(new OA\Operations\MediaType())
							->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
					),
				),
			)
			->setPatch(
				(new OA\Operations\Operation())
				->setOperationId("x-explorer-enabled")
				->setSummary("Disable interactivity with the \"x-explorer-enabled\" extension")
				->setDescription("When `x-explorer-enabled` is present on an operation and set to `false`, the reference guide will be non-interactive and though your users will still be able to fill out a form and receive an auto-generated code sample to use, they will not be able to make requests to your API with our \"Try It\" button.\n\nIn this case we have statically defined an `x-api-key` header with the value of `static-value`.\n\n> If this is present alongside `x-readme.explorer-enabled` then the `x-readme.explorer-enabled` extension will take precedence over this extension.\n\nhttps://docs.readme.com/docs/openapi-extensions#disable-the-api-explorer")
				->addTag("Toggling interactivity")
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
					->add(
						"petstore_auth",
						(new OA\Security\SecurityRequirement())
							->add("write:pets", "read:pets"),
					),
				)
				->addCustomAttribute("x-explorer-enabled", false)
				->setRequestBody(
					(new OA\Operations\RequestBody())
					->setRequired(true)
					->addMediaType(
						"application/json",
						(new OA\Operations\MediaType())
							->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
					),
				),
			),
		);

		$doc->addPathItem(
			"/x-samples-languages",
			(new OA\Operations\PathItem())
			->setGet(
				(new OA\Operations\Operation())
				->setOperationId("x-readme_samples-languages")
				->setSummary("Control available code sample languages the \"x-readme.samples-languages\" extension")
				->setDescription("With an array of languages present in `x-readme.samples-languages` code samples will be generated for only those languages. If not present, it will default to: `curl`, `node`, `ruby`, `javascript`, and `python`.\n\nhttps://docs.readme.com/guides/docs/openapi-extensions#code-sample-languages")
				->addTag("Designate code sample languages")
				->addCustomAttribute("x-readme", [
					"samples-languages" => ["swift"],
				]),
			)->setPost(
				(new OA\Operations\Operation())
				->setOperationId("x-samples-languages")
				->setSummary("Control available code sample languages the \"x-samples-languages\" extension")
				->setDescription("With an array of languages present in `x-samples-languages` code samples will be generated for only those languages. If not present, it will default to: `curl`, `node`, `ruby`, `javascript`, and `python`.\n\n> If this is present alongside `x-readme.samples-languages` then the `x-readme.samples-languages` extension will take precedence over this extension.\n\nhttps://docs.readme.com/guides/docs/openapi-extensions#code-sample-languages")
				->addTag("Designate code sample languages")
				->addCustomAttribute("x-samples-languages", ["swift"]),
			),
		);

		$doc->addPathItem(
			"/x-proxy-enabled",
			(new OA\Operations\PathItem())
			->setPost(
				(new OA\Operations\Operation())
				->setOperationId("x-readme_proxy-enabled")
				->setSummary("Disable funneling requests through our CORS proxy with the \"x-readme.proxy-enabled\" extension")
				->setDescription("When `x-readme.proxy-enabled` is set to `false` all requests from the interactive will be funneled directly to the configured server URL, otherwise they will be piped through our proxy to allow [CORS-enabled](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS) requests for you.\n\nhttps://docs.readme.com/docs/openapi-extensions#cors-proxy-enabled")
				->addTag("Toggling our CORS proxy")
				->addCustomAttribute("x-readme", [
					"proxy-enabled" => false,
				]),
			)->setPatch(
				(new OA\Operations\Operation())
				->setOperationId("x-proxy-enabled")
				->setSummary("Disable funneling requests through our CORS proxy with the \"x-proxy-enabled\" extension")
				->setDescription("When `x-readme.proxy-enabled` is set to `false` all requests from the interactive will be funneled directly to the configured server URL, otherwise they will be piped through our proxy to allow [CORS-enabled](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS) requests for you.\n\n> If this is present alongside `x-readme.proxy-enabled` then the `x-readme.proxy-enabled` extension will take precedence over this extension.\n\nhttps://docs.readme.com/docs/openapi-extensions#cors-proxy-enabled")
				->addTag("Toggling our CORS proxy")
				->addCustomAttribute("x-proxy-enabled", false),
			),
		);

		$doc->getComponents()->addSchema(
			"Tag",
			(new OA\Schema\Schema())
				->setType("object")
				->addProperty(
					"id",
					(new OA\Schema\Schema())
						->setType("integer")
						->setFormat("int64"),
				)->addProperty(
					"name",
					(new OA\Schema\Schema())
						->setType("string"),
				),
		)->addSchema(
			"Pet",
			(new OA\Schema\Schema())
				->markFieldsAsRequired("name", "photoUrls")
				->setType("object")
				->addProperty(
					"id",
					(new OA\Schema\Schema())
						->setType("integer")
						->setFormat("int64"),
				)->addProperty(
					"name",
					(new OA\Schema\Schema())
						->setType("string")
						// Schema has "examples", but doesn't support example explicitly.
						// The spec uses a single example like this; it can be done with a custom attribute.
						->addCustomAttribute("example", "doggie"),
				)->addProperty(
					"photoUrls",
					(new OA\Schema\Schema())
						->setType("array")
						->setItems((new OA\Schema\Schema())->setType("string")),
				)->addProperty(
					"tags",
					(new OA\Schema\Schema())
						->setType("array")
						->setItems(
							(new OA\Schema\Schema())
						->setRef("#/components/schemas/Tag"),
						),
				)->addProperty(
					"status",
					(new OA\Schema\Schema())
						->setType("string")
						->setDescription("pet status in the store")
						->addEnumCases("available", "pending", "sold"),
				),
		);

		return $doc;
	}

	/**
	 * Source: https://github.com/readmeio/oas/blob/v5.16.1/3.1/json/readme-extensions.json
	 */
	public function assertFile(): string
	{
		return __DIR__ . '/examples/petstore.3.1.readme_extensions.json';
	}
}
