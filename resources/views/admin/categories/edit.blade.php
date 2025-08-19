<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Edit Category</h4>
                    <h6>Edit product Category</h6>

                    @if(session('image'))
                        <div class="alert alert-danger">
                            {{ session('image') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="form-control">
                                    <div class="image-uploads">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                            <button class="btn btn-cancel">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout>
