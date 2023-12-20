@extends('admin.layouts.app')

@section('contents')
<div class="table-responsive" style="height: 500px; overflow-y: auto; margin-left: 17%; width: 83%;">
    <i><span style="color: #a4f05c; font-weight: 800; font-size:38px;">Monthly Product Sold Report</i>
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>Product</th>
                    @for ($month = 1; $month <= 12; $month++)
                        <th>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($productReports as $report)
                    <tr>
                        <td>{{ $report->product_name }}</td>
                        @for ($month = 1; $month <= 12; $month++)
                            <td>{{ $report->month == $month ? $report->total_sold : 0 }}</td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
