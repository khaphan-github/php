@extends('client.layout.pages-layout')
@section('content')



 <div class="container rounded bg-white mt-5 mb-5">
     <h2>Thông tin tài khoản</h2>
    <div class="row">
        <!-- <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" 
                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{ auth()->user()->name }}</span><span class="text-black-50">{{ auth()->user()->email}}</span><span> </span></div>
        </div> -->
        <div class="">
            <!-- <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('THÔNG TIN TÀI KHOẢN') }}</h6>
            </div> -->
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text">
                            {{$errors->first()}}</span>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text">
                            {{ session('success') }}</span>
                     
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Họ và tên') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" disabled placeholder="@example.com" id="user-email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Số điện thoại') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user.location" class="form-control-label">{{ __('Địa chỉ') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>
                    <!-- <div class="form-group">
                        <label for="about">{{ 'QUYỀN' }}</label>
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            <input class="form-control" id="about_me" placeholder="Say something about yourself" name="about_me" disabled value="{{auth()->user()->about_me}}" />
                        </div>
                    </div> -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md mt-4 pl-4 pr-4 mb-4">{{ 'Lưu' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <h2> Thông tin đơn hàng</h2>

  <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Mã đơn hàng</th>
      <th>Phương thức thanh toán</th>
      <th>Trạng thái</th>
      <th>Tổng tiền</th>
      <th>Ngày đặt</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if ($orders->isEmpty())
    <tr>
        <td colspan="5">No orders found.</td>
    </tr>
    @else
        @foreach ($orders as $order)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <p class="text-muted mb-0">{{ $order->id }}</p>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">Thanh toán Online: <strong>{{ $order->payment_method }}</strong> </p>
                    <!-- <p class="text-muted mb-0">IT department</p> -->
                </td>
                <td>
                      @if($order->status == 'COMPLETED')
                <span class="badge badge-success rounded-pill d-inline">Thành công</span>
            @else
                <span class="badge badge-danger rounded-pill d-inline">Thất bại</span>
            @endif
                </td>
                 <td>
                    <span class="text-right">{{ $order->total_price}}</span>
                </td>
                <td>
                    <span class="">{{ $order->created_at }}</span>
                </td>
                <td>
                    <a href="{{ route('detailOrder', ['id' => $order->id]) }}" class="btn btn-primary">
                        Xem chi tiết
                    </a>
                    </button>
                </td>
            </tr>
        @endforeach
    @endif

  </tbody>
</table>
</div>
</div>
</div> 
<div>
    <div class="container-fluid py-4">
        
    </div>
</div>


@endsection