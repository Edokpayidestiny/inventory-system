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
                         <th>Selling Price</th>
                         <th>Last Updated</th>
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
                             <td>
                                 <form action="{{ route('admin.pricing.update', $product->uuid) }}" method="POST" class="d-flex align-items-center">
                                     @csrf
                                     @method('patch')
                                     <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                                         class="form-control form-control-sm me-2" style="width:120px;">
                                     <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                 </form>
                             </td>

                             <td>{{ $product->updated_at }}</td>
                             <td>
                                 <a href="{{ route('admin.pricing.history.show', $product->uuid) }}" class="btn btn-sm btn-info">
                                     View History
                                 </a>
                             </td>
                         </tr>
                     @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>
