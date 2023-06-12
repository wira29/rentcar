@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Edit Profile</h1>

            <div class="row">

                <div class="col-md-12 col-xl-12">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account" role="tabpanel">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>Sukses!</strong> {{ session('success')  }}
                                    </div>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('update-profile', ['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-3">
                                                <div class="text-center">
                                                    <img src="{{ $user->photo ? asset($user->photo) : asset('img/default_photo.png')  }}"
                                                         class="img mt-1 mb-3" width="200px" height="300px" id="photoPreview" style="object-fit:cover;"/>
                                                    {{-- <h6>Upload a different photo...</h6> --}}

                                                    <input type="file" id="photoButton" name="photo" class="form-control btn-file">
                                                </div>
                                            </div>

                                            <!-- edit form column -->
                                            <div class="col-md-9 personal-info">
                                                <h3>Personal info</h3>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Email:</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Update Password :</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="password" name="password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Nama</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="first_name" value="{{ $user->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">No Telepon</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="phone_number" value="{{ $user->phone_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Alamat</label>
                                                        <div class="col-lg-8">
                                                            <textarea class="form-control" name="address" id="" cols="10" rows="5">{{ $user->address }}</textarea>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
  function readURL(input, previewContainer) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#' + previewContainer).attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $('#photoButton').on('change', function () {
      readURL(this, 'photoPreview');
  });
</script>
@endsection
