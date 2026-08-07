<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the user's expenses.
     */
    public function index(Request $request): View
    {

        $expenses = $request->user()->expenses()->latest()->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create(): View
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:100',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $request->user()->expenses()->create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully!');
    }

    /**
     * Display the specified expense.
     */
    public function show(Request $request, Expense $expense): View
    {
        // Ensure the expense belongs to the authenticated user
        if ($expense->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('expenses.show', $expense);
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Request $request, Expense $expense): View
    {
        if ($expense->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('expenses.edit', $expense);
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense): RedirectResponse
    {
        if ($expense->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:100',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.show', $expense)
            ->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Request $request, Expense $expense): RedirectResponse
    {
        if ($expense->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted.');
    }
}
