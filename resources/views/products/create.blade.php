@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>
    <div id="app">
        <create-product :variants="{{ $variants }}">Loading</create-product>
    </div>

    <form action="" method="POST" role="form">

        {{-- <form action="{{ route('admin.products.index.blade.php') }}" method="POST" role="form"> --}}
        @csrf
        <div class="tile-body">
            <div class="product_container"></div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Product Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                placeholder="Product Name" id="name" name="name" value="{{ old('name') }}" />
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('name')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="sku">Product SKU</label>
                            <input class="form-control @error('sku') is-invalid @enderror" type="text"
                                placeholder="Product SKU" id="sku" name="sku" value="{{ old('sku') }}" />
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea name="description" id="description" rows="8" class="form-control"></textarea>
                        </div>
                    </div>
                </div>


                <div class='content_dropbox'>
                    <form action="" class='dropzone'>
                        @csrf
                        <div class="image">
                            <label>
                                <h4>Media</h4>
                            </label>
                            <hr>
                            <input type="file" class="form-control" required name="image">
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-left">
                    <button class="btn btn-success" type="submit">Save</button>
                    <button class="btn btn-secondary" href=""> Cancel</button>
                </div>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#categories').select2();
        });
    </script>
@endpush
