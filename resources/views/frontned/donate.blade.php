@extends('frontned.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card my-5" style="border: 1px solid #ddd;">
                    <div class="card-header bg-primary py-3">
                        <h3 class="text-white">Donate for helpless people</h3>
                    </div>
                    @if (session('donate_succ'))
                        <div class="alert alert-success">{{session('donate_succ')}}</div>
                    @endif
                    <div class="card-body px-5">
                        <form action="{{route('donate.money')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                                @error('name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address">
                                @error('address')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control" name="phone">
                                @error('phone')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount">
                                @error('amount')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Donate</button>
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
@endsection