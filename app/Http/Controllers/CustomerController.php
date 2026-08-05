<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $allowedSorts = ['id','customer_number','name','balance','phone','is_active'];
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $query = Customer::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('customer_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $customers = $query->orderBy($sort, $direction)->paginate(15)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // customer_number is generated automatically by the system on create
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Create customer first, then generate a readable unique customer_number based on ID
        $customer = Customer::create($data);

        // Example format: NAS000001, NAS000002, etc.
        $customerNumber = 'NAS' . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
        $customer->customer_number = $customerNumber;
        $customer->save();

        return redirect()->route('customers.index')->with('success', __('Nasabah berhasil dibuat.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Customer $customer): View
    {
        // Deposits: allow search by transaction_number and sort by date
        $depositQuery = $customer->depositTransactions()->with('customer');
        if ($search = $request->input('deposit_search')) {
            $depositQuery->where('transaction_number', 'like', "%{$search}%");
        }
        $depositSort = $request->input('deposit_sort', 'transaction_date_desc');
        if ($depositSort === 'transaction_date_asc') {
            $depositQuery->orderBy('transaction_date', 'asc');
        } else {
            $depositQuery->orderBy('transaction_date', 'desc');
        }
        $deposits = $depositQuery->paginate(5, ['*'], 'deposits_page');

        // Withdrawals
        $withdrawalQuery = $customer->withdrawalTransactions()->with('customer');
        if ($search = $request->input('withdrawal_search')) {
            $withdrawalQuery->where('transaction_number', 'like', "%{$search}%");
        }
        $withdrawalSort = $request->input('withdrawal_sort', 'transaction_date_desc');
        if ($withdrawalSort === 'transaction_date_asc') {
            $withdrawalQuery->orderBy('transaction_date', 'asc');
        } else {
            $withdrawalQuery->orderBy('transaction_date', 'desc');
        }
        $withdrawals = $withdrawalQuery->paginate(5, ['*'], 'withdrawals_page');

        return view('customers.show', compact('customer', 'deposits', 'withdrawals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Customer $customer): View
    {
        // Provide the same relations on edit page for inline management
        $depositQuery = $customer->depositTransactions()->with('customer');
        if ($search = $request->input('deposit_search')) {
            $depositQuery->where('transaction_number', 'like', "%{$search}%");
        }
        $depositSort = $request->input('deposit_sort', 'transaction_date_desc');
        if ($depositSort === 'transaction_date_asc') {
            $depositQuery->orderBy('transaction_date', 'asc');
        } else {
            $depositQuery->orderBy('transaction_date', 'desc');
        }
        $deposits = $depositQuery->paginate(5, ['*'], 'deposits_page');

        $withdrawalQuery = $customer->withdrawalTransactions()->with('customer');
        if ($search = $request->input('withdrawal_search')) {
            $withdrawalQuery->where('transaction_number', 'like', "%{$search}%");
        }
        $withdrawalSort = $request->input('withdrawal_sort', 'transaction_date_desc');
        if ($withdrawalSort === 'transaction_date_asc') {
            $withdrawalQuery->orderBy('transaction_date', 'asc');
        } else {
            $withdrawalQuery->orderBy('transaction_date', 'desc');
        }
        $withdrawals = $withdrawalQuery->paginate(5, ['*'], 'withdrawals_page');

        return view('customers.edit', compact('customer', 'deposits', 'withdrawals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $data = $request->validate([
            'customer_number' => 'required|string|max:255|unique:customers,customer_number,' . $customer->id,
            'name' => 'required|string|max:255',
            'balance' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', __('Customer updated.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', __('Customer deleted.'));
    }
}
