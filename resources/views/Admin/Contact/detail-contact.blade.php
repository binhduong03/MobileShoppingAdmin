@extends('index')

@section('index-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Chi tiết liên hệ</span></h4>

  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Xem chi tiết</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
          <div class="col-sm-12">
            <label for="LastFirst" class="form-label">Họ tên</label>
            <input name="username" id="LastFirst" class="form-control" value="{{$detail_contact->user->username}}"  readonly></input>
          </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <label for="Phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="Phone" class="form-control" value="{{$detail_contact->user->phone}}" readonly />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <label for="Email" class="form-label">Email</label>
                <input type="text" name="email" id="Email" class="form-control" value="{{$detail_contact->user->email}}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <label for="message" class="form-label">Nội dung tin nhắn</label>
                <textarea class="form-control" rows="5" readonly>{{$detail_contact->message}}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <label for="is_read" class="form-label">Đã đọc</label>
                <input type="text" class="form-control" value="{{$detail_contact->isread ? 'Đã đọc' : 'Chưa đọc'}}" readonly />
            </div>
        </div>

        
        <div class="row justify-content-end">
          <div class="col-sm-12">
                <form action="{{URL::to('update-isread/'.$detail_contact->contact_id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Quay lại</button>
                </form>
          </div>
        </div>

    </div>
  </div>
</div>
@endsection
