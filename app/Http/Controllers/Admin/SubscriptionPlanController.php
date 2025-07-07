<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionPlanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $plans = SubscriptionPlan::select(['id', 'name', 'price', 'billing_period', 'invoice_limit_per_month', 'is_active', 'created_at']);

            return DataTables::of($plans)
                ->addColumn('action', function ($plan) {
                    $planId = Crypt::encrypt($plan->id);
                    $editUrl = route('admin.subscription-plans.edit', $planId);
                    $deleteUrl = route('admin.subscription-plans.destroy', $planId);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                data-url="' . $deleteUrl . '">
                                Delete
                            </button>';
                })
                ->editColumn('is_active', function ($plan) {
                    return $plan->is_active ? 'Yes' : 'No';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subscription_plans.index');
    }

    public function create()
    {
        return view('admin.subscription_plans.create');
    }

    public function store(StoreSubscriptionPlanRequest $request)
    {
        $data = $request->validated();
        $data['features'] = json_encode($data['features'] ?? []);

        SubscriptionPlan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Plan created successfully.',
            'redirect_url' => route('admin.subscription-plans.index'),
        ]);
    }

    public function edit($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $subscription_plan = SubscriptionPlan::findOrFail($id);
            $subscription_plan->features = json_decode($subscription_plan->features ?? '[]');
            return view('admin.subscription_plans.edit', compact('subscription_plan'));
        } catch (\Exception $e) {
            abort(404, 'Invalid or expired plan link.');
        }
    }

    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscription_plan)
    {
        $data = $request->validated();
        $data['features'] = json_encode($data['features'] ?? []);

        $subscription_plan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Plan updated successfully.',
            'redirect_url' => route('admin.subscription-plans.index'),
        ]);
    }

    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Plan deleted successfully.',
        ]);
    }
}
