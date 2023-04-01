<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel" style="text-align: center">Chi tiết hoá đơn <span
                        class="hoa_don"></span></h3>
            </div>
            <h4 style="margin: 30px 0 0px 30px; ">Mã hoá đơn: <span class="hoa_don_id"></span></h4>
            <h4 style="margin-left: 30px;">Khách hàng: <span id="khach_hang"></span></h4>
            <h4 style="margin-left: 30px;">Điện thoại: <span id="dien_thoai"></span></h4>
            <h4 style="margin-left: 30px;">Địa chỉ: <span id="dia_chi"></span></h4>
            <h4 style="margin-left: 30px;">Ngày đặt: <span id="ngay_dat"></span></h4>
            <h4 style="margin-left: 30px;">Tổng tiền: <span id="tong_tien"></span></h4>
            <div class="table-responsive" style="margin-top: 30px">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
