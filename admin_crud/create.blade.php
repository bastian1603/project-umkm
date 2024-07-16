<title>Insert and Edit Product</title>


<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
</head>
<body>

    <div class="container mt-5" style="width: 33%;">
        <form class="mb-4" method="POST" action="{{ $product ? url('update/' . $product->id) : url('storing') }}" enctype="multipart/form-data">
          @csrf
        @if($product)
            @METHOD('PATCH')
        @endif
            <h1 class="text-center mb-4">Create Product</h1>

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ $product ? $product->product_name : old('product_name') }}" placeholder="nama produk">
                @error('product_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ $product ? $product->price : old('price') }}" placeholder="harga produk">
                @error('price')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id" class="form-control" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product && $product->category_id === $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <select name="brand_id" class="form-control" id="brand">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product && $product->brand_id === $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_pic">Product picture</label>
                <input type="text" class="form-control @error('product_pic') is-invalid @enderror" name="product_pic" id="product_pic" value="{{ $product ? $product->product_pic : '' }}" placeholder="link foto produk">
                @error('product_pic')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

          <button type="submit" id="btn-submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

<script src="{{ asset('scripts/jquery-3.5.0.min.js') }}"></script>
<script src="{{ asset('scripts/bootstrap.min.js') }}"></script>
</body>
</html>

</x-app-layout>