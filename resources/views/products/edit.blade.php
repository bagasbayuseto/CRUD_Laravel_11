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
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">

                    <div class="card-header">
                        <h3>Edit</h3>
                    </div>

                    <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}"
                        method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name', $product->name) }}"
                                    class="@error('name') is-invalid @enderror form-control form-control-sm"
                                    placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Sku <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('sku', $product->sku) }}"
                                    class="@error('sku') is-invalid @enderror form-control form-control-sm"
                                    placeholder="Sku" name="sku">

                                @error('sku')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Price <span
                                        class="text-danger">*</span></label>
                                <input type="number" value="{{ old('price', $product->price) }}"
                                    class="@error('price') is-invalid @enderror form-control form-control-sm"
                                    placeholder="Price" name="price">

                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control form-control-sm" placeholder="Description" cols="30" rows="5"
                                    name="description">{{ old('sku', $product->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                @if ($product->image != '')
                                    <img class="w-25 my-3" src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="" srcset="">
                                @endif
                                <input type="file" class="form-control form-control-sm" placeholder="Image"
                                    name="image">
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
