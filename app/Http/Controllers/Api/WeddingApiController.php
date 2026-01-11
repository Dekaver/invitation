<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWeddingApiRequest;
use App\Models\Wedding;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class WeddingApiController extends Controller
{
    /**
     * Store a newly created wedding via API.
     * This endpoint is used by the Vue.js step wizard.
     */
    public function store(StoreWeddingApiRequest $request): JsonResponse
    {
        try {
            // Auto-generate slug from groom and bride names
            $data = $request->validated();
            $data['slug'] = $this->generateSlug($data['groom_name'], $data['bride_name']);

            $wedding = Wedding::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Wedding created successfully!',
                'data' => [
                    'id' => $wedding->id,
                    'slug' => $wedding->slug,
                    'url' => route('invitation.show', $wedding->slug),
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create wedding. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Generate a unique slug from groom and bride names.
     * Format: groom-bride-year (e.g., john-sarah-2026)
     */
    private function generateSlug(string $groomName, string $brideName): string
    {
        $baseSlug = Str::slug($groomName . '-' . $brideName . '-' . now()->year);

        // Ensure uniqueness
        $slug = $baseSlug;
        $counter = 1;

        while (Wedding::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}