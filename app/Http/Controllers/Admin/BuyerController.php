<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\ActivityLogger;
use App\Services\OrderDeletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class BuyerController extends Controller
{
    public function __construct(private readonly OrderDeletionService $orderDeletionService) {}

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

        $emailChanged = $buyer->email !== $validated['email'];

        $buyer->name = $validated['name'];
        $buyer->email = $validated['email'];
        $buyer->phone = $validated['phone'] ?? null;
        $buyer->status = $validated['status'];

        if (! empty($validated['password'])) {
            $buyer->password = $validated['password'];
        }

        $buyer->save();

        if ($emailChanged) {
            $buyer->forceFill(['email_verified_at' => null])->save();
            $buyer->sendEmailVerificationNotification();
        }

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

        $buyer = new User;

        $buyer->name = $validated['name'];
        $buyer->email = $validated['email'];
        $buyer->phone = $validated['phone'] ?? null;

        $buyer->role = 'buyer';
        $buyer->status = $validated['status'];

        $buyer->password = $validated['password'];

        $buyer->save();

        $buyer->sendEmailVerificationNotification();

        return redirect()
            ->route('admin.buyers.index')
            ->with(
                'success',
                'Akun pembeli berhasil ditambahkan.'
            );
    }

    public function destroy(User $buyer): RedirectResponse
    {
        abort_if($buyer->role !== 'buyer', 404);

        $photoPath = $buyer->photo;

        $result = DB::transaction(function () use ($buyer): array {
            $lockedBuyer = User::query()
                ->whereKey($buyer->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_if($lockedBuyer->role !== 'buyer', 404);

            $orders = Order::query()
                ->where('buyer_id', $lockedBuyer->id)
                ->orderBy('id')
                ->get();

            $restoredQuantity = 0;

            foreach ($orders as $order) {
                $orderResult = $this->orderDeletionService->delete($order);
                $restoredQuantity += $orderResult['restoredQuantity'];
            }

            $buyerName = $lockedBuyer->name;

            ActivityLogger::log(
                'buyer_deleted',
                'menghapus akun pembeli '.$buyerName,
                $lockedBuyer,
                [
                    'email' => $lockedBuyer->email,
                    'deleted_orders' => $orders->count(),
                    'restored_stock_quantity' => $restoredQuantity,
                ]
            );

            $lockedBuyer->delete();

            return compact('buyerName', 'restoredQuantity');
        });

        if (
            $photoPath
            && ! str_starts_with($photoPath, 'http://')
            && ! str_starts_with($photoPath, 'https://')
        ) {
            Storage::disk('public')->delete($photoPath);
        }

        $message = 'Akun pembeli '.$result['buyerName'].' berhasil dihapus.';

        if ($result['restoredQuantity'] > 0) {
            $message .= ' Sebanyak '.$result['restoredQuantity'].' stok dari pesanannya telah dikembalikan.';
        }

        return redirect()
            ->route('admin.buyers.index')
            ->with('success', $message);
    }
}
