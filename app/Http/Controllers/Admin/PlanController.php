<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('sort_order')->orderBy('price')->get();

        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['is_active'] = $request->boolean('is_active');

        Plan::create($data);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $this->validated($request);

        $data['is_active'] = $request->boolean('is_active');

        $plan->update($data);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully.');
    }

    public function toggle(Plan $plan)
    {
        $plan->update([
            'is_active' => ! $plan->is_active,
        ]);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan status changed successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'price' => ['required', 'numeric', 'min:0'],
            'validity_value' => ['required', 'integer', 'min:1'],
            'validity_unit' => ['required', 'string', 'in:hours,days,weeks,months'],
            'data_limit_mb' => ['required', 'integer', 'min:1'],
            'mikrotik_profile' => ['required', 'string', 'max:120'],
            'speed_limit' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}