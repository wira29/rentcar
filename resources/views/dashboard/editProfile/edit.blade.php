@extends('dashboard.layout.app')

@section('content')

<div class="container bootstrap snippets bootdey">
  <h1 class="text-primary">Edit Profile</h1>
  <hr>
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
        
        <div class="form-horizontal">
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
          <br>
          @php
              $explodeName = explode(" ", $user->name);

              $first_name = trim($explodeName[0]);
              $last_name = $explodeName[1] != '' ? trim($explodeName[1]) : ''; 

          @endphp
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="first_name" value="{{ $first_name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="last_name" value="{{ $last_name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="phone_number" value="{{ $user->phone_number }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="address" value="{{ $user->address }}">
            </div>
          </div>
          
          
          {{-- <div class="form-group">
            <label class="col-lg-3 control-label">Time Zone:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_time_zone" class="form-control">
                  <option value="Indonesia">(GMT-10:00) Hawaii</option>
                  <option value="Alaska">(GMT-09:00) Alaska</option>
                  <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                  <option value="Arizona">(GMT-07:00) Arizona</option>
                  <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                  <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                  <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                  <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                </select>
              </div>
            </div>
          </div> --}}
          <br>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </div>
    </div>
  </form>
</div>
<hr>

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