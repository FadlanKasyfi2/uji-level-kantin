<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantin;
use App\Order;
use App\Transaksi;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kantin = Kantin::all();
        return view('menu', compact('kantin'));
    }

    public function order(Request $req,$id)
    {
       $makanan = Kantin::where('id', $id)->first();
       
        $now = Carbon::now();

        $cek_order = Order::where('id_makanan',$id)->where('status', 'menunggu pembayaran')->first();

        if (empty($cek_order)) {
 
        $order = new Order;
        $order->id_user = Auth::user()->id;
        $order->id_makanan = $id;
        $order->tanggal = $now;
        $order->jumlah_pesan = $req->jumlah_pesan;
        $order->save();
        }
        
    else{
            $order = Order::where('id_makanan',$id)->where('status', 'menunggu pembayaran')->first();

            $order->jumlah_pesan = $order->jumlah_pesan + $req->jumlah_pesan;
            $order->save();
    }
        return redirect('/home');
    } 

    public function keranjang()
    {
        $id_user = Auth::user()->id;
        $order = Order::where('id_user',$id_user)->where('status', 'menunggu pembayaran')->get();
        

        return view('cart', compact('order'));
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return redirect('/keranjang');
    }

    public function payment($id)
    {
        $order = Order::where('id', $id)->first();
        $now = Carbon::now();

        $transaksi = new Transaksi;
        $transaksi->id_user = $order->id_user;
        $transaksi->id_order = $order->id;
        $transaksi->tanggal = $now;
        $transaksi->total_bayar = $order->kantin->harga * $order->jumlah_pesan;

        $order->status = 'sudah melakukan pembayaran';

        $order->save();
        $transaksi->save();

        return redirect('/keranjang');
        
    }

}
