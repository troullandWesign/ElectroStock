<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Http\Resources\ComponentResource;
use App\Models\Component;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Component::query();

        // Filtrer par type si demandé
        if ($request->has('type')) {
            $query->ofType($request->type);
        }

        // Filtrer par stock
        if ($request->has('in_stock') && $request->boolean('in_stock')) {
            $query->where('stock_quantity', '>', 0);
        }

        // Filtrer par stock faible
        if ($request->has('low_stock') && $request->boolean('low_stock')) {
            $query->whereBetween('stock_quantity', [1, 9]);
        }

        // Recherche par nom ou référence
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%");
            });
        }

        // Tri
        $sortField = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $components = $query->paginate($perPage);

        return ComponentResource::collection($components);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreComponentRequest $request
     * @return JsonResponse
     */
    public function store(StoreComponentRequest $request): JsonResponse
    {
        $component = Component::create($request->validated());

        return (new ComponentResource($component))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     * 
     * @param Component $component
     * @return ComponentResource
     */
    public function show(Component $component): ComponentResource
    {
        return new ComponentResource($component);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateComponentRequest $request
     * @param Component $component
     * @return ComponentResource
     */
    public function update(UpdateComponentRequest $request, Component $component): ComponentResource
    {
        $component->update($request->validated());

        return new ComponentResource($component);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Component $component
     * @return JsonResponse
     */
    public function destroy(Component $component): JsonResponse
    {
        $component->delete();

        return response()->json([
            'message' => 'Composant supprimé avec succès.',
        ], 200);
    }

    /**
     * Get components by type (shortcut endpoints).
     * 
     * @param Request $request
     * @param string $type
     * @return AnonymousResourceCollection
     */
    public function byType(Request $request, string $type): AnonymousResourceCollection
    {
        if (!in_array($type, ['resistor', 'capacitor', 'microcontroller'])) {
            abort(404, 'Type de composant invalide');
        }

        $query = Component::ofType($type);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $components = $query->paginate($perPage);

        return ComponentResource::collection($components);
    }

    /**
     * Get low stock components.
     * 
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function lowStock(Request $request): AnonymousResourceCollection
    {
        $components = Component::whereBetween('stock_quantity', [1, 9])
            ->orderBy('stock_quantity', 'asc')
            ->paginate($request->get('per_page', 15));

        return ComponentResource::collection($components);
    }

    /**
     * Get out of stock components.
     * 
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function outOfStock(Request $request): AnonymousResourceCollection
    {
        $components = Component::where('stock_quantity', 0)
            ->orderBy('updated_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return ComponentResource::collection($components);
    }
}

