@extends('layouts.main_auth')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3 card-title text">Todolist</h2>
                <span class="text" style="position: absolute;
                            right: 30px;
                            font-weight: bold;
                            font-size: 30px;
                            top: 10px">
                    <a href="{{ route('todolist.create') }}">
                        <i class='bx bxs-add-to-queue icon'></i>
                    </a>
                </span>
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label class="control control--checkbox">
                                        <input type="checkbox" class="js-check-all"/>
                                        <div class="control__indicator"></div>
                                    </label>
                                </th>
                                <th scope="col" class="text">No</th>
                                <th scope="col" class="text">Created Date</th>
                                <th scope="col" class="text">Task</th>
                                <th scope="col" class="text">Category</th>
                                <th scope="col" class="text">Deadline</th>
                                <th scope="col" class="text">Status</th>
                                <th scope="col" class="text">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todolists as $todolist)
                                <tr>
                                    <th scope="row" class="text">
                                        <label class="control control--checkbox">
                                            <input type="checkbox"/>
                                            <div class="control__indicator"></div>
                                        </label>
                                    </th>
                                    <td class="text">{{ $loop->iteration }}</td>
                                    <td class="text">{{ $todolist->created_at }}</td>
                                    <td class="text">{{ $todolist->task }}</td>
                                    <td class="text">{{ $todolist->category->name }}</td>
                                    <td class="text">{{ $todolist->deadline }}</td>
                                    @if($todolist->status == 0)
                                        <td style="font-weight:bold;font-size:12px;color:red;">Not Completed</td>
                                    @else
                                        <td  style="font-weight:bold;font-size:12px;color:green">Completed</td>
                                    @endif
                                    <td class="text"><i class='bx bxs-edit' style="font-size: 23px"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
