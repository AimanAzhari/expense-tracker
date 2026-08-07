@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
                <th>Receipt</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
            <tr>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->category }}</td>
                <td>{{ $expense->date }}</td>
                <td><a href="{{ $expense->receipt_path }}">View Receipt</a></td>
                <td>{{ $expense->notes }}</td>
                <td>
                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection