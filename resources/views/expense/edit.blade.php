<div class="modal fade" id="expense-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Edit Expense</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="note">*note</label>
                        <input type="text" id="note" name="note" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" id="amount" data-mask='#.##0,00' min="0" class="form-control input-lg" placeholder="0">
                    </div>
                    <div class="mb-3">
                        <label for="date">Date</label>  
                        <input type="date" id="date" name="date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>