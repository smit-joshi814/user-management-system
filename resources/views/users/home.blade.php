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
            <div class="d-flex col-md-10 justify-content-end">
                <a href="{{route('user.create')}}" class="btn-dark btn">Add</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg mt-5 mb-5">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if($users->isNotEmpty())
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        @if($user->profile_pic !="")
                                        <img width="50" src="{{asset('uploads/profiles/'.$user->profile_pic)}}" class="rounded">
                                        @else
                                        <img width="50" src="{{asset('uploads/profiles/default.png')}}" class="rounded">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ \carbon\Carbon::parse($user->created_at)->format('d M, Y')}}</td>
                                    <td>
                                        <a href="{{route('user.edit',$user->id)}}" class="btn-dark btn">Edit</a>
                                        <a onclick="deleteUser('{{$user->id}}');" class="btn-danger btn">Delete</a>
                                        <form id="delete-user-form-{{$user->id}}" action="{{route('user.destroy',$user->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        function deleteUser(id) {
            if (confirm('Are you sure you want to delete user ?')) {
                document.getElementById("delete-user-form-" + id).submit();
            }
        }
    </script>

</body>

</html>