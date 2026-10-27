<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CineBook Library </title>
    <style>
        body { font-family: sans-serif; background: #f4f6f9; margin: 0; padding: 20px; } 
        .container {max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius; 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; } 
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; } 
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 14px; text-decoration: none; } 
        .btn-success { background: #2ecc71; color: white; width: 100%; }  
        .btn-danger { background: #e74c3c; color: white; padding: 5px 10px; font-size: 12px; } 
        .btn-dark { background: #333; color: white; display: inline-block; margin-bottom: 20px; } 
        table { width: 100%; border-collapse: collapse; margin-tap: 20px; } 
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; } 
        th { background: #3498db; color: white; }
        .alert { background: #2ecc71; color: white; padding: 10px; text-align: center; margin-bottom: 15px; border-radius: 6px; font-weight: bold; } 
    </style>
</head>
<body>

    <!-- Flash Successful Banner -->
    @if(session('success'))
    <div style="padding: 12px 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin: 15px auto; max-width: 800px; font-weight: bold; text-align: center;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="padding: 12px 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin: 15px auto; max-width: 800px; font-weight: bold; text-align: center;">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        <a href="{{ route('catalog') }}" class="btn btn-dark"> <- Back to StoreFont</a>
        <h> Admin Dashboard </h>

        @if (session('success'))
           <div class="alert">{{ session('success') }}</div>
        @endif

        <!--Add New Item Form -->
        <div style="background: #fafafa; padding: 15px; border; 1px solid #eee; border-radius: 6px; margin-bottom: 30px;">
            <h3>Add New Catalog Item</h3>
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 10px;">
                    <div class="form-group" style="flex: 1;">
                        <label>Title:</label>
                        <input type="text" name="title" required placeholder="e.g. Interstellar">
                    </div>
                    <div class="form-group" style="flex: 1;"></div>
                    <label>Type:</label>
                    <select name="type">
                        <option value="Book">Book</option>
                        <option value="Movie">Movie</option>
                        <option value="Audio">Audio</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px;">
                    <div class="form-group" style="flex: 1;">
                        <label>Detail Label (Author/Director/Artist):</label>
                        <input type="text" name="detailLabel" required placeholder="Director">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>Detail Value (Name):</label>
                        <input type="text" name="detaiVal" required placeholder="Christopher Nolen">
                    </div>
                    <div style="display: flex; gap: 10px; "></div>
                       <div class="form-group" style="flex: 1;">
                           <label>Price:</label>
                           <input type="text" name="price" required placeholder="$14.99">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>Image URL:</label>
                        <input type="text" name="image" required placeholder="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxU6bmdSQjOPJzxiHI8oK60vo0WLoUQQ6gxw-UoyusBg&s=10">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Add Item to Database</button>
            </form>
        </div>

        <!-- Existing Items Table -->
        <h3>Manage Existing Catalog Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </table>
            <tbody>
                @foreach ( $books as $book )
                   <tr>
                       <td>{{ $book->type }}</td>
                       <td>{{ $book->title }}</td>
                       <td>{{ $book->price }}</td>
                       <td>  
                            <form action="{{ route('admin.delete', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer;">
                                Delete
                            </button> 
                           </form>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>

     
</body>
</html>