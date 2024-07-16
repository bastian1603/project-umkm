<title>Insert New Brand & Category</title>

<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('style/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
</head>
<body>


    <div class="container mt-5" style="width: 33%;">

        <!-- 
            form for craeting new data product
        -->

        <form class="mb-4" action="/add_brand_category" method="POST">
          @csrf
            <h1 class="text-center mb-4">Add Brand and Category</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

            <select name="type" id="type" class="form-control">
              <option value="Brand">Brand</option>
              <option value="Catefory">Category</option>
            </select>

          <button type="submit" id="btn-submit" class="btn btn-primary mt-3">Submit</button>

        </form>
    </div>

<div></div>

<script src="{{asset('scripts/jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('scripts/bootstrap.min.js')}}"></script>
</body>
</html>

</x-app-layout>