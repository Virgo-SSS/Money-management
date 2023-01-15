@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-title text-center p-2">
          <h3>Revenue Per Year</h3>
        </div>
        <div class="card-body">
          <canvas id="revenuePerYear"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-title text-center p-2">
          <h3>Expense Per Year</h3>
        </div>
        <div class="card-body">
          <canvas id="expensePerYear"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('js')
  
<script type="text/javascript">
  
  function getRevenuePerYear() {
    var labels =  {{ Js::from($labelRevenue) }};
    var users =  {{ Js::from($dataRevenue) }};

    const data = {
      labels: labels,
      datasets: [{
        label: 'Revenue Per Year',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: users,
      }]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('revenuePerYear'),
      config
    );
  }

  function getExpensePerYear() {
    var labels =  {{ Js::from($labelExpense) }};
    var users =  {{ Js::from($dataExpense) }};

    const data = {
      labels: labels,
      datasets: [{
        label: 'Expense Per Year',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: users,
      }]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('expensePerYear'),
      config
    );
  }

  function init() {
    getRevenuePerYear();
    getExpensePerYear();
  }

  init();
  
</script>    
@endsection