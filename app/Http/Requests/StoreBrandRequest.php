<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreBrandRequest",
 *     type="object",
 *     required={"name", "image", "rating"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the brand"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         format="binary",
 *         description="Image file for the brand"
 *     ),
 *     @OA\Property(
 *         property="rating",
 *         type="integer",
 *         description="Rating of the brand"
 *     ),
 *     @OA\Property(
 *         property="country_id",
 *         type="integer",
 *         description="ID of the associated country"
 *     ),
 * )
 */
class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'country_id' => 'required|integer',
        ];
    }
}
