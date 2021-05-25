<div class="container">
    <div class="col-md12">
        <h3>You Are Admin</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="emni">
                                <table class="table table-striped table-responsive">
                                    <div class="alert alert-success text-center">
                                        <h1 class="">Total user: {{ $total }}</h1>
                                    </div>

                                    <tr>
                                        <th>#Serial No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Role</th>

                                    </tr>
                                    @foreach ($users as $key=> $user)
                                        <tr>
                                            <td>{{  $users->firstItem()+$key }}</td>
                                            <td>{{  $user->name }}</td>
                                            <td>{{  $user->email }}</td>
                                            <td>{{  $user->created_at }}</td>
                                            @if ($user->role == 1)
                                            <td class="text-primary">Customar</td>
                                            @elseif ($user->role == 2)
                                            <td class="text-success">Admin</td>
                                            @elseif ($user->role == 3)
                                            <td class="text-warning">ShopKepper </td>

                                            @endif
                                    @endforeach
                                </table>
                                    <div class="pagi text-center">
                                        {{ $users->links()}}
                                    </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
           <div class="card">
               <div class="card-header bg-info text-white"><h4>Add New User</h4></div>
               <div class="card-body">
                   @if (session('error_status'))
                       <div class="alert alert-success">{{ session('error_status') }}</div>
                   @endif
                <form method="POST" action="{{ url('home/add/user') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"  class="form-control">
                    </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="password" name="password" id="password"  class="form-control">
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                     @enderror
                    <div class="form-group">
                        <label for="password">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="1">Customar</option>
                            <option value="2">Admin</option>
                            <option value="3">Shop Keeper</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Add User" class="form-control btn btn-info">
                    </div>
                </form>
               </div>
           </div>
        </div>
    </div>
</div>
