@extends('layouts.dashboard')

@section('content')
@can('user_list')
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white" style="width:100%">User List <span class="float-right">Total: {{$total_user}}</span></h3>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                <tr>
                    <td>SL</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Photo</td>
                    <td>Action</td>
                </tr>

                @foreach ($users as $sl=>$user)
                <tr>
                    <td>{{$sl+1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->photo == null)
                            <img width="60" height="60" style="border-radius: 50%" src="{{ Avatar::create($user->name)->toBase64()}}"/>
                            @else
                            <img width="60" height="60" style="border-radius: 50%" src="{{asset('upload/user')}}/{{$user->photo}}" alt="">
                        @endif
                    </td>
                    <td>
                        <button data-id="{{route('user.delete', $user->id)}}" class="d_btn btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
               </table>
            </div>
        </div>
    </div>
</div>
@else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection

@section('footer_script')
<script>
    $('.d_btn').click(function(){
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
             if (result.isConfirmed) {
                 link = $(this).attr('data-id');
                 window.location.href = link;
             }
             })
       });
 
 </script>
    @if (session('user_del'))
         <script>
             Swal.fire(
                 'Deleted!',
                 'Your user has been deleted.',
                 'success'
                 )
         </script>
     
    @endif
@endsection