<title>Insert From Excel</title>
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
        <form class="mb-4" method="POST" action="/insert_excel" enctype="multipart/form-data">
          @csrf
            <h1 class="text-center mb-4">Create Product</h1>

            <div class="form-group">
                <label for="excel_file">Insert a file</label>
                <input type="file" class="form-control @error('excel_file') is-invalid @enderror" name="excel_file" id="excel_file">
                @error('excel_file')<span class="test-danger">{{ $message }}</span>@enderror
            </div>

          <button type="submit" id="btn-submit" class="btn btn-primary mt-3">Submit</button>

        </form>
    </div>

<script src="{{asset('scripts/jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('scripts/bootstrap.min.js')}}"></script>
</body>
</html>

</x-app-layout>