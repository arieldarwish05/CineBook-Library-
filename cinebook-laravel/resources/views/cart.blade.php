<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - CineBook Library</title>
    <style>
        body { font-family: sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 650px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #3498db; color: white; }
        .btn { padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 13px; text-decoration: none; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-warning { background: #e67e22; color: white; }
        .btn-dark { background: #333; color: white; }
        .actions-bar { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
        .empty { text-align: center; color: #666; margin-top: 30px; }
        .alert { background: #2ecc71; color: white; padding: 10px; text-align: center; margin-bottom: 15px; border-radius: 6px; font-weight: bold; }
    </style>
</head>
<body>

    <!--Flash Successful Banner -->
    @if(session('succes'))
        <div style="padding: 12px 20px; background: #d4edda; color:155724; border: 1px solid #c3e6cb; border-radius; 4px; margin: 15px auto; max-width: 800px; font-weight: bold; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 12px 20px; background: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin 15px auto; max-width: 800px; font-weight: bold; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h1>🛒 Your Cart</h1>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <p class="empty">Your cart is currently empty.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Item Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $item['title'] }}">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="actions-bar">
                <a href="{{ route('catalog') }}" class="btn btn-dark">← Back to Catalog</a>
                
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Clear Cart</button>
                </form>
            </div>
        @endif

        @if(empty($cart))
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('catalog') }}" class="btn btn-dark">← Back to Catalog</a>
            </div>
        @endif
    </div>

</body>
</html>