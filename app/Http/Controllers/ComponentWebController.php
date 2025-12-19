<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ComponentWebController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Component::query();

        // Filtres
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('low_stock') && $request->boolean('low_stock')) {
            $query->whereBetween('stock_quantity', [1, 9]);
        }

        if ($request->has('in_stock') && !$request->boolean('in_stock')) {
            $query->where('stock_quantity', 0);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%");
            });
        }

        $components = $query->latest()->paginate(12);

        // Stats par type
        $stats = [
            'total' => Component::count(),
            'resistors' => Component::where('type', 'resistor')->count(),
            'capacitors' => Component::where('type', 'capacitor')->count(),
            'microcontrollers' => Component::where('type', 'microcontroller')->count(),
        ];

        return Inertia::render('Components/Index', [
            'components' => $components,
            'filters' => $request->only(['type', 'search', 'low_stock', 'in_stock']),
            'stats' => $stats,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Components/Create');
    }

    public function store(StoreComponentRequest $request)
    {
        Component::create($request->validated());

        return redirect()->route('components.index')
            ->with('success', 'Composant créé avec succès !');
    }

    public function edit(Component $component): Response
    {
        return Inertia::render('Components/Edit', [
            'component' => $component,
        ]);
    }

    public function update(UpdateComponentRequest $request, Component $component)
    {
        $component->update($request->validated());

        return redirect()->route('components.index')
            ->with('success', 'Composant mis à jour avec succès !');
    }

    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('components.index')
            ->with('success', 'Composant supprimé avec succès !');
    }
}
