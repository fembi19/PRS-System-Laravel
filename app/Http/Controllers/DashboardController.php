<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Inventaris;
use App\Models\Pengadaan;
use App\Models\LogistikProduk;
use App\Models\LogistikBelanja;
use App\Models\LogistikOrder;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Dashboard';
    }

    public function index(Request $request)
    {
        //SessionData
        $Tipe = request()->session()->get('tipe');
        $StoreId = request()->session()->get('store_id');

        if ($Tipe == 'Office') {
            $this->data['JumlahIvn'] = Inventaris::count();
            $this->data['JumlahOrder'] = LogistikOrder::count();
            $this->data['JumlahPengadaan'] = Pengadaan::count();
        } else if ($Tipe == 'Outlet') {
            $this->data['JumlahIvn'] = Inventaris::where('store_id', $StoreId)->count();
            $this->data['JumlahOrder'] = LogistikOrder::where('store_id', $StoreId)->count();
            $this->data['JumlahPengadaan'] = Pengadaan::where('store_id', $StoreId)->count();
        } else if ($Tipe == 'Logistik') {
            $this->data['JumlahOrder'] = LogistikOrder::count();
            $this->data['JumlahBelanja'] = LogistikBelanja::count();
            $this->data['JumlahProductLogistik'] = LogistikProduk::count();
        } else if ($Tipe == 'Khusus') {
            $this->data['JumlahOrder'] = LogistikOrder::count();
            $this->data['JumlahBelanja'] = LogistikBelanja::count();
            $this->data['JumlahProductLogistik'] = LogistikProduk::count();
        } else {
            $this->data['JumlahUsers'] = User::count();
        }


        return view('Dashboard', $this->data);
    }
}
