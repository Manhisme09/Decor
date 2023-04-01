@extends('pages.layouts.layout')
@section('title')
    <title>Giới thiệu | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.gioithieu') }}">Giới thiệu</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="introduce-title">
                    <h3>GIỚI THIỆU</h3>
                </div>
                <div class="introduce-content">
                    <p>Nội thất FurniBuy.com là một thương hiệu mới được phát triển từ nội thất AmiA Việt Nam. Một đơn vị
                        lâu năm và nhiều kinh nghiệm trong mảng sản xuất và kinh doanh các sản phẩm nội thất gia đình và vật
                        dụng trang trí nhà cửa. Tiền thân ban đầu là Siêu thị tranh AmiA, được thành lập từ năm 2012 tại Hà
                        Nội.</p>
                    <p>Hiện nội thất FurniBuy.com chủ yếu hướng tới phục vụ khách hàng bình dân đại chúng. Với đa phần các
                        sản phẩm nằm trong phân khúc giá rẻ, mẫu mã đa dạng, thiết kế theo xu hướng trẻ trung hợp với phong
                        cách nhà phố ngày nay. Là đơn vị trực tiếp sản xuất, lại áp dụng mô hình bán hàng tại kho theo tiêu
                        chí Cực nhiều và Cực rẻ.</p>
                    <h4>Nhận diện thương hiệu FurniBuy</h4>
                    <p>FurniBuy được lấy cảm hứng từ tự kết hợp của 2 thành phần: Furni – Buy. Trong đó “Furni” là một phần
                        viết tắt của chữ Furniture trong tiếng Anh, với nghĩa tiếng Việt là “nội thất, đồ đạc, vật dụng gia
                        đình”, còn chữ “Buy” có nghĩa là “mua”. Với mong muốn hướng đến xây dựng 1 thương hiệu được nhiều
                        người biết đến, một kênh tham khảo hàng đầu khi có nhu cầu mua sắm các sản phẩm nội thất, đồ trang
                        trí, vật dụng cơ bản.</p>
                    <p>Nhắc đến FurniBuy là nhắc đến các sản phẩm nội thất giá rẻ bình dân, kiểu dáng hiện đại và đặc biệt
                        là rất nhiều hàng có sẵn. Cực nhiều và Cực rẻ!</p>
                    <p>Chúng tôi là đơn vị trực tiếp sản xuất, tận dụng tính quy mô để triệt để giảm giá thành. Không phải
                        nhập qua nhiều trung gian, không lo đội giá khi tới tay khách hàng, luôn chủ động về nguồn hàng và
                        quản lý tốt chất lượng.</p>
                    <p>Áp dụng mô hình bán hàng kiểu kho. Sản phẩm từ xưởng trực tiếp đến các kho để khách xem và chọn, hoặc
                        trực tiếp từ xưởng sản xuất tới nhà khách hàng. Giảm thiểu chi phí thuê mặt bằng trên 1 đơn vị sản
                        phẩm cũng là cách để có giá bán rẻ hơn so với các đơn vị thuê mặt bằng showroom đắt đỏ.</p>
                    <p>FurniBuy.com mở các cửa hàng với diện tích trưng bày rộng để làm sao có thật nhiều hàng có sẵn để
                        khách hàng xem và chọn lựa. Showroom không hoa mỹ, nhưng sản phẩm nhiều để khách nhìn – sờ – ngồi
                        thử – trải nghiệm thực tế.</p>
                    <img src="{{ asset('images/furnibuy.jpg') }}" alt="furnibuy">
                    <h4>Các sản phẩm và dịch vụ chính mà công ty cung cấp</h4>
                    <p>- Nội thất phòng khách: bàn và ghế sofa, kệ tivi, tranh treo tường phòng khách, thảm trải sàn, tủ
                        giày dép, lọ hoa trang trí…</p>
                    <p>- Nội thất phòng ăn nhà bếp: bộ bàn ghế ăn, tủ bếp, tủ rượu, tranh phòng ăn…</p>
                    <p>- Nội thất phòng ngủ: giường ngủ, tủ quần áo, bàn trang điểm, tranh phòng ngủ, giá sách, bàn làm việc
                        tại nhà…</p>
                    <p>- Nội thất văn phòng: bàn lãnh đạo, ghế lãnh đạo, bàn và ghế nhân viên, bàn họp, quầy lễ tân…</p>
                    <p>- Thiết kế và thi công trọn gói các công trình, dự án.</p>
                    <h4>4 xưởng sản xuất và liên tục mở thêm quy mô</h4>
                    <p>Để chủ động nguồn hàng cũng như chiến lược giảm giá bán phục vụ đối tượng khách hàng bình dân. Nội
                        thất FurniBuy chú trọng đầu từ nhiều cho khâu sản xuất các sản phẩm chủ lực của mình. Hiện chúng tôi
                        có 2 xưởng sản xuất bàn ghế sofa, trong đó 1 xưởng chuyên sản xuất hàng theo form bán sẵn, và một
                        xưởng chuyên làm hàng đặt theo yêu cầu và các dự án.</p>
                    <p>Bên cạnh đó FurniBuy cũng đầu tư 1 xưởng chuyên sản xuất đồ nội thất gỗ công nghiệp với máy móc hiện
                        đại nhất hiện nay. Các công đoạn gần như được thực hiện 80% bởi các phần mềm và máy móc. Vừa giảm
                        được chi phí thuê nhân công, đảm bảo được độ chính xác và tinh tế của các sản phẩm làm ra.</p>
                    <p>FurniBuy còn có riêng 1 xưởng sản xuất tranh treo tường, là đơn vị cung cấp tranh treo tường số 1
                        miền Bắc với thương hiệu riêng là AmiA. Xưởng tranh của chúng tôi chuyên làm tranh in vải canvas,
                        tranh in gỗ, tranh vẽ sơn dầu… Bên cạnh các dòng tranh truyền thống và nhập từ các đối tác, làng
                        nghề khác.</p>
                    <h4>Làm hàng đặt theo yêu cầu riêng và các dự án</h4>
                    <p>Đến với các cửa hàng của nội thất FurniBuy.com quý khách sẽ dễ dàng chọn được các sản phẩm nội thất
                        bán sẵn cho gia đình mình. Tuy nhiên nếu bạn vẫn chưa ưng mẫu thiết kế, chưa thích màu sắc, cần kích
                        thước lớn hoặc nhỏ hơn… Hãy sử dụng dịch vụ đóng nội thất theo yêu cầu riêng của FurniBuy.com ,
                        chúng tôi có xưởng riêng chuyên làm hàng đặt để đáp ứng nhu cầu của bạn. Thời gian làm cực nhanh,
                        giá rẻ trực tiếp tại xưởng.</p>
                    <p>Nội thất FurniBuy.com còn là đối tác sản xuất chiến lượng của nhiều đơn vị thiết kế và thi công nội
                        thất trọn gói. Nhận cung cấp nội thất giá rẻ bình dân cho các công trình, dự án lớn hay hộ gia đình.
                    </p>
                    <p>Rất hân hạnh được phục vụ quý khách hàng!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
