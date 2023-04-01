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
