<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\LoaiSanPham;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('pages.layouts.header', function($view){
            $danhmuc = DanhMuc::select('id', 'ten_danh_muc', 'parent_id')->orderBy('id','asc')->get();
            $view->with('danhmuc', $danhmuc);
        });

        // view()->Composer('pages.layouts.header', function($view){
        //     $carts = Session('Cart');
        // if($carts != Null){
        // $count = count($carts->sanpham);
        // }
        // else{
        //     $count = 0;
        // }
        //     $view->with('count',$count);
        // });
    }
}
