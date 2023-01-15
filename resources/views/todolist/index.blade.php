@extends('layouts.main')

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
                <button class="btn btn-success mb-4" onclick="actionAll('complete')">
                    <a href="#" class="text-white text-decoration-none">
                        Complete
                    </a>
                </button>
                <button class="btn btn-danger mb-4" onclick="actionAll('delete')">
                    <a href="#" class="text-white text-decoration-none">
                        Delete
                    </a>
                </button>

                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label class="control control--checkbox">
                                        <input type="checkbox" id="check-all"/>
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
                            <form action="{{ route('todolist.action') }}" method="POST" id="actionAll">
                                @csrf
                                <input type="hidden" name="action" id="action">
                                @foreach($todolists as $todolist)
                                    <tr>
                                        <th scope="row">
                                            <label class="control control--checkbox">
                                                <input type="checkbox" name="id[]" value="{{ $todolist->id }}"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </th>
                                        <td class="text">{{ $loop->iteration }}</td>
                                        <td class="text">{{ $todolist->created_at }}</td>
                                        <td class="text">{{ $todolist->task }}</td>
                                        <td class="text">{{ $todolist->category->name }}</td>
                                        <td class="text">{{ $todolist->deadline }}</td>
                                        @if($todolist->completed == 0)
                                            <td style="font-weight:bold;font-size:12px;color:red;">Not Completed</td>
                                        @else
                                            <td  style="font-weight:bold;font-size:12px;color:green">Completed</td>
                                        @endif
                                        <td class="text">
                                            <a href="#" id="{{ $todolist->id }}" onclick="Modaledit(this)">
                                                <i class='bx bxs-edit' style="font-size: 23px" ></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @include('todolist.edit')
@endsection

@section('js')
    <script>
        function Modaledit(e) {
            $.ajax({
                url: "{{ route('todolist.edit') }}",
                type: "POST",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    id: e.id

                },
                success: function (response) {
                    let data = JSON.parse(response);
                    let todolist = data[0];
                    let category = data[1];
                    let el = '#todolist-edit';

                    var url = '{{ route("todolist.update", ":id") }}';
                    url = url.replace(':id', todolist.id);

                    $(el).find('input[id=task]').val(todolist.task);
                    $(el).find('input[id=deadline]').val(todolist.deadline);
                    $(el).find('form').attr('action', url);

                    category.forEach(function (value,index) {
                        let selected = '';
                        (value.id == todolist.category_id) ? selected = 'selected' : '';  

                        let option = `<option value='${value.id}' ${selected}>${value.name}</option>`;
                        $(el).find('select[id=category]').append(option);
                    });
                    
                    $(el).modal('show');
                }
            });
        }

        $('#check-all').click(function () {
            if(this.checked) {
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });

        function actionAll(act)
        {
            $('#action').val(act);
            $('#actionAll').submit();
        }
    </script>
@endsection