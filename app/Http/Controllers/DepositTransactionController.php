<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DepositTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepositTransactionController extends Controller
{
    public function index(Request $request): View
    {
        $allowedSorts = ['id','transaction_number','transaction_date','total_amount','created_at','customer'];
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $query = DepositTransaction::with('customer')->select('deposit_transactions.*');

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('transaction_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($qc) use ($search) {
                      $qc->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($sort === 'customer') {
            // join to allow sorting by customer name
            $query->join('customers', 'customers.id', '=', 'deposit_transactions.customer_id')
                  ->orderBy('customers.name', $direction)
                  ->select('deposit_transactions.*');
        } else {
            $query->orderBy($sort, $direction);
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('deposit_transactions.index', compact('transactions'));
    }

    public function create(Request $request): View
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomerId = $request->query('customer_id');

        return view('deposit_transactions.create', compact('customers', 'selectedCustomerId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'transaction_number' => 'nullable|string|max:255|unique:deposit_transactions,transaction_number',
            'customer_id' => 'required|exists:customers,id',
            'transaction_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        if ($request->query('customer_id')) {
            $data['customer_id'] = $request->query('customer_id');
        }

        DepositTransaction::create($data);

        if ($request->query('customer_id')) {
            return redirect()->route('customers.show', $request->query('customer_id'))->with('success', __('Deposit transaction created.'));
        }

        return redirect()->route('deposit-transactions.index')->with('success', __('Deposit transaction created.'));
    }

    public function show(DepositTransaction $deposit_transaction): View
    {
        $deposit_transaction->load('customer');

        return view('deposit_transactions.show', ['transaction' => $deposit_transaction]);
    }

    public function edit(Request $request, DepositTransaction $deposit_transaction): View
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomerId = $request->query('customer_id');

        return view('deposit_transactions.edit', ['transaction' => $deposit_transaction, 'customers' => $customers, 'selectedCustomerId' => $selectedCustomerId]);
    }

    public function update(Request $request, DepositTransaction $deposit_transaction): RedirectResponse
    {
        $selectedCustomerId = $request->query('customer_id');

        $data = $request->validate([
            'transaction_number' => 'required|string|max:255|unique:deposit_transactions,transaction_number,' . $deposit_transaction->id,
            'customer_id' => 'required|exists:customers,id',
            'transaction_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        if ($selectedCustomerId) {
            $data['customer_id'] = $deposit_transaction->customer_id;
        }

        $deposit_transaction->update($data);

        if ($selectedCustomerId) {
            return redirect()->route('customers.show', $selectedCustomerId)->with('success', __('Deposit transaction updated.'));
        }

        return redirect()->route('deposit-transactions.index')->with('success', __('Deposit transaction updated.'));
    }

    public function destroy(Request $request, DepositTransaction $deposit_transaction): RedirectResponse
    {
        $customerId = $request->query('customer_id');
        $deposit_transaction->delete();

        if ($customerId) {
            return redirect()->route('customers.show', $customerId)->with('success', __('Deposit transaction deleted.'));
        }

        return redirect()->route('deposit-transactions.index')->with('success', __('Deposit transaction deleted.'));
    }
}
