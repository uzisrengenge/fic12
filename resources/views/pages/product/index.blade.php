@extends('layouts.app')

@section('title', 'Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Categories</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Product</a></div>
                    <div class="breadcrumb-item">All Product</div>
                </div>
            </div>
            <div class="section-body">
                {{-- <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div> --}}

                <div class="card card">
                    <div class="card-header">
                        <h4>Input Button</h4>
                        <form method="GET" action="{{ route('product.index') }}" class="card-header-form">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>





                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article article-style-b">
                            <div class="article-header">
                                <div class="article-image"
                                    data-background="{{ asset('storage/products/' . $product->image) }}">
                                </div>
                                <div class="article-badge">
                                    <div class="article-badge-item bg-primary"><i class="fas fa-tag"></i>{{ $product->category->name }}</div>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <h2><a href="#">{{ $product->name }}</a></h2>
                                </div>
                                <p>

                                    {{ Str::limit($product->descriptions, 100, '...') }}


                                </p>
                                <div class="article-cta">
                                    <button class="btn btn-primary dropdown-toggle"
                                    type="button"
                                    id="dropdownMenuButton2"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item ha-icon"
                                        href="{{ route('product.edit', $product->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <button style="font-size:13px" class="dropdown-item ham-icon">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                </form>

                                </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach



                </div>
                <div class="float-right">
                    {{ $products->withQueryString()->links() }}
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
