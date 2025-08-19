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
                         <th>Product Name</th>
                         <th>Category </th>
                         <th>Brand</th>
                         <th>price</th>
                         <th>Unit</th>
                         <th>Qty</th>
                         <th>Created By</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($products as $product)
                         <tr>
                             <td>
                                 <label class="checkboxs">
                                     <input type="checkbox">
                                     <span class="checkmarks"></span>
                                 </label>
                             </td>
                             <td class="productimgname">
                                 <a href="javascript:void(0);" class="product-img">
                                     <img src="{{ asset($product->image) }}" alt="product">
                                 </a>
                                 <a href="javascript:void(0);">{{ $product->name }}</a>
                             </td>
                             <td>{{ $product->category->name }}</td>
                             <td>{{ $product->brand }}</td>
                             <td>{{ $product->price }}</td>
                             <td>{{ $product->unit }}</td>
                             <td>{{ $product->qty }}</td>
                             <td>{{ $product->created_by }}</td>
                             <td>
                                 <a class="me-3" href="{{ route('admin.products.show', $product->uuid) }}">
                                     <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                                 </a>
                                 <a class="me-3" href="{{ route('admin.products.edit', $product->uuid) }}">
                                     <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                 </a>
                                 <a class="confirm-text" href="{{ route('admin.products.destroy', $product->uuid) }}"
                                     onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) document.getElementById('delete-form-{{ $product->uuid }}').submit();">
                                     <form id="delete-form-{{ $product->uuid }}"
                                         action="{{ route('admin.products.destroy', $product->uuid) }}" method="POST"
                                         style="display: none;">
                                         @csrf
                                         @method('DELETE')
                                     </form>
                                     <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">

                                 </a>
                             </td>
                         </tr>
                     @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>
