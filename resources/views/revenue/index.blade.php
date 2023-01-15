@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-3 card-title text">Revenue</h2>
            <span class="text" style="position: absolute;
                        right: 30px;
                        font-weight: bold;
                        font-size: 30px;
                        top: 10px">
                <a href="{{ route('revenue.create') }}">
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
                        @foreach($revenues as $revenue)
                            <tr>
                                <td class="text">{{ $loop->iteration }}</td>
                                <td class="text">{{ $revenue->description }}</td>
                                <td class="text">{{ $revenue->note ? $revenue->note : '-'}}</td>
                                <td class="text">Rp. {{ $revenue->amount }}</td>
                                <td class="text">{{ $revenue->date }}</td>
                                <td class="text">
                                    <a href="#"  id="{{ $revenue->id }}" class="btn btn-success"  onclick="Modaledit(this)">
                                        <i class='bx bxs-edit icon'></i>
                                    </a>
                                    <form action="{{ route('revenue.delete', $revenue->id) }}" method="POST" class="d-inline">
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

@include('revenue.edit')
@endsection

@section('js')

<script>
    let options = {
        currency: 'IDR',
        minimumFractionDigits: 0
    }

    function Modaledit(e) {
        $.ajax({
            url: "/revenue/edit/" + e.id,
            type: "GET",
            success: function (response) {
                let data = response;
                let el = '#revenue-edit';

                var url = '{{ route("revenue.update", ":id") }}';
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