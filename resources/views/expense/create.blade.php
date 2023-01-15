@extends('layouts.main')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-3 card-title text">Add Expense</h2>
            <span class="text" style="position: absolute;
                        right: 30px;
                        font-weight: bold;
                        font-size: 30px;
                        top: 10px">
                <a href="{{ route('expense') }}">
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
                <form action="{{ route('expense.store') }}" id="expense" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                            <label for="task" class="text">Description</label>
                            <input type="text" name="description"   id="task" class="form-control input-lg" placeholder="Description"/>
                        </div>
                        <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                            <label for="note" class="text">*note (optional)</label>
                            <input type="text" name="note"   id="note"  class="form-control input-lg" placeholder="Note"/>
                        </div>
                        <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                            <label for="amount" class="text">Amount</label>
                            <input type="text" name="amount" id="amount" data-mask='#.##0,00' min="0" value="0" class="form-control input-lg" placeholder="0">
                        </div>
                        <div class="col-xs-12 col-sm-4" style="margin:10px 0px 10px 0px">
                            <label for="date" class="text">Date</label>
                            <input type="date" name="date"   id="date" class="form-control input-lg" placeholder="Date"/>
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


@endsection