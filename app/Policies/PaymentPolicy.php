<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;


class PaymentPolicy
{
  use HandlesAuthorization;

  public function viewAny(User $user)
  {
      return $user->hasAnyRole(['superadmin', 'admin',  ]);
  }

  public function view(User $user, Payment $payment)
  {
      return $user->hasAnyRole(['superadmin', 'admin', ]);
  }

  public function create(User $user)
  {
      return $user->hasAnyRole(['superadmin', 'admin']);
  }

  public function update(User $user, Payment $payment)
  {
      return $user->hasAnyRole(['superadmin', 'admin']);
  }

  public function delete(User $user, Payment $payment)
  {
      return $user->hasRole('superadmin');
  }

  public function restore(User $user, Payment $payment)
  {
      return $user->hasRole('superadmin');
  }

  public function forceDelete(User $user, Payment $payment)
  {
      return $user->hasRole('superadmin');
  }
}