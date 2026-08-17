<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class BuyerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();
        $status = $request->string('status')->trim();

        $buyers = User::query()
            ->where('role', 'buyer')

            ->when($search->isNotEmpty(), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })

            ->when(
                in_array($status->value(), ['active', 'inactive'], true),
                function ($query) use ($status) {
                    $query->where('status', $status->value());
                }
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.buyers.index', compact('buyers'));
    }
    public function edit(User $buyer): View
    {
        abort_if($buyer->role !== 'buyer', 404);

        return view('admin.buyers.edit', compact('buyer'));
    }


    public function updateStatus(Request $request, User $buyer)
    {
        abort_if($buyer->role !== 'buyer', 404);

        $validated = $request->validate([
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $buyer->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            $validated['status'] === 'active'
                ? 'Akun pembeli berhasil diaktifkan.'
                : 'Akun pembeli berhasil dinonaktifkan.'
        );
    }
    public function show(User $buyer): View
    {
        abort_if($buyer->role !== 'buyer', 404);

        return view('admin.buyers.show', compact('buyer'));
    }
    public function update(Request $request, User $buyer)
    {
        abort_if($buyer->role !== 'buyer', 404);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($buyer->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'password' => [
                'nullable',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $buyer->name = $validated['name'];
        $buyer->email = $validated['email'];
        $buyer->phone = $validated['phone'] ?? null;
        $buyer->status = $validated['status'];

        if (!empty($validated['password'])) {
            $buyer->password = $validated['password'];
        }

        $buyer->save();

        return redirect()
            ->route('admin.buyers.index')
            ->with('success', 'Data pembeli berhasil diperbarui.');
    }
    public function create(): View
    {
        return view('admin.buyers.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $buyer = new User();

        $buyer->name = $validated['name'];
        $buyer->email = $validated['email'];
        $buyer->phone = $validated['phone'] ?? null;

        $buyer->role = 'buyer';
        $buyer->status = $validated['status'];

        // Karena dibuat oleh Admin
        $buyer->email_verified_at = now();

        $buyer->password = $validated['password'];

        $buyer->save();

        return redirect()
            ->route('admin.buyers.index')
            ->with(
                'success',
                'Akun pembeli berhasil ditambahkan.'
            );
    }
}
