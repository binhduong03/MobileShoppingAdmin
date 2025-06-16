@extends('index')

@section('index-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Người dùng /</span> Thêm mới</h4>

  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Thêm Người dùng</h5>
    </div>
    <div class="card-body">
      <form action="{{ URL::to('Admin/save-user') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="username" class="form-label">Tên người dùng</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Số điện thoại</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Địa chỉ</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
        </div>

        <div class="mb-3">
          <label class="form-label">Hình ảnh đại diện</label><br>
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
          <label for="avatar" class="form-label">Chọn ảnh</label>
          <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
        </div>

        <div class="mb-3 d-none" id="url_input">
          <label for="avatar_url" class="form-label">URL ảnh</label>
          <input type="text" class="form-control" id="avatar_url" name="avatar_url" placeholder="https://example.com/avatar.jpg">
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Vai trò</label>
          <select class="form-select" id="role" name="role" required>
            <option value="0" selected>Người dùng</option>
            <option value="1">Admin</option>
            <option value="2">Khác</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ URL::to('Admin/all-user') }}" class="btn btn-secondary">Quay lại</a>
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
