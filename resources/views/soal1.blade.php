<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMN backend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @include('header')

    <section class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <form action="/soal1" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Nama Product</label>
                <select class="form-select" aria-label="product" name="product_id">
                    <option selected>Produk</option>
                    @foreach ($product as $p)
                        <option value="{{$p->id}}">{{$p->name." | ".$p->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tanggal Awal Produksi</label>
                <input type="date" class="form-control" id="" name="pr_date" placeholder="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">QTY Produksi</label>
                <input type="number" class="form-control" id="" name="planned_qty" placeholder="">
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
