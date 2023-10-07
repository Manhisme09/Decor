@extends('admin.layouts.layout')
@section('head')
    <title>Thống Kê</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thống kê</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div style="display: flex; align-items: baseline; justify-content: space-between;">
                    <div class="panel-heading">Thống kê doanh thu theo tháng</div>
                    <div>
                        <form method="GET" action="{{ route('admin.thongke.index') }}" id="yearForm">
                            <label style="font-weight: normal" for="yearSelect">Chọn năm: </label>
                            <select id="yearSelect" name="selectedYear">
                                <option value="2022" @if ($selectedYear == "2022") selected @endif>2022</option>
                                <option value="2023" @if ($selectedYear == "2023") selected @endif>2023</option>
                                <option value="2024" @if ($selectedYear == "2024") selected @endif>2024</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Tổng tiền hoá đơn theo ngày
                    {{-- <a class="btn btn-primary pull-right" style="padding: 0px 12px" href="{{ route('admin.thongke.export') }}"><i class="fa fa-download" aria-hidden="true"></i> Tải về</a> --}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th style="width:10px">STT</th>
                                    <th>Ngày</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i =1;
                                @endphp
                                @foreach ($tong_tien as $item)
                                <tr class="odd gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->ngay_lap)) }}</td>
                                    <td> {{ number_format($item->tong) }} VNĐ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        document.getElementById("yearSelect").addEventListener("change", function() {
            document.getElementById("yearForm").submit();
        });
    </script>
    <script>
        var month = <?php echo $month; ?>;
        var hoadon = <?php echo $hoadon; ?>;
        var barChartData = {
            labels: month,
            datasets: [{
                label: 'Tổng doanh thu',
                backgroundColor: "orange",
                data: hoadon
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Tổng tiền hoá đơn(Theo tháng)'
                    }
                }
            });
        };
    </script>
@endsection
