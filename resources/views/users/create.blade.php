@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>{{ $action }} {{ $title }}</h1>
                </div>
                <form action="{{ $route . (isset($user->id) ? ("/" . $user->id) : "") }}" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @if(isset($user))
                                    @method("PUT")
                                @endif

                                <div class="row margin-top">
                                    @error("name")
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input maxlength="100" value="{{ $user->name ?? old("name") }}" class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("email")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Email <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input maxlength="100" value="{{ $user->email ?? old("email") }}" class="form-control" name="email" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("password")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Password @if(isset($user)) (Leave Blank If You Want The Password Not To Be Changed) @endif</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input maxlength="100" value="{{ old("password") }}" class="form-control" name="password" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("role")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Role <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="role" class="form-control">
                                            <option value="">Select Role</option>
                                            @foreach($roles as $bin => $role)
                                                <option @if(isset($user) && $user->role == $bin) selected @elseif(old("role") == $bin) selected @endif value="{{ $bin }}">{{ ucfirst(trans($role)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <input class="btn btn-success btn-block btn-lg" id="submit-button" type="submit" name="yt0" value="{{ $action }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
