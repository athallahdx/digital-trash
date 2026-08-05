<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\WithdrawalTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WithdrawalTransactionController extends Controller
{
    public function index(Request $request): View
    {
        $allowedSorts = ['id','transaction_number','transaction_date','amount','created_at','customer'];
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $query = WithdrawalTransaction::with('customer')->select('withdrawal_transactions.*');

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('transaction_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($qc) use ($search) {
                      $qc->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($sort === 'customer') {
            $query->join('customers', 'customers.id', '=', 'withdrawal_transactions.customer_id')
                  ->orderBy('customers.name', $direction)
                  ->select('withdrawal_transactions.*');
        } else {
            $query->orderBy($sort, $direction);
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('withdrawal_transactions.index', compact('transactions'));
    }

    public function create(Request $request): View
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomerId = $request->query('customer_id');

        return view('withdrawal_transactions.create', compact('customers', 'selectedCustomerId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'transaction_number' => 'required|string|max:255|unique:withdrawal_transactions,transaction_number',
            'customer_id' => 'required|exists:customers,id',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        if ($request->query('customer_id')) {
            $data['customer_id'] = $request->query('customer_id');
        }

        $customer = Customer::findOrFail($data['customer_id']);
        if ($customer->balance < $data['amount']) {
            return redirect()->back()->withErrors(['amount' => 'Saldo nasabah tidak mencukupi untuk penarikan ini.'])->withInput();
        }

        WithdrawalTransaction::create($data);

        if ($request->query('customer_id')) {
            return redirect()->route('customers.show', $request->query('customer_id'))->with('success', __('Withdrawal transaction created.'));
        }

        return redirect()->route('withdrawal-transactions.index')->with('success', __('Withdrawal transaction created.'));
    }

    public function show(WithdrawalTransaction $withdrawal_transaction): View
    {
        $withdrawal_transaction->load('customer');

        return view('withdrawal_transactions.show', ['transaction' => $withdrawal_transaction]);
    }

    public function edit(Request $request, WithdrawalTransaction $withdrawal_transaction): View
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomerId = $request->query('customer_id');

        return view('withdrawal_transactions.edit', ['transaction' => $withdrawal_transaction, 'customers' => $customers, 'selectedCustomerId' => $selectedCustomerId]);
    }

    public function update(Request $request, WithdrawalTransaction $withdrawal_transaction): RedirectResponse
    {
        $selectedCustomerId = $request->query('customer_id');

        $data = $request->validate([
            'transaction_number' => 'required|string|max:255|unique:withdrawal_transactions,transaction_number,' . $withdrawal_transaction->id,
            'customer_id' => 'required|exists:customers,id',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        if ($selectedCustomerId) {
            $data['customer_id'] = $withdrawal_transaction->customer_id;
        }

        $withdrawal_transaction->update($data);

        if ($selectedCustomerId) {
            return redirect()->route('customers.show', $selectedCustomerId)->with('success', __('Withdrawal transaction updated.'));
        }

        return redirect()->route('withdrawal-transactions.index')->with('success', __('Withdrawal transaction updated.'));
    }

    public function destroy(Request $request, WithdrawalTransaction $withdrawal_transaction): RedirectResponse
    {
        $customerId = $request->query('customer_id');
        $withdrawal_transaction->delete();

        if ($customerId) {
            return redirect()->route('customers.show', $customerId)->with('success', __('Withdrawal transaction deleted.'));
        }

        return redirect()->route('withdrawal-transactions.index')->with('success', __('Withdrawal transaction deleted.'));
    }
}
