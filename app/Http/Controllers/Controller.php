<?php

declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API Documentation",
 *         version="1.0.0"
 *     ),
 *     @OA\Components(
 *         @OA\Parameter(
 *             parameter="Accept",
 *             name="Accept",
 *             in="header",
 *             required=true,
 *             @OA\Schema(
 *                 type="string",
 *                 enum={"application/json"}
 *             ),
 *             description="Specify the format of the response. Must be 'application/json'."
 *         ),
 *     )
 * )
 */
abstract class Controller
{
    //
}
