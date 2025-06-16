@extends('index')

@section('index-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sản phẩm /</span> Thêm mới</h4>

  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Thêm Sản phẩm</h5>
    </div>
    <div class="card-body">
      <form action="{{ URL::to('Admin/save-product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Giá tiền</label>
          <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Mô tả</label>
          <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
        </div>

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

        <div class="mb-3" id="upload_input">
          <label for="image" class="form-label">Chọn ảnh</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3 d-none" id="url_input">
          <label for="image_url" class="form-label">URL ảnh</label>
          <input type="text" class="form-control" id="image_url" name="image" placeholder="https://example.com/image.jpg">
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Trạng thái</label>
          <select class="form-select" id="is_active" name="is_active" required>
            <option value="1" selected>Hiển thị</option>
            <option value="0">Ẩn</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Loại sản phẩm</label>
          <select class="form-select" id="type" name="type" required>
            <option value="1" selected>Laptop</option>
            <option value="0">Điện thoại</option>
          </select>
        </div>
        

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ URL::to('Admin/all-product') }}" class="btn btn-secondary">Quay lại</a>
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
</script>
@endsection
