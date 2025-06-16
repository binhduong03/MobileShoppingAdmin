@extends('index')

@section('index-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu /</span> Chỉnh sửa Menu</h4>

  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Chỉnh sửa Menu</h5>
    </div>

    <div class="card-body">
      <form action="{{ URL::to('Admin/update-menu/'.$menu->menu_id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên Menu -->
        <div class="mb-3">
          <label for="name" class="form-label">Tên Menu</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
        </div>

        <!-- Ảnh hiện tại -->
        <div class="mb-3">
          <label class="form-label">Ảnh hiện tại</label><br>
          @if ($menu->image)
            @if(Str::startsWith($menu->image, 'http'))
              <img src="{{ $menu->image }}" width="100" alt="Image">
            @else
              <img src="{{ asset('public/backend/assets/img/menu/' . $menu->image) }}" width="100" alt="Image">
            @endif
          @else
            <span class="text-danger">Không có ảnh</span>
          @endif
        </div>

        <!-- Loại ảnh -->
        <div class="mb-3">
          <label class="form-label">Loại hình ảnh</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="image_type" id="uploadRadio" value="upload" checked onchange="toggleImageInput()">
            <label class="form-check-label" for="uploadRadio">Tải ảnh lên</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="image_type" id="urlRadio" value="url" onchange="toggleImageInput()">
            <label class="form-check-label" for="urlRadio">Nhập URL ảnh</label>
          </div>
        </div>

        <!-- Chọn ảnh -->
        <div class="mb-3" id="upload_input">
          <label for="image" class="form-label">Chọn ảnh mới</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Nhập URL -->
        <div class="mb-3 d-none" id="url_input">
          <label for="image_url" class="form-label">URL ảnh</label>
          <input type="text" class="form-control" id="image_url" name="image_url" placeholder="https://example.com/image.jpg">
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
          <label for="status" class="form-label">Trạng thái</label>
          <select class="form-select" id="status" name="status" required>
            <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>Ẩn</option>
          </select>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
          <a href="{{ URL::to('Admin/all-menu') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Cập nhật
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleImageInput() {
    const upload = document.getElementById('upload_input');
    const url = document.getElementById('url_input');
    const type = document.querySelector('input[name="image_type"]:checked').value;
    if (type === 'upload') {
      upload.classList.remove('d-none');
      url.classList.add('d-none');
    } else {
      upload.classList.add('d-none');
      url.classList.remove('d-none');
    }
  }

  document.addEventListener("DOMContentLoaded", toggleImageInput);
</script>
@endsection
