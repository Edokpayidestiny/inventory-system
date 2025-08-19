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
                         <th>Category</th>
                         <th>Current stock</th>
                         <th>Status</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($product as $products)
                         <tr>
                             <td>
                                 <label class="checkboxs">
                                     <input type="checkbox">
                                     <span class="checkmarks"></span>
                                 </label>
                             </td>
                             <td class="productimgname">
                                 <a href="" class="product-img">
                                     <img src="{{ asset($products->image) }}" alt="product">
                                 </a>
                                 <p>{{ $products->name }}</p>
                             </td>
                             <td>{{ $products->Category->name }}</td>
                             <td>{{ $products->qty }}</td>
                             <td>
                                 @if ($products->qty > 20)
                                     <span class="badge bg-success">In Stock</span>
                                 @elseif ($products->qty > 0 && $products->qty <= 20)
                                     <span class="badge bg-warning">Low Stock</span>
                                 @else
                                     <span class="badge bg-danger">Out of Stock</span>
                                 @endif
                             </td>
                             <td>
                                 <div class="dropdown">
                                     <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                         id="dropdownMenuButton{{ $products->uuid }}" data-bs-toggle="dropdown"
                                         aria-expanded="false">
                                         Actions
                                     </button>
                                     <ul class="dropdown-menu"
                                         aria-labelledby="dropdownMenuButton{{ $products->uuid }}">
                                         <li>
                                             <a class="dropdown-item"
                                                 href="{{ route('admin.inventory.show', $products->uuid) }}">
                                                 View Details
                                             </a>
                                         </li>
                                         <li>
                                             <a class="dropdown-item"
                                                 href="{{ route('admin.inventory.edit', $products->uuid) }}">
                                                 Adjust Stock
                                             </a>
                                         </li>
                                     </ul>
                                 </div>
                             </td>
                         </tr>
                     @endforeach

                 </tbody>
             </table>``
         </div>
     </div>
 </div>
