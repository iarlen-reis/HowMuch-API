<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;

class PurchasePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Purchase $purchase)
    {
        return $user->id === $purchase->user_id;
    }

    public function destroy(User $user, Purchase $purchase)
    {
        return $user->id === $purchase->user_id;
    }
}
