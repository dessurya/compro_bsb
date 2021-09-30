@extends('cms.layout.base')

@section('title')
User Profile
@endsection

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('cms.user.profile-update') }}" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Form User Profile <b>{{ $user->name }}</b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="col form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Your Current Password" required>
                            </div>
                            <div class="col form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Your New Password">
                            </div>
                            <div class="col form-group">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Your Confirm New Password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endpush

@push('script')
    @if(Session::has('status'))
    <script>
        $( document ).ready(function() {
            let response = '{{ Session::get('status') }}'
            response = atob(response)
            response = JSON.parse(response)
            $.each(response.validator, function(key,row_data) {
                showPNotify(key,row_data,response.alert)
            })
        });
    </script>
    @endif
@endpush
