<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">

<div class="row my-5">
    <div class="col-md-12">
        <a href="{{ url('home')}}" class="btn btn-warning mb-4"> <i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card mb-5">
            <div class="card-body">
                <h3>My Cart</h3>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Makanan</th>
                            <th>Harga Makanan</th>
                            <th>Jumlah Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ;?>
                        @foreach($order as $data)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->kantin->nama_menu }}</td>
                            <td>Rp. {{number_format($data->kantin->harga) }}</td>
                            <td>{{$data->jumlah_pesan }}</td>
                            <td>Rp. {{number_format($data->kantin->harga*$data->jumlah_pesan)}}</td>
                            <td>
                                <form action="{{url('/keranjang')}}/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete<i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{url('/keranjang/bayar')}}/{{$data->id}}" method="post"
                                    class="d-inline">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Transaksi<i class="fas fa-cash-register"></i></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.row -->

</div>`
</body>
</html>