 <div class="card">
     <div class="card-body">
         <div class="table-top">
             <div class="search-set">
                 <div class="search-path">
                     <a class="btn btn-filter" id="filter_search">
                         <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                         <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                     </a>
                 </div>
                 <div class="search-input">
                     <input type="text" wire:model.live="search" class="form-control"
                         placeholder="Search by product, cashier, or payment...">

                     @error('search')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>

         </div>

         <div class="table-responsive">
             <table class="table  datanew">
                 <thead>
                     <tr>
                         <th>
                             <label class="checkboxs">
                                 <input type="checkbox" id="select-all">
                                 <span class="checkmarks"></span>
                             </label>
                         </th>
                         <th>Category name</th>
                         <th>Category Code</th>
                         <th>Description</th>
                         <th>Created By</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($categories as $category)
                         <tr>
                             <td>
                                 <label class="checkboxs">
                                     <input type="checkbox">
                                     <span class="checkmarks"></span>
                                 </label>
                             </td>
                             <td class="productimgname">
                                 <a href="javascript:void(0);" class="product-img">
                                     <img src="{{ asset($category->image) }}" alt="Category Image">



                                     {{-- {{ $category->image  }} --}}
                                 </a>
                                 <a href="#">{{ $category->name }}</a>
                             </td>
                             <td>{{ $category->code }}</td>
                             <td>{{ $category->description }}</td>
                             <td>{{ $category->created_by }}</td>
                             <td>
                                 <a class="me-3" href="{{ route('admin.categories.edit', $category->uuid) }}">
                                     <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                 </a>
                                 <a class="me-3 confirm-text"
                                     href="{{ route('admin.categories.destroy', $category->uuid) }}"
                                     onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{ $category->uuid }}').submit(); }">
                                     <form id="delete-form-{{ $category->uuid }}"
                                         action="{{ route('admin.categories.destroy', $category->uuid) }}"
                                         method="POST" style="display: none;">
                                         @csrf
                                         @method('DELETE')
                                     </form>
                                     <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                 </a>
                             </td>
                         </tr>
                     @endforeach

                 </tbody>
             </table>``
         </div>
     </div>
 </div>
