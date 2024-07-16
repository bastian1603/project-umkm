<title>Edit Brand Category</title>


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

        <form class="mb-4" action="/editing_brand_category/{{ $title }}/{{ $temp->id }}" method="POST">
          @csrf
          @method('PATCH')
            <h1 class="text-center mb-4">Edit {{$title}}</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                value="{{ ($title ===  'brand') ? $temp->brand_name : $temp->category_name }}">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

          <button type="submit" id="btn-submit" class="btn btn-primary mt-3">Submit</button>

        </form>
    </div>

<div></div>

<script src="{{asset('scripts/jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('scripts/bootstrap.min.js')}}"></script>
</body>
</html>

</x-app-layout>