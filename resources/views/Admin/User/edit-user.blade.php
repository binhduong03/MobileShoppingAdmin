@extends('index')

@section('index-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Người dùng /</span> Chỉnh sửa</h4>

  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Chỉnh sửa Người dùng</h5>
    </div>
    <div class="card-body">
      <form action="{{ URL::to('Admin/update-user/'.$user->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
          <label for="username" class="form-label">Tên người dùng</label>
          <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu (nếu muốn đổi)</label>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu mới (hoặc để trống)">
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Số điện thoại</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Địa chỉ</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
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

        <!-- Hiển thị ảnh hiện tại -->
        <div class="mb-3">
          @if($user->avatar)
            @if(Str::startsWith($user->avatar, 'http'))
              <img src="{{ $user->avatar }}" width="100">
            @else
              <img src="{{ asset('public/backend/assets/img/user/'.$user->avatar) }}" width="100">
            @endif
          @else
            <span class="text-danger">Chưa có ảnh</span>
          @endif
        </div>

        <div class="mb-3" id="upload_input">
          <label for="avatar" class="form-label">Chọn ảnh</label>
          <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
        </div>

        <div class="mb-3 d-none" id="url_input">
          <label for="avatar_url" class="form-label">URL ảnh</label>
          <input type="text" class="form-control" id="avatar_url" name="avatar_url" placeholder="https://example.com/avatar.jpg" value="{{ $user->avatar }}">
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Vai trò</label>
          <select class="form-select" id="role" name="role" required>
            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Người dùng</option>
            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Khác</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
