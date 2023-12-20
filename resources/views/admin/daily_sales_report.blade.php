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
                                <option value="">All Dates</option>
                                <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="yesterday" {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                <option value="this_week" {{ $dateFilter == 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="last_week" {{ $dateFilter == 'last_week' ? 'selected' : '' }}>Last Week</option>
                                <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_month" {{ $dateFilter == 'last_month' ? 'selected' : '' }}>Last Month</option>
                                <option value="this_year" {{ $dateFilter == 'this_year' ? 'selected' : '' }}>This Year</option>
                                <option value="last_year" {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Last Year</option>
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
                <th>Action</th>
                
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
        </tbody>
    </table>
</div>

@endsection
