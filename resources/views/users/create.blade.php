<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simple User Management Project</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="bg-dark py-3">
    <h3 class="text-white text-center">User Management System</h3>
  </div>

  <div class="container">
  <div class="justify-content-center row mt-4">
            <div class="d-flex col-md-10 justify-content-start">
                <a href="{{route('user.index')}}" class="btn-dark btn">Back</a>
            </div>
        </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card border-0 shadow-lg mt-5 mb-5">
          <div class="card-header bg-dark">
            <h3 class="text-white">Add User</h3>
          </div>
          <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label h4" for="name">Name</label>
                <input type="text" value="{{old('name')}}" class="form-control form-control-lg  @error('name') is-invalid @enderror" placeholder="Name" name="name" />
                @error('name')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label h4" for="email">Email</label>
                <input type="email" value="{{old('email')}}" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" name="email" />
                @error('email')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label h4" for="phone">Phone</label>
                <input type="number" value="{{old('phone')}}" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="Phone" name="phone" />
                @error('phone')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label h4" for="password">password</label>
                <input type="password" value="{{old('password')}}" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" name="password" />
                @error('password')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label h4" for="bio">bio</label>
                <textarea class="form-control form-control-lg @error('bio') is-invalid @enderror" placeholder="Bio Data" name="bio" cols="30" rows="5">
                {{old('bio')}}
                </textarea>
                @error('bio')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="mb-5">
                <label class="form-label h4" for="profile_pic">Profile pic</label>
                <input type="file" class="form-control form-control-lg @error('profile_pic') is-invalid @enderror" placeholder="Profile Photo" name="profile_pic" value="{{old('profile_pic')}}" />
                @error('profile_pic')
                    <p class='invalid-feedback'>{{$message}}</p>
                @enderror
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>