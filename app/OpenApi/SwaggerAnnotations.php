<?php

namespace App\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Swagger with Laravel",
 *     version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="User model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-19T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-19T12:34:56Z")
 * )
 * @OA\Schema(
 *     schema="AttributeRequest",
 *     title="Attribute Request",
 *     description="Schema for creating an attribute",
 *     required={"name", "type"},
 *     @OA\Property(property="name", type="string", example="department", nullable=true),
 *     @OA\Property(property="type", type="string", enum={"text", "number", "date", "select"}, example="text", nullable=true)
 * )
 *   @OA\Schema(
 *     schema="Attribute",
 *     title="Attribute",
 *     description="Attribute model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="department"),
 *     @OA\Property(property="type", type="string", enum={"text", "number", "date", "select"}, example="text"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
*   @OA\Schema(
 *     schema="AttributeValues",
 *     title="Attribute Values",
 *     description="Attribute Values model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="attribute_id", type="integer", example="1"),
 *     @OA\Property(property="entity_id", type="integer", example="product_id"),
 *     @OA\Property(property="value", type="string", example="IT"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * @OA\Schema(
 *     schema="Timesheet",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="task_name", type="string", example="Develop API"),
 *     @OA\Property(property="date", type="string", format="date", example="2024-02-20"),
 *     @OA\Property(property="hours", type="number", format="float", example=8.5),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="project_id", type="integer", example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * @OA\Schema(
 *     schema="AttributeValue",
 *     type="object",
 *     @OA\Property(property="attribute_id", type="integer", example=1),
 *     @OA\Property(property="entity_id", type="integer", example=10, description="ID of the associated project"),
 *     @OA\Property(property="value", type="string", example="Some attribute value")
 * )
 * @OA\Schema(
 *     schema="Project",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="New Website"),
 *     @OA\Property(property="status", type="integer", example="1"),
 *     @OA\Property(property="attributes", type="array", @OA\Items(ref="#/components/schemas/AttributeValue")),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */



class SwaggerAnnotations
{
}
