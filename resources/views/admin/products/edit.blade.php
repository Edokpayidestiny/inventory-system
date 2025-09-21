<x-layout>

    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Edit</h4>
                    <h6>Edit product</h6>
                    @section('image')
                        <div class="alert alert-success">
                            {{ session('image') }}
                        </div>
                    @endsection
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                       @method('PATCH')
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Enter Product Name" value="{{ old('name', $product->name) }}">
                                        <x-form-error name="name" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id">
                                        <option>Choose Category</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-form-error name="category_id" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control" name="brand">
                                        <option>Choose Brand</option>
                                        @foreach (brands() as $key => $brand)
                                            <option value="{{ $key }}">{{ $brand }}</option>
                                        @endforeach
                                    </select>
                                    <x-form-error name="brand" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" name="unit">
                                        <option>Choose Unit</option>
                                        @foreach (units() as $key => $unit)
                                            <option value="{{ $key }}">{{ $unit }}</option>
                                        @endforeach
                                    </select>
                                    <x-form-error name="unit"/>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{ old('value', $product->description) }}</textarea>
                                    <x-form-error name="description" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Markup Percent</label>
                                    <input type="text" class="form-control" name="markup_percent" placeholder="Enter Markup Percent" value="{{ old('markup_percent', $product->markup_percent) }}">
                                    <x-form-error name="markup_percent" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" name="qty"
                                        placeholder="Enter Quantity" value="{{ old('qty', $product->qty) }}">
                                    <x-form-error name="qty" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> Product Image</label>
                                    <div class="image-upload">
                                        <input type="file" class="form-control" name="image" value="{{ old('image', $product->image) }}">
                                        <x-form-error name="image" />
                                        <div class="image-uploads">
                                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" type="submit">Submit</button>
                                <button  class="btn btn-cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-layout>
