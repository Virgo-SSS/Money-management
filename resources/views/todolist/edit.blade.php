<div class="modal fade" id="todolist-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Edit Todolist</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="task">Task</label>
                        <input type="text" id="task" name="task" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="defaultForm-pass">Category</label>
                        <select name="category" id="category" name="category" class="form-control">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="task">Deadline</label>  
                        <input type="date" id="deadline" name="date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>