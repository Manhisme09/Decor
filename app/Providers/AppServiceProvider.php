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
            $categorys = DanhMuc::select('id', 'ten_danh_muc', 'parent_id')
                ->where('parent_id', '=', 0)
                ->whereIn('id', [6, 10])
                ->orderBy('id','asc')
                ->get();
            $categorys_big = DanhMuc::select('id', 'ten_danh_muc', 'parent_id')
                ->where('parent_id', '=', 0)
                ->whereNotIn('id', [6, 10])
                ->orderBy('id', 'asc')
                ->get();
            $view->with(compact('categorys', 'categorys_big'));
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
