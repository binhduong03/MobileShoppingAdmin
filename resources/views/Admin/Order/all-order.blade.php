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
    <?php
        if ($message = Session::get('success')) {
            echo '<div id="notification" class="notification success">' . $message . '</div>';
        }
        if ($message = Session::get('error')) {
            echo '<div id="notification" class="notification error">' . $message . '</div>';
        }
    ?>

    <!-- With avatar -->


    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Họ tên</th>
                        <th class="px-4 py-3">Số điện thoại</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th class="px-4 py-3">Tổng tiền</th>
                        <th class="px-4 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($all_order as $key => $order)
                    

                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $order->user->username}}</td>
                        <td class="px-4 py-3 text-sm">{{ $order->user->phone}}</td>
                        <td class="px-4 py-3 text-sm status-cell" data-order-id="{{ $order->order_id }}" data-status="{{ $order->status }}">
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ URL::to('update-status') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn {{ $order->status == 0 ? 'btn-warning' : 'btn-outline-warning' }}">Chờ xử lý</button>
                                </form>
                                <form method="POST" action="{{ URL::to('update-status') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->order_id}}">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn {{ $order->status == 1 ? 'btn-info' : 'btn-outline-info' }}">Đang vận chuyển</button>
                                </form>
                                <form method="POST" action="{{ URL::to('update-status') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn {{ $order->status == 2 ? 'btn-success' : 'btn-outline-success' }}">Đang giao hàng</button>
                                </form>
                                <form method="POST" action="{{ URL::to('update-status') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="btn {{ $order->status == 3 ? 'btn-success' : 'btn-outline-success' }}">Đã giao</button>
                                </form>
                                <form method="POST" action="{{ URL::to('update-status') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                    <input type="hidden" name="status" value="4">
                                    <button type="submit" class="btn {{ $order->status == 4 ? 'btn-danger' : 'btn-outline-danger' }}">Đã hủy</button>
                                </form>
                            </div>
                        </td>




                        <td class="px-4 py-3 text-sm">{{($order->total_amount).' '.'VNĐ'}}</td>
                         
                        
                      </td>
                        <td class="px-4 py-3">
                            <!-- Nút xem -->
                            <a href="{{ URL::to('Admin/detail-order/'. $order->order_id) }}" class="text-primary" title="Chỉnh sửa">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Nút xóa -->
                            <a href="{{ URL::to('delete-order/'. $order->order_id) }}" class="text-danger ml-2" title="Xóa">
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