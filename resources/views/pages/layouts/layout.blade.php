<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/iconlogo.PNG') }}">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    {{--
    <link rel="stylesheet" type="text/css" href=" {{ asset('pages/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href={{ asset('./pages/font/fontawesome-free-5.15.4-web/css/all.min.css') }}>
    <link rel="stylesheet" href={{ asset('./pages/css/grid.css') }}>
    <link rel="stylesheet" href={{ asset('./pages/css/style.css') }}>
    <link rel="stylesheet" href={{ asset('./pages/css/base.css') }}>
    <link rel="stylesheet" href={{ asset('./pages/css/responsive.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/siiimple-toast/dist/style.css" rel="stylesheet">
    @yield('title')
</head>

<body id="cart">
    @include('pages/layouts/header')

    @yield('content')
    <div id="backtop">
        <i class="fa fa-chevron-up"></i>
    </div>

    @include('pages/layouts/footer')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src={{ asset('pages/main.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/siiimple-toast/dist/siiimple-toast.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    {{-- <script>
        $(document).ready(function($) {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $(".header").addClass('fixNav')
                } else {
                    $(".header").removeClass('fixNav')
                }
            })
        })
    </script> --}}

    <script>
        $(document).ready(function($) {
            $(window).scroll(function() {
                if ($(this).scrollTop()) {
                    $("#backtop").fadeIn()
                } else {
                    $("#backtop").fadeOut()
                }
            });
            $("#backtop").click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);
            });
        });
    </script>
    <script type="text/javascript">
        $(".alert").fadeTo(4500, 800).slideUp(800, function() {
            $(".alert").slideUp(800);
        });
    </script>
    <script>
        function addCart(id) {
            $.ajax({
                url: '/them-gio-hang/' + id,
                type: 'GET',
            }).done(function(response) {
                $("#cart").empty();
                $("#cart").html(response);
                siiimpleToast.success('Sản phẩm đã được thêm vào giỏ hàng !')
            })
        }

        function deleteCart(id) {
            $.ajax({
                url: '/xoa/' + id,
                type: 'GET',
            }).done(function(response) {
                $("#cart").empty();
                $("#cart").html(response);
                siiimpleToast.success('Đã xoá sản phẩm khỏi giỏ hàng !');
            })
        }

        function updateItemCart(id) {
            var value = $("#select-" + id).val();
            $.ajax({
                url: '/cap-nhat-gio-hang/' + id + '/' + value,
                type: 'GET',
            }).done(function(response) {
                $("#cart").empty();
                $("#cart").html(response);
                siiimpleToast.success('Cập nhật giỏ hàng thành công!');
            })
        }

        $(document).ready(function() {
            $('.language').click(function () {
                $('.language-item').toggleClass('active');
            });

        });

        $(document).ready(function() {
            $('.myaccount').click(function () {
                $('.account-item').toggleClass('active-account');
            });

        });

        $(function() {
            var minPrice = parseInt($("#min_price").val());
            var maxPrice = parseInt($("#max_price").val());

            $("#price_slider").slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
            });
        });

        $(function() {
    var minPrice = parseInt($("#min_price").val());
    var maxPrice = parseInt($("#max_price").val());
    var originalMinPrice = minPrice;
    var originalMaxPrice = maxPrice;

    $("#price_slider").slider({
      range: true,
      min: minPrice,
      max: maxPrice,
      values: [minPrice, maxPrice],
      slide: function(event, ui) {
        if (ui.values[0] !== minPrice && ui.values[0] !== originalMinPrice) {
          minPrice = ui.values[0];
          $("#min_price").val(minPrice);
        }
        if (ui.values[1] !== maxPrice && ui.values[1] !== originalMaxPrice) {
          maxPrice = ui.values[1];
          $("#max_price").val(maxPrice);
        }
        $(".from").text(formatPrice(ui.values[0]) + " VND");
        $(".to").text(formatPrice(ui.values[1]) + " VND");
      }
    });

    // Format giá tiền
    function formatPrice(price) {
      return price.toLocaleString({ style: "currency", currency: "VND" });
    }
  });
    </script>
    @yield('script')
</body>

</html>
