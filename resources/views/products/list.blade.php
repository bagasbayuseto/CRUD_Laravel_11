<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simppel</h3>
    </div>
    <div class="container">

        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-12 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="card border-0 shadow-lg my-4">

                    <div class="card-header">
                        <h3>List Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <tr>
                                <td>ID</td>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Sku</td>
                                <td>Price</td>
                                <td>Creat at</td>
                                <td>Action</td>
                            </tr>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img width="50"
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="" srcset="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning">Edit</a>

                                            <a href="#" onclick="deleteProduct({{ $product->id }});"
                                                class="btn btn-danger">Delete</a>

                                            <form id="delete-product-form-{{ $product->id }}"
                                                action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @csrf

                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

<script>
    function deleteProduct(id) {
        if (confirm("apakah yakin ?")) {
            document.getElementById("delete-product-form-" + id).submit();
        }
    }
</script>
