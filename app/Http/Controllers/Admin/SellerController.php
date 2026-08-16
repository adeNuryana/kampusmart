<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();
        $status = $request->string('status')->trim();

        $sellers = User::query()
            ->where('role', 'seller')
            ->with('sellerProfile')
            ->when($search->isNotEmpty(), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas(
                            'sellerProfile',
                            function ($query) use ($search) {
                                $query->where(
                                    'store_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );

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

        return view('admin.sellers.index', compact(
            'sellers'
        ));
    }


    public function create(): View
    {
        return view('admin.sellers.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
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

            'nim' => [
                'nullable',
                'string',
                'max:30',
            ],

            'faculty' => [
                'nullable',
                'string',
                'max:150',
            ],

            'store_name' => [
                'required',
                'string',
                'max:150',
            ],

            'whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        DB::transaction(function () use ($validated) {

            $seller = new User();

            $seller->name = $validated['name'];
            $seller->email = $validated['email'];
            $seller->phone = $validated['phone'] ?? null;

            $seller->role = 'seller';

            $seller->status = $validated['status'];

            /*
            |--------------------------------------------------------------------------
            | Karena akun dibuat Admin, kita anggap akun sudah provisioned.
            |--------------------------------------------------------------------------
            */

            $seller->email_verified_at = now();

            $seller->password = $validated['password'];

            $seller->save();


            $seller->sellerProfile()->create([
                'store_name' => $validated['store_name'],

                'whatsapp' => $validated['whatsapp'],

                'nim' => $validated['nim'] ?? null,

                'faculty' => $validated['faculty'] ?? null,

                'description' => $validated['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.sellers.index')
            ->with(
                'success',
                'Akun penjual berhasil dibuat.'
            );
    }
    public function show(User $seller): View
{
    abort_unless($seller->role === 'seller', 404);

    $seller->load('sellerProfile');

    return view('admin.sellers.show', compact('seller'));
}


public function edit(User $seller): View
{
    abort_unless($seller->role === 'seller', 404);

    $seller->load('sellerProfile');

    return view('admin.sellers.edit', compact('seller'));
}


public function updateStatus(
    Request $request,
    User $seller
): RedirectResponse {

    abort_unless($seller->role === 'seller', 404);

    $validated = $request->validate([
        'status' => [
            'required',
            'in:active,inactive',
        ],
    ]);

    $seller->status = $validated['status'];

    $seller->save();

    return back()->with(
        'success',
        $seller->status === 'active'
            ? 'Akun penjual berhasil diaktifkan.'
            : 'Akun penjual berhasil dinonaktifkan.'
    );
}
public function update(Request $request,User $seller): RedirectResponse {

    abort_unless($seller->role === 'seller', 404);

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:100',
        ],

        'email' => [
            'required',
            'email',
            'max:255',

            Rule::unique('users', 'email')
                ->ignore($seller->id),
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20',
        ],

        'nim' => [
            'nullable',
            'string',
            'max:30',
        ],

        'faculty' => [
            'nullable',
            'string',
            'max:150',
        ],

        'store_name' => [
            'required',
            'string',
            'max:150',
        ],

        'whatsapp' => [
            'required',
            'string',
            'max:20',
        ],

        'description' => [
            'nullable',
            'string',
            'max:1000',
        ],

        'status' => [
            'required',
            Rule::in([
                'active',
                'inactive',
            ]),
        ],

        'password' => [
            'nullable',
            'confirmed',
            Password::min(8),
        ],
    ]);


    DB::transaction(function () use (
        $validated,
        $seller
    ) {

        /*
        |--------------------------------------------------------------------------
        | Update akun seller
        |--------------------------------------------------------------------------
        */

        $seller->name = $validated['name'];

        $seller->email = $validated['email'];

        $seller->phone =
            $validated['phone'] ?? null;

        $seller->status =
            $validated['status'];


        /*
        |--------------------------------------------------------------------------
        | Password hanya diubah jika Admin mengisinya
        |--------------------------------------------------------------------------
        */

        if (! empty($validated['password'])) {
            $seller->password =
                $validated['password'];
        }

        $seller->save();


        /*
        |--------------------------------------------------------------------------
        | Update informasi toko
        |--------------------------------------------------------------------------
        */

        $seller->sellerProfile()
            ->updateOrCreate(
                [
                    'user_id' => $seller->id,
                ],
                [
                    'store_name' =>
                        $validated['store_name'],

                    'whatsapp' =>
                        $validated['whatsapp'],

                    'nim' =>
                        $validated['nim'] ?? null,

                    'faculty' =>
                        $validated['faculty'] ?? null,

                    'description' =>
                        $validated['description'] ?? null,
                ]
            );
    });


    return redirect()
        ->route('admin.sellers.show', $seller)
        ->with(
            'success',
            'Data penjual berhasil diperbarui.'
        );
}

}
