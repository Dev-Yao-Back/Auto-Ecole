<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;


class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, Course $course)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function create(User $user)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function update(User $user, Course $course)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function delete(User $user, Course $course)
    {
      return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function restore(User $user, Course $course)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Course $course)
    {
        return $user->hasRole('superadmin');
    }
}
