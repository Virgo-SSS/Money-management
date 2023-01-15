@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-3 card-title text">Expense</h2>
            <span class="text" style="position: absolute;
                        right: 30px;
                        font-weight: bold;
                        font-size: 30px;
                        top: 10px">
                <a href="{{ route('expense.create') }}">
                    <i class='bx bxs-add-to-queue icon'></i>
                </a>
            </span>
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text">No</th>
                            <th scope="col" class="text">Description</th>
                            <th scope="col" class="text">*note</th>
                            <th scope="col" class="text">Amount</th>
                            <th scope="col" class="text">Date</th>
                            <th scope="col" class="text">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td class="text">{{ $loop->iteration }}</td>
                                <td class="text">{{ $expense->description }}</td>
                                <td class="text">{{ $expense->note ? $expense->note : '-'}}</td>
                                <td class="text">Rp. {{ $expense->amount }}</td>
                                <td class="text">{{ $expense->date }}</td>
                                <td class="text">
                                    <a href="#"  id="{{ $expense->id }}" class="btn btn-success"  onclick="Modaledit(this)">
                                        <i class='bx bxs-edit icon'></i>
                                    </a>
                                    <form action="{{ route('expense.delete', $expense->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class='bx bxs-trash-alt icon'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@include('expense.edit')
@endsection

@section('js')

<script>
    let options = {
        currency: 'IDR',
        minimumFractionDigits: 0
    }

    function Modaledit(e) {
        $.ajax({
            url: "/expense/edit/" + e.id,
            type: "GET",
            success: function (response) {
                let data = response;
                let el = '#expense-edit';

                var url = '{{ route("expense.update", ":id") }}';
                url = url.replace(':id', data.id);

                $(el).find('input[id=description]').val(data.description);
                $(el).find('input[id=note]').val(data.note);
                $(el).find('input[id=amount]').val(data.amount.toLocaleString('id-ID', options));
                $(el).find('input[id=date]').val(data.date);
                $(el).find('form').attr('action', url);
                
                $(el).modal('show');
            }
        });
    }
</script>


@endsection