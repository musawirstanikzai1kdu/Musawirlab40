<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Reading List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">My Reading List</a>
            <div class="d-flex align-items-center gap-3 text-white">
                <span class="small">Signed in as {{ auth()->user()->name ?? auth()->user()->email }}</span>
                @if (\Illuminate\Support\Facades\Route::has('logout'))
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-outline-light btn-sm" type="submit">Log out</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4">
                    <h1 class="h2 mb-1">Reading Dashboard</h1>
                    <p class="text-muted mb-0">Register books and keep track of your personal reading list.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please correct the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h2 class="h5 mb-0">Register a Book</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label for="title" class="form-label">Title</label>
                                    <input
                                        id="title"
                                        name="title"
                                        type="text"
                                        maxlength="150"
                                        value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        required
                                    >
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="author" class="form-label">Author</label>
                                    <input
                                        id="author"
                                        name="author"
                                        type="text"
                                        maxlength="100"
                                        value="{{ old('author') }}"
                                        class="form-control @error('author') is-invalid @enderror"
                                        required
                                    >
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="pages" class="form-label">Pages</label>
                                    <input
                                        id="pages"
                                        name="pages"
                                        type="number"
                                        min="1"
                                        max="10000"
                                        step="1"
                                        value="{{ old('pages') }}"
                                        class="form-control @error('pages') is-invalid @enderror"
                                        required
                                    >
                                    @error('pages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Register Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">My Books</h2>
                        <span class="badge text-bg-secondary">{{ $books->count() }} total</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 80px;">No.</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col" style="width: 120px;">Pages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->pages }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            You have not registered any books yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
