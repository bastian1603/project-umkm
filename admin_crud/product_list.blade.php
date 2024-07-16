<title>Our Products</title>

<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style/product_list.css')}}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
   
</head>
<body>

  <div class="container mt-5">
        <h1>Product List</h1>

  <table id="product" class="table table-striped" style="width:100%">
          <thead>
              <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Pic</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
              <td>{{ $loop->iteration }}</td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->brand->brand_name }}</td>
                      <td>{{ $product->category->category_name }}</td>
                      <td><img src="{{ $product->product_pic}}" alt="{{ $product->product_name }}" width="100px"></td>
                      
                      <td>
                      <a href="/edit/{{ $product->id }}" class="btn btn-success">Edit</a>
                        <form action="/delete/{{ $product->id }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </td>

              </tr>
            @endforeach
          </tbody>
      
        
      </table>
    </div>
  

  <div class="container mt-5">
        <h1>Category List</h1>

  <table id="category" class="table table-striped" style="width:100%">
          <thead>
              <tr>
              <th>#</th>
              <th>Category name</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
              <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $category->category_name }}</td>  
              <td>
                    <a href="/edit_category_brand/category/{{ $category->id }}" class="btn btn-success">Edit</a>
                      <form action="/deleting/category/{{ $category->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>

              </tr>
            @endforeach
          </tbody>
      
        
      </table>
    </div>


  <div class="container mt-5">
        <h1>Brand List</h1>

  <table id="brand" class="table table-striped" style="width:100%">
          <thead>
              <tr>
              <th>#</th>
              <th>Brand name</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($brands as $brand)
              <tr>
              <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->brand_name }}</td>  
                    <td>
                    <a href="/edit_category_brand/brand/{{ $brand->id }}" class="btn btn-success">Edit</a>
                      <form action="/deleting/brand/{{ $brand->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>

              </tr>
            @endforeach
          </tbody>
      
        
      </table>
    </div>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap Bundle JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<script> 
            $(document).ready(function(){
                $('#product').DataTable();
            })

            $(document).ready(function(){
                $('#brand').DataTable();
            })

            $(document).ready(function(){
                $('#category').DataTable();
            })
</script>
</body>
</html>
</x-app-layout>