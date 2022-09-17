<?php

namespace App\Filters;

use App\Models\BillingCycle;

class SubscriptionFilter
{
	public function apply($query)
	{
		if (request()->filled('status')) {
			$status = request()->status;
			$query->where('cancelled', $status === 'cancelled');
		}

		if (request()->filled('cycle')) {
			$cycle = request()->cycle;

			$billingCycle = BillingCycle::where('name', $cycle)->first();

			if (! $billingCycle) {
				return;
			}

			$query->where('billing_cycle_id', $billingCycle->id);
		}
	}
}
