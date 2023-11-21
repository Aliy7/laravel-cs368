<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        // Create a new role
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        // Update the role
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index')
                         ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully.');
    }

}
