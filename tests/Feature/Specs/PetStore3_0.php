<?php

declare(strict_types=1);

namespace Tests\Feature\Specs;

use WellRested\OpenApiModel as OA;

class PetStore3_0 implements SpecInterface
{
	public function build(): OA\Document
	{
		$doc = new OA\Document();
		$doc->setOpenapi('3.0.0')
			->setInfo(
				(new OA\Meta\Info())
					->setDescription("This is a sample server Petstore server.  You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters.")
					->setVersion("1.0.0")
					->setTitle("Swagger Petstore")
					->setTermsOfService("http://swagger.io/terms/")
					->setContact(
						(new OA\Meta\Contact())
							->setEmail("apiteam@swagger.io"),
					)
					->setLicense(
						(new OA\Meta\License())
							->setName("Apache 2.0")
							->setUrl("http://www.apache.org/licenses/LICENSE-2.0.html"),
					),
			)
			->setExternalDocs(
				(new OA\Meta\ExternalDocumentation())
					->setDescription("Find out more about Swagger")
					->setUrl("http://swagger.io"),
			)
			->addServers(
				(new OA\Server\Server())->setUrl("http://petstore.swagger.io/v2"),
			)
			->addTags(
				(new OA\Meta\Tag())
					->setName("pet")
					->setDescription("Everything about your Pets")
					->setExternalDocs(
						(new OA\Meta\ExternalDocumentation())
							->setDescription("Find out more")
							->setUrl("http://swagger.io"),
					),
				(new OA\Meta\Tag())
					->setName("store")
					->setDescription("Access to Petstore orders"),
				(new OA\Meta\Tag())
					->setName("user")
					->setDescription("Operations about user")
					->setExternalDocs(
						(new OA\Meta\ExternalDocumentation())
							->setDescription("Find out more about our store")
							->setUrl("http://swagger.io"),
					),
			);

		// /pet
		$petPathItem = new OA\Operations\PathItem();
		$petPathItem->setPost(
			(new OA\Operations\Operation())
				->addTag("pet")
				->setSummary("Add a new pet to the store")
				->setDescription("")
				->setOperationId("addPet")
				->addCustomAttribute('requestBody', ['$ref' => '#/components/requestBodies/Pet'])
				->addResponse("405", (new OA\Operations\Response())->setDescription("Invalid input"))
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
						->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
				),
		);
		$petPathItem->setPut(
			(new OA\Operations\Operation())
				->addTag("pet")
				->setSummary("Update an existing pet")
				->setDescription("")
				->setOperationId("updatePet")
				->addCustomAttribute('requestBody', ['$ref' => '#/components/requestBodies/Pet'])
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid ID supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("Pet not found"))
				->addResponse("405", (new OA\Operations\Response())->setDescription("Validation exception"))
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
						->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
				),
		);
		$doc->addPathItem("/pet", $petPathItem);

		// /pet/findByStatus
		$doc->addPathItem(
			"/pet/findByStatus",
			(new OA\Operations\PathItem())
				->setGet(
					(new OA\Operations\Operation())
						->addTag("pet")
						->setSummary("Finds Pets by status")
						->setDescription("Multiple status values can be provided with comma separated strings")
						->setOperationId("findPetsByStatus")
						->addParameters(
							(new OA\Operations\Parameter())
								->setName("status")
								->setIn(OA\Operations\ParameterLocation::Query)
								->setDescription("Status values that need to be considered for filter")
								->setRequired(true)
								->addCustomAttribute('explode', true)
								->setSchema(
									(new OA\Schema\Schema())
										->setType("array")
										->setItems(
											(new OA\Schema\Schema())
												->setType("string")
												->addEnumCases("available", "pending", "sold")
												->addCustomAttribute('default', 'available'),
										),
								),
						)
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addMediaType(
									"application/xml",
									(new OA\Operations\MediaType())->setSchema(
										(new OA\Schema\Schema())->setType("array")->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
									),
								)
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema(
										(new OA\Schema\Schema())->setType("array")->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
									),
								),
						)
						->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid status value"))
						->addSecurityRequirement(
							(new OA\Security\SecurityRequirements())
								->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
						),
				),
		);

		// /pet/findByTags
		$doc->addPathItem(
			"/pet/findByTags",
			(new OA\Operations\PathItem())
				->setGet(
					(new OA\Operations\Operation())
						->addTag("pet")
						->setSummary("Finds Pets by tags")
						->setDescription("Muliple tags can be provided with comma separated strings. Use tag1, tag2, tag3 for testing.")
						->setOperationId("findPetsByTags")
						->addParameters(
							(new OA\Operations\Parameter())
								->setName("tags")
								->setIn(OA\Operations\ParameterLocation::Query)
								->setDescription("Tags to filter by")
								->setRequired(true)
								->addCustomAttribute('explode', true)
								->setSchema(
									(new OA\Schema\Schema())->setType("array")->setItems((new OA\Schema\Schema())->setType("string")),
								),
						)
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addMediaType(
									"application/xml",
									(new OA\Operations\MediaType())->setSchema(
										(new OA\Schema\Schema())->setType("array")->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
									),
								)
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema(
										(new OA\Schema\Schema())->setType("array")->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
									),
								),
						)
						->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid tag value"))
						->addSecurityRequirement(
							(new OA\Security\SecurityRequirements())
								->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
						)
						->setDeprecated(true),
				),
		);

		// /pet/{petId}
		$petWithIdPathItem = new OA\Operations\PathItem();
		$petWithIdPathItem->setGet(
			(new OA\Operations\Operation())
				->addTag("pet")
				->setSummary("Find pet by ID")
				->setDescription("Returns a single pet")
				->setOperationId("getPetById")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("petId")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("ID of pet to return")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("integer")->setFormat("int64")),
				)
				->addResponse(
					"200",
					(new OA\Operations\Response())
						->setDescription("successful operation")
						->addMediaType(
							"application/xml",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
						)
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
						),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid ID supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("Pet not found"))
				->addResponse("default", (new OA\Operations\Response())->setDescription("successful response"))
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
						->add("api_key", (new OA\Security\SecurityRequirement())->add()),
				),
		);
		$petWithIdPathItem->setPost(
			(new OA\Operations\Operation())
				->addTag("pet")
				->setSummary("Updates a pet in the store with form data")
				->setDescription("")
				->setOperationId("updatePetWithForm")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("petId")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("ID of pet that needs to be updated")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("integer")->setFormat("int64")),
				)
				->setRequestBody(
					(new OA\Operations\RequestBody())
						->addMediaType(
							"application/x-www-form-urlencoded",
							(new OA\Operations\MediaType())
								->setSchema(
									(new OA\Schema\Schema())
										->setType("object")
										->addProperty("name", (new OA\Schema\Schema())->setDescription("Updated name of the pet")->setType("string"))
										->addProperty("status", (new OA\Schema\Schema())->setDescription("Updated status of the pet")->setType("string")),
								),
						),
				)
				->addResponse("405", (new OA\Operations\Response())->setDescription("Invalid input"))
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
						->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
				),
		);
		$petWithIdPathItem->setDelete(
			(new OA\Operations\Operation())
				->addTag("pet")
				->setSummary("Deletes a pet")
				->setDescription("")
				->setOperationId("deletePet")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("api_key")
						->setIn(OA\Operations\ParameterLocation::Header)
						->setRequired(false)
						->setSchema((new OA\Schema\Schema())->setType("string")),
					(new OA\Operations\Parameter())
						->setName("petId")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("Pet id to delete")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("integer")->setFormat("int64")),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid ID supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("Pet not found"))
				->addSecurityRequirement(
					(new OA\Security\SecurityRequirements())
						->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
				),
		);
		$doc->addPathItem("/pet/{petId}", $petWithIdPathItem);

		// /pet/{petId}/uploadImage
		$doc->addPathItem(
			"/pet/{petId}/uploadImage",
			(new OA\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation())
						->addTag("pet")
						->setSummary("Uploads an image")
						->setDescription("")
						->setOperationId("uploadFile")
						->addParameters(
							(new OA\Operations\Parameter())
								->setName("petId")
								->setIn(OA\Operations\ParameterLocation::Path)
								->setDescription("ID of pet to update")
								->setRequired(true)
								->setSchema((new OA\Schema\Schema())->setType("integer")->setFormat("int64")),
						)
						->setRequestBody(
							(new OA\Operations\RequestBody())
								->addMediaType(
									"multipart/form-data",
									(new OA\Operations\MediaType())
										->setSchema(
											(new OA\Schema\Schema())
												->setType("object")
												->addProperty("additionalMetadata", (new OA\Schema\Schema())->setDescription("Additional data to pass to server")->setType("string"))
												->addProperty("file", (new OA\Schema\Schema())->setDescription("file to upload")->setType("string")->setFormat("binary")),
										),
								),
						)
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/ApiResponse")),
								),
						)
						->addSecurityRequirement(
							(new OA\Security\SecurityRequirements())
								->add("petstore_auth", (new OA\Security\SecurityRequirement())->add("write:pets", "read:pets")),
						),
				),
		);

		// /store/inventory
		$doc->addPathItem(
			"/store/inventory",
			(new OA\Operations\PathItem())
				->setGet(
					(new OA\Operations\Operation())
						->addTag("store")
						->setSummary("Returns pet inventories by status")
						->setDescription("Returns a map of status codes to quantities")
						->setOperationId("getInventory")
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())
										->setSchema(
											(new OA\Schema\Schema())
												->setType("object")
												->addCustomAttribute('additionalProperties', ['type' => 'integer', 'format' => 'int32']),
										),
								),
						)
						->addSecurityRequirement(
							(new OA\Security\SecurityRequirements())
								->add("api_key", (new OA\Security\SecurityRequirement())->add()),
						),
				),
		);

		// /store/order
		$doc->addPathItem(
			"/store/order",
			(new OA\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation())
						->addTag("store")
						->setSummary("Place an order for a pet")
						->setDescription("")
						->setOperationId("placeOrder")
						->setRequestBody(
							(new OA\Operations\RequestBody())
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Order")),
								)
								->setDescription("order placed for purchasing the pet")
								->setRequired(true),
						)
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addMediaType(
									"application/xml",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Order")),
								)
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Order")),
								),
						)
						->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid Order")),
				),
		);

		// /store/order/{orderId}
		$storeOrderWithIdPathItem = new OA\Operations\PathItem();
		$storeOrderWithIdPathItem->setGet(
			(new OA\Operations\Operation())
				->addTag("store")
				->setSummary("Find purchase order by ID")
				->setDescription("For valid response try integer IDs with value >= 1 and <= 10. Other values will generated exceptions")
				->setOperationId("getOrderById")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("orderId")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("ID of pet that needs to be fetched")
						->setRequired(true)
						->setSchema(
							(new OA\Schema\Schema())
								->setType("integer")
								->setFormat("int64")
								->addCustomAttribute('minimum', 1)
								->addCustomAttribute('maximum', 10),
						),
				)
				->addResponse(
					"200",
					(new OA\Operations\Response())
						->setDescription("successful operation")
						->addMediaType(
							"application/xml",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Order")),
						)
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Order")),
						),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid ID supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("Order not found")),
		);
		$storeOrderWithIdPathItem->setDelete(
			(new OA\Operations\Operation())
				->addTag("store")
				->setSummary("Delete purchase order by ID")
				->setDescription("For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors")
				->setOperationId("deleteOrder")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("orderId")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("ID of the order that needs to be deleted")
						->setRequired(true)
						->setSchema(
							(new OA\Schema\Schema())
								->setType("integer")
								->setFormat("int64")
								->addCustomAttribute('minimum', 1),
						),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid ID supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("Order not found")),
		);
		$doc->addPathItem("/store/order/{orderId}", $storeOrderWithIdPathItem);

		// /user
		$doc->addPathItem(
			"/user",
			(new OA\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation())
						->addTag("user")
						->setSummary("Create user")
						->setDescription("This can only be done by the logged in user.")
						->setOperationId("createUser")
						->setRequestBody(
							(new OA\Operations\RequestBody())
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/User")),
								)
								->setDescription("Created user object")
								->setRequired(true),
						)
						->addResponse("default", (new OA\Operations\Response())->setDescription("successful operation")),
				),
		);

		// /user/createWithArray
		$doc->addPathItem(
			"/user/createWithArray",
			(new OA\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation())
						->addTag("user")
						->setSummary("Creates list of users with given input array")
						->setDescription("")
						->setOperationId("createUsersWithArrayInput")
						->addCustomAttribute('requestBody', ['$ref' => '#/components/requestBodies/UserArray'])
						->addResponse("default", (new OA\Operations\Response())->setDescription("successful operation")),
				),
		);

		// /user/createWithList
		$doc->addPathItem(
			"/user/createWithList",
			(new OA\Operations\PathItem())
				->setPost(
					(new OA\Operations\Operation())
						->addTag("user")
						->setSummary("Creates list of users with given input array")
						->setDescription("")
						->setOperationId("createUsersWithListInput")
						->addCustomAttribute('requestBody', ['$ref' => '#/components/requestBodies/UserArray'])
						->addResponse("default", (new OA\Operations\Response())->setDescription("successful operation")),
				),
		);

		// /user/login
		$doc->addPathItem(
			"/user/login",
			(new OA\Operations\PathItem())
				->setGet(
					(new OA\Operations\Operation())
						->addTag("user")
						->setSummary("Logs user into the system")
						->setDescription("")
						->setOperationId("loginUser")
						->addParameters(
							(new OA\Operations\Parameter())
								->setName("username")
								->setIn(OA\Operations\ParameterLocation::Query)
								->setDescription("The user name for login")
								->setRequired(true)
								->setSchema((new OA\Schema\Schema())->setType("string")),
							(new OA\Operations\Parameter())
								->setName("password")
								->setIn(OA\Operations\ParameterLocation::Query)
								->setDescription("The password for login in clear text")
								->setRequired(true)
								->setSchema((new OA\Schema\Schema())->setType("string")),
						)
						->addResponse(
							"200",
							(new OA\Operations\Response())
								->setDescription("successful operation")
								->addCustomAttribute('headers', [
									'X-Rate-Limit' => [
										'description' => 'calls per hour allowed by the user',
										'schema' => ['type' => 'integer', 'format' => 'int32'],
									],
									'X-Expires-After' => [
										'description' => 'date in UTC when token expires',
										'schema' => ['type' => 'string', 'format' => 'date-time'],
									],
								])
								->addMediaType(
									"application/xml",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setType("string")),
								)
								->addMediaType(
									"application/json",
									(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setType("string")),
								),
						)
						->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid username/password supplied")),
				),
		);

		// /user/logout
		$doc->addPathItem(
			"/user/logout",
			(new OA\Operations\PathItem())
				->setGet(
					(new OA\Operations\Operation())
						->addTag("user")
						->setSummary("Logs out current logged in user session")
						->setDescription("")
						->setOperationId("logoutUser")
						->addResponse("default", (new OA\Operations\Response())->setDescription("successful operation")),
				),
		);

		// /user/{username}
		$userWithUsernamePathItem = new OA\Operations\PathItem();
		$userWithUsernamePathItem->setGet(
			(new OA\Operations\Operation())
				->addTag("user")
				->setSummary("Get user by user name")
				->setDescription("")
				->setOperationId("getUserByName")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("username")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("The name that needs to be fetched. Use user1 for testing. ")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("string")),
				)
				->addResponse(
					"200",
					(new OA\Operations\Response())
						->setDescription("successful operation")
						->addMediaType(
							"application/xml",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/User")),
						)
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/User")),
						),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid username supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("User not found")),
		);
		$userWithUsernamePathItem->setPut(
			(new OA\Operations\Operation())
				->addTag("user")
				->setSummary("Updated user")
				->setDescription("This can only be done by the logged in user.")
				->setOperationId("updateUser")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("username")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("name that need to be updated")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("string")),
				)
				->setRequestBody(
					(new OA\Operations\RequestBody())
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/User")),
						)
						->setDescription("Updated user object")
						->setRequired(true),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid user supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("User not found")),
		);
		$userWithUsernamePathItem->setDelete(
			(new OA\Operations\Operation())
				->addTag("user")
				->setSummary("Delete user")
				->setDescription("This can only be done by the logged in user.")
				->setOperationId("deleteUser")
				->addParameters(
					(new OA\Operations\Parameter())
						->setName("username")
						->setIn(OA\Operations\ParameterLocation::Path)
						->setDescription("The name that needs to be deleted")
						->setRequired(true)
						->setSchema((new OA\Schema\Schema())->setType("string")),
				)
				->addResponse("400", (new OA\Operations\Response())->setDescription("Invalid username supplied"))
				->addResponse("404", (new OA\Operations\Response())->setDescription("User not found")),
		);
		$doc->addPathItem("/user/{username}", $userWithUsernamePathItem);

		$doc->setComponents(
			(new OA\Components\Components())
				->addRequestBody(
					"Pet",
					(new OA\Operations\RequestBody())
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
						)
						->addMediaType(
							"application/xml",
							(new OA\Operations\MediaType())->setSchema((new OA\Schema\Schema())->setRef("#/components/schemas/Pet")),
						)
						->setDescription("Pet object that needs to be added to the store")
						->setRequired(true),
				)
				->addRequestBody(
					"UserArray",
					(new OA\Operations\RequestBody())
						->addMediaType(
							"application/json",
							(new OA\Operations\MediaType())
								->setSchema(
									(new OA\Schema\Schema())
										->setType("array")
										->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/User")),
								),
						)
						->setDescription("List of user object")
						->setRequired(true),
				)
				->addSecurityScheme(
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
				)
				->addSecurityScheme(
					"api_key",
					(new OA\Security\SecurityScheme())
						->setType("apiKey")
						->setName("api_key")
						->setIn(OA\Security\SecuritySchemeLocation::Header),
				)
				->addSchema(
					"Order",
					(new OA\Schema\Schema())
						->setType("object")
						->addProperty("id", (new OA\Schema\Schema())->setType("integer")->setFormat("int64"))
						->addProperty("petId", (new OA\Schema\Schema())->setType("integer")->setFormat("int64"))
						->addProperty("quantity", (new OA\Schema\Schema())->setType("integer")->setFormat("int32"))
						->addProperty("shipDate", (new OA\Schema\Schema())->setType("string")->setFormat("date-time"))
						->addProperty(
							"status",
							(new OA\Schema\Schema())
								->setType("string")
								->setDescription("Order Status")
								->addEnumCases("placed", "approved", "delivered"),
						)
						->addProperty(
							"complete",
							(new OA\Schema\Schema())
								->setType("boolean")
								->addCustomAttribute('default', false),
						)
						->addCustomAttribute('xml', ['name' => 'Order']),
				)
				->addSchema(
					"Category",
					(new OA\Schema\Schema())
						->setType("object")
						->addProperty("id", (new OA\Schema\Schema())->setType("integer")->setFormat("int64"))
						->addProperty("name", (new OA\Schema\Schema())->setType("string"))
						->addCustomAttribute('xml', ['name' => 'Category']),
				)
				->addSchema(
					"User",
					(new OA\Schema\Schema())
						->setType("object")
						->addProperty("id", (new OA\Schema\Schema())->setType("integer")->setFormat("int64"))
						->addProperty("username", (new OA\Schema\Schema())->setType("string"))
						->addProperty("firstName", (new OA\Schema\Schema())->setType("string"))
						->addProperty("lastName", (new OA\Schema\Schema())->setType("string"))
						->addProperty("email", (new OA\Schema\Schema())->setType("string"))
						->addProperty("password", (new OA\Schema\Schema())->setType("string"))
						->addProperty("phone", (new OA\Schema\Schema())->setType("string"))
						->addProperty(
							"userStatus",
							(new OA\Schema\Schema())
								->setType("integer")
								->setFormat("int32")
								->setDescription("User Status"),
						)
						->addCustomAttribute('xml', ['name' => 'User']),
				)
				->addSchema(
					"Tag",
					(new OA\Schema\Schema())
						->setType("object")
						->addProperty("id", (new OA\Schema\Schema())->setType("integer")->setFormat("int64"))
						->addProperty("name", (new OA\Schema\Schema())->setType("string"))
						->addCustomAttribute('xml', ['name' => 'Tag']),
				)
				->addSchema(
					"Pet",
					(new OA\Schema\Schema())
						->setType("object")
						->markFieldsAsRequired("name", "photoUrls")
						->addProperty(
							"id",
							(new OA\Schema\Schema())
								->setType("integer")
								->setFormat("int64")
								->setReadOnly(true)
								->addCustomAttribute('default', 40)
								->addCustomAttribute('example', 25),
						)
						->addProperty("category", (new OA\Schema\Schema())->setRef("#/components/schemas/Category"))
						->addProperty(
							"name",
							(new OA\Schema\Schema())
								->setType("string")
								->addCustomAttribute('example', 'doggie'),
						)
						->addProperty(
							"photoUrls",
							(new OA\Schema\Schema())
								->setType("array")
								->addCustomAttribute('xml', ['name' => 'photoUrl', 'wrapped' => true])
								->setItems(
									(new OA\Schema\Schema())
										->setType("string")
										->addCustomAttribute('example', 'https://example.com/photo.png'),
								),
						)
						->addProperty(
							"tags",
							(new OA\Schema\Schema())
								->setType("array")
								->addCustomAttribute('xml', ['name' => 'tag', 'wrapped' => true])
								->setItems((new OA\Schema\Schema())->setRef("#/components/schemas/Tag")),
						)
						->addProperty(
							"status",
							(new OA\Schema\Schema())
								->setType("string")
								->setDescription("pet status in the store")
								->addEnumCases("available", "pending", "sold"),
						)
						->addCustomAttribute('xml', ['name' => 'Pet']),
				)
				->addSchema(
					"ApiResponse",
					(new OA\Schema\Schema())
						->setType("object")
						->addProperty("code", (new OA\Schema\Schema())->setType("integer")->setFormat("int32"))
						->addProperty("type", (new OA\Schema\Schema())->setType("string"))
						->addProperty("message", (new OA\Schema\Schema())->setType("string")),
				),
		);

		return $doc;
	}

	/**
	 * Source: https://github.com/readmeio/oas/blob/v5.16.1/3.0/json/petstore.json
	 */
	public function assertFile(): string
	{
		return __DIR__ . '/examples/petstore.3.0.json';
	}
}
