<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::orderBy('created_at', 'desc')
            ->where('id', '!=', auth()->id())
            ->withCount('languages')
            ->paginate(10);

        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $admin = User::create($request->validated());

        return redirect()->route('dashboard.admins.index')
            ->with('success', 'تم إضافة المسؤول بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404, 'Page not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::findOrFail($id);

        return view('dashboard.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        $admin = User::findOrFail($id);
        $admin->update($request->validated());

        return redirect()->route('dashboard.admins.index')
            ->with('success', 'تم تحديث المسؤول بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('dashboard.admins.index')
            ->with('success', 'تم حذف المسؤول بنجاح.');
    }
}
