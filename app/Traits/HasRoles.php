<?php

namespace App\Traits;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    public function assignRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $this->roles()->attach($role);
        }
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

}