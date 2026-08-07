@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Expense Details</h1>
    <p><strong>Description:</strong> {{ $expense->description }}</p>
    <p><strong>Amount:</strong> {{ $expense->amount }}</p>
    <p><strong>Category:</strong> {{ $expense->category }}</p>
    <p><strong>Date:</strong> {{ $expense->date }}</p>
    <p><strong>Receipt:</strong> <a href="{{ $expense->receipt_path }}">View Receipt</a></p>
    <p><strong>Notes:</strong> {{ $expense->notes }}</p>
</div>
@endsection