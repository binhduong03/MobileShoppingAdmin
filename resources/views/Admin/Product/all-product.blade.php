@extends('index')
@section('index-content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tables</h2>
    <!-- CTA -->
    <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple" href="https://github.com/estevanmaito/windmill-dashboard">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <span>Star this project on GitHub</span>
        </div>
        <span>View more &RightArrow;</span>
    </a>

    <!-- With avatar -->
    <div class="flex justify-between items-center mb-4">
        <h4 class="mb-0 text-lg font-semibold text-gray-600 dark:text-gray-300">Table with avatars</h4>
        <a href="{{ URL::to('Admin/add-product') }}" style="display: inline-block; padding: 8px 16px; background-color: #0d6efd; color: #fff; border-radius: 4px; text-decoration: none;" title="Thêm mới">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Hình ảnh</th>
                        <th class="px-4 py-3">Tên sản phẩm</th>
                        <th class="px-4 py-3">Giá tiền</th>
                        <th class="px-4 py-3">Mô tả</th>
                        <th class="px-4 py-3">Loại sản phẩm</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th class="px-4 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($all_product as $key => $product)
                    <tr class="text-gray-700 dark:text-gray-400">
                        
                        <td class="px-4 py-3 text-sm">
                            @if($product->image)
                                @if(Str::startsWith($product->image, 'http'))
                                    <img src="{{ $product->image }}" width="60" alt="Menu Image">
                                @else
                                   <img src="{{asset('public/backend/assets/img/product/' .$product->image)}}" class="avatar avatar-sm me-3 border-radius-lg image-zoom" tabindex="0" alt="productimg">
                                @endif
                            @else
                                <span class="text-red-500">Không có ảnh</span>
                            @endif

                            
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $product->name}}</td>
                        <td class="px-4 py-3 text-sm">{{ $product->price }}</td>
                        <td class="px-4 py-3 text-sm">{{ $product->description}}</td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm 
                                {{ $product->type == 0 ? 'bg-primary' : ($product->type == 1 ? 'bg-success' : 'bg-secondary') }}">
                                {{ $product->type == 0 ? 'Điện thoại' : ($product->type == 1 ? 'Laptop' : 'Khác') }}
                            </span>
                          </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <i class="{{ $product->is_active ? 'fas fa-toggle-on fa-2x text-primary' : 'fas fa-toggle-off fa-2x text-danger' }}"></i> <!-- Icon -->
                        </td>
                        <td class="px-4 py-3">
                            <!-- Nút chỉnh sửa -->
                            <a href="{{ URL::to('Admin/edit-product/'. $product->product_id) }}" class="text-primary" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Nút xóa -->
                             <a href="{{ URL::to('delete-product/'.$product->product_id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="text-danger ml-2" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">Showing 21-30 of 100</span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">2</button>
                        </li>
                        <li>
                            <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">3</button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">4</button>
                        </li>
                        <li>
                            <span class="px-3 py-1">...</span>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">8</button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">9</button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>
@endsection
