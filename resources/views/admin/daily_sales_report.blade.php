@extends('admin.layouts.app')

@section('contents')
<div class="container mr-5 col-md-10 content-justify-center">
    <div class="py-1 mb-10"> 
        <div class="d-flex justify-content-between align-items-center ml-5">
        <i><span style="color: #a4f05c; font-weight: 800; font-size:38px;">Sales Report</i>
            <div class="col-md-4">
            <div class="form-group">
    <label for="date_filter">Filter by Date</label>
    <form method="get" action="{{ route('admin.daily_sales_report') }}">
        <div class="input-group">
            <select class="form-select" name="date_filter">
            <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Today</option>
                <option value="january" {{ $dateFilter == 'january' ? 'selected' : '' }}>January</option>
                <option value="february" {{ $dateFilter == 'february' ? 'selected' : '' }}>February</option>
                <option value="march" {{ $dateFilter == 'march' ? 'selected' : '' }}>March</option>
                <option value="april" {{ $dateFilter == 'april' ? 'selected' : '' }}>April</option>
                <option value="may" {{ $dateFilter == 'may' ? 'selected' : '' }}>May</option>
                <option value="june" {{ $dateFilter == 'june' ? 'selected' : '' }}>June</option>
                <option value="july" {{ $dateFilter == 'july' ? 'selected' : '' }}>July</option>
                <option value="august" {{ $dateFilter == 'august' ? 'selected' : '' }}>August</option>
                <option value="september" {{ $dateFilter == 'september' ? 'selected' : '' }}>September</option>
                <option value="october" {{ $dateFilter == 'october' ? 'selected' : '' }}>October</option>
                <option value="november" {{ $dateFilter == 'november' ? 'selected' : '' }}>November</option>
                <option value="december" {{ $dateFilter == 'december' ? 'selected' : '' }}>December</option>
                <!-- ... Repeat for other months -->
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>
            </div>
        </div>
    </div>
    <table id="myTable" class="table table-bordered table-hover display ml-5">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Date & Time</th>
            <th>Collectables (Cash)</th>
            <th>Receivables (GCash)</th>
            <th>Total Sales</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $report->total_cash }}</td>
                <td>{{ $report->total_gcash }}</td>
                <td>{{ $report->total_sales }}</td>
            </tr>
            @endforeach


            <tr>
                <td colspan="4" class="text-end"><strong>Total Collectables (Cash)</strong></td>
                <td>{{ $totalCollectablesForMonth }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Total Receivables (GCash)</strong></td>
                <td>{{ $totalReceivablesForMonth }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end"><strong>Total Sales</strong></td>
                <td>{{ $totalSalesForMonth }}</td>
            </tr>
        
        </tbody>
    </table>
</div>

@endsection
