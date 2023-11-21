<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Assign a permission to the role.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function givePermissionTo(Permission $permission)
    {
        $this->permissions()->save($permission);
    }
}
