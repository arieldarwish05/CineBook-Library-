<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $storeName }}</title>
    <style>
        body { font-family: sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background: #fff; border-bottom: 1px solid #dee2e6; margin-bottom: 20px; border-radius: 8px; }
        .filter-container { text-align: center; margin-bottom: 25px; }
        .filter-btn { padding: 8px 16px; margin: 0 4px; border: none; border-radius: 4px; background: #e0e0e0; cursor: pointer; text-decoration: none; color: #333; font-weight: bold; }
        .filter-btn.active { background: #3498db; color: white; }
        .grid { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .card { background: white; border-radius: 8px; width: 220px; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; flex-direction: column; justify-content: space-between; }
        .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; }
        .card h3 { font-size: 18px; margin: 10px 0 5px; }
        .card p { margin: 3px 0; color: #666; font-size: 14px; }
        .price { font-weight: bold; color: #2ecc71; font-size: 16px; margin-top: 8px; }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">🎬 {{ $storeName }} 📚</h1>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('cart.view') }}" style="padding: 8px 14px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                View Cart
            </a>

            @auth
                <span style="font-weight: bold; color: #333;">Hi, {{ auth()->user()->name }}</span>
                <a href="{{ route('admin.index') }}" style="padding: 8px 14px; background: #8e44ad; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Admin Panel
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="padding: 8px 14px; background: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="padding: 8px 14px; background: #2ecc71; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Login
                </a>
                <a href="{{ route('register') }}" style="padding: 8px 14px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Register
                </a>
            @endauth
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: #2ecc71; color: white; padding: 12px; text-align: center; margin: 0 auto 20px auto; max-width: 600px; border-radius: 6px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 12px 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin: 15px auto; max-width: 600px; font-weight: bold; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Bar Form -->
    <div style="text-align: center; margin-bottom: 20px;">
        <form action="{{ route('catalog') }}" method="GET" style="display: inline-block;">
            @if($filter !== 'All')
                <input type="hidden" name="type" value="{{ $filter }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search titles..." style="padding: 8px 12px; width: 220px; border: 1px solid #ccc; border-radius: 4px; outline: none;">
            <button type="submit" style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Search</button>
            
            @if(request('search'))
                <a href="{{ route('catalog', ['type' => $filter]) }}" style="margin-left: 8px; padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: bold;">Reset</a>
            @endif
        </form>
    </div>

    <!-- Category Filter Bar -->
    <div class="filter-container">
        <a href="/?type=All" class="filter-btn {{ $filter === 'All' ? 'active' : '' }}">All</a>
        <a href="/?type=Book" class="filter-btn {{ $filter === 'Book' ? 'active' : '' }}">Books</a>
        <a href="/?type=Movie" class="filter-btn {{ $filter === 'Movie' ? 'active' : '' }}">Movies</a>
        <a href="/?type=Audio" class="filter-btn {{ $filter === 'Audio' ? 'active' : '' }}">Audio</a>
    </div>

    <!-- Product Display Grid -->
    <div class="grid">
        @forelse($displayProducts as $item)
            <div class="card">
                <div>
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <h3>{{ $item['title'] }}</h3>
                    <p><strong>{{ $item['detailLabel'] }}:</strong> {{ $item['detailVal'] }}</p>
                    <p><strong>Type:</strong> {{ $item['type'] }}</p>
                </div>
                <div class="price">${{ $item['price'] }}</div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <input type="hidden" name="title" value="{{ $item['title'] }}">
                    <input type="hidden" name="price" value="{{ $item['price'] }}">
                    <button type="submit" style="width:100%; padding: 8px; background: #2ecc71; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                        Add to Cart
                    </button>
                </form>
            </div>
        @empty
            <p style="color: #666; font-weight: bold;">No items found in the catalog. Go to the Admin Panel to add some!</p>
        @endforelse
    </div>

</body>
</html>