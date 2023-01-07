<div class="card mb-3">
    <a data-bs-toggle="collapse" data-bs-parent="#accordion2" href="#collapseOne2" style="text-decoration: none" aria-expanded="true" aria-controls="collapseOne">
        <div class="card-header p-2" role="tab" id="headingOne1">
            <h5 class="mb-0 text">
                Change Password
            </h5>
        </div>
    </a>
    <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
        <div class="card-block">
            <div class="row p-2">
                <form action="{{ route('settings.change-password') }}" method="POST">
                    @csrf
                    <div class="mt-3 col-sm-4">
                        <label for="task" class="text">Current Password</label>
                        <input type="password" id="task" name="current_password" class="form-control input-lg" placeholder="Current Password"/>
                    </div>
                    @if ($errors->has('current_password'))
                        <div class="alert alert-danger mt-2">
                            <li>{{ $errors->get('current_password')[0] }}</li>
                        </div>
                    @endif
                    <div class="mt-3 col-sm-4">
                        <label for="task" class="text">New Password</label>
                        <input type="password" id="task" name="password" class="form-control input-lg" placeholder="New Password"/>
                    </div>
                    @if ($errors->has('password'))
                        <div class="alert alert-danger mt-2">
                            @foreach ($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-3 col-sm-4">
                        <label for="task" class="text">Confirm New Password</label>
                        <input type="password" id="task" name="password_confirmation" class="form-control input-lg" placeholder="Confirm New Password"/>
                    </div>
                    <button type="submit" class="btn btn-success float-end p-1 mt-3">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
