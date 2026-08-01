@extends('frontdesk.layouts.app')

@section('title', 'Front Desk Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Welcome, {{ auth()->guard('frontdesk')->user()->name }}!</h3>
        <p>You are logged in as front desk staff.</p>
    </div>
</div>
@endsection