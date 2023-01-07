@extends('layouts.main_auth')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3 card-title text">Add Todolist</h2>
                <span class="text" style="position: absolute;
                            right: 30px;
                            font-weight: bold;
                            font-size: 30px;
                            top: 10px">
                    <a href="{{ route('todolist') }}">
                        <i class='bx bx-arrow-back icon' ></i>
                    </a>
                </span>
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $errors)
                            <li>{{ $errors }}</li>
                        @endforeach
                        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="table">
                    <form action="{{ route('todolist.store') }}" id="todolist" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                                <label for="task" class="text">Task</label>
                                <input type="text" id="task" name="task" class="form-control input-lg" placeholder="Task"/>
                            </div>
                            <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                                <label for="category" class="text">
                                    Category
                                    <span style="font-size: 14px" onclick="showModal('addCategory')">
                                        <a href="#"><i class='bx bx-list-plus icon'></i></a>
                                    </span>
                                </label>
                                <select name="category" id="category" class="form-control">
                                    {{-- option get from ajax --}}
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                                <label for="date" class="text">Deadline</label>
                                <input type="date" name="date" id="date" class="form-control input-lg" placeholder="Date"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="float: right">
                            Submit
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Cateogory Modal   --}}
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
            <div class="modal-content w-auto">
                <div class="card">
                    <div class="modal-header" style="padding-bottom: 3px;padding-top: 3px">
                        <h5 class="modal-title text" id="exampleModalLongTitle">Your Todolist Category</h5>
                        <button type="button" class="btn close" onclick="closeModal('addCategory')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('todolist.add.category') }}" method="POST">
                            @csrf
                            <input type="text" name="category_name" class="form-control" placeholder="Add New Category">
                            <button type="submit" class="btn btn-primary mt-2 p-1 float-end" style="font-size: 12px;">
                                Add
                            </button>
                        </form>
                        <table class="table" id="category_table">
                            <thead>
                                <tr>
                                    <th class="text">No</th>
                                    <th class="text">Category</th>
                                    <th class="text">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todolist_category as $value)
                                    <tr>
                                        <td id="category_number" class="text">{{ $loop->iteration }}</td>
                                        <td id="category_id-{{ $value->id }}" class="text">{{ $value->name }}</td>
                                        <td>
                                            <a href="#" class="edit_category" id="edit_category-{{ $loop->iteration }}" data-label="category_id-{{ $value->id }}" style="text-decoration: none;color: blue">
                                                <i class='bx bx-pencil icon'></i>
                                            </a>
                                            <span class="text">|</span>
                                            <a href="#" onclick="deleteCategory({{ $value->id }})" style="text-decoration: none;color: red">
                                                <i class='bx bx-trash icon'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function getCategory(){
            $.ajax({
                url: "{{ route('todolist.create') }}",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    var html = "<option value='' disabled selected>Category</option>";
                    $.each(data, function(key, value){
                        html += "<option value='"+value.id+"'>"+value.name+"</option>";
                    });
                    $("#category").html(html);
                }
            });
        }
        function deleteCategory(id){
            $.ajax({
                url: "{{ route('todolist.delete.category') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "JSON",
                success: function(data){
                    if(data.status == "success"){
                        $("#category_id-"+id).parent().remove();
                    }
                    $("#category_table tbody tr").each( function(index){
                        $(this).find("td#category_number").html(index+1);
                    });
                    getCategory();
                }
            });
        }
        getCategory()
    </script>
    <script>
        let edit_icon = document.querySelectorAll('.edit_category');
        let edit_icon_length = edit_icon.length;
        for(let i = 1; i <= edit_icon_length; i++){
            $('#edit_category-'+ i).click(function() {
                let td_label = $(this).data('label'); // get category name td element id form data-label example: category_id-1
                category_id = td_label.split('-')[1]; // get id of category example: 1
                category_name_td = $('#'+td_label); // get category name td element
                td_val = category_name_td.text(); // get  category name td value
                input = $(`<input type="text" class="form-control" value="${td_val}" style="width:160px;margin:5px"/>`) // create input element

                category_name_td.hide().after(input);

                input.val(category_name_td.html()).show().focus()
                    .keypress(function(e) {
                        var key = e.which
                        if (key == 13) // enter key
                        {
                            input.hide();
                            $.ajax({
                                url: "{{ route('todolist.update.category') }}",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": category_id,
                                    "name": input.val()
                                },
                                success: function(data) {
                                    getCategory()
                                    category_name_td.html(input.val()).show();
                                }
                            });
                            return false;
                        }
                    })
                    .focusout(function() {
                        input.hide();
                        category_name_td.show();
                    })
            });
        }
    </script>
@endsection
