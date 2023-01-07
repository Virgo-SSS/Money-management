@extends('layouts.main_auth')

@section('css')
    <style>
        .invest-input {
            position: relative;
        }
        .invest-input span {
            position: absolute;
            left: .9em;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
            pointer-events: none;
            color: dimgray;
        }
        .invest-input .right span {
            left: initial;
            right: .9em;
        }
        .invest-input input {
            -moz-appearance: textfield;
            font: inherit;
            padding: .4em .9em;
            border-radius: .6em;
            border: 1px solid darkgray;
            padding-inline: 3em .9em;
            width: 100%;
        }
        .invest-input input:invalid {
            border-color: orangered;
            color: crimson;
        }
        .invest-input .right input {
            padding-inline: .9em 2em;
        }
        .invest-input input::-webkit-outer-spin-button,
        .invest-input input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <form action="" method="POST" id="form-input">
            @csrf
            <div class="row">
                <div class="col-md-5">

                    <div class="card mb-2">
                        <div class="card-body">
                            <label class="mb-2" for="modal">Modal</label>
                            <div class="invest-input mb-2">
                                <span>Rp.</span>
                                <input type="text" data-mask='#.##0,00' min="0" value="0" placeholder="0" id="modal" onblur="calculateModal(this)">
                            </div>

                            <table class="table table-bordered m-0">
                                <tbody class="text-center">
                                <tr>
                                    <td rowspan="3" class="align-middle">Risk Per Trade</td>
                                    <td>2.00%</td>
                                    <td id="rpt1">0</td> <!-- rpt =  Risk Per Trade -->
                                </tr>
                                <tr>
                                    <td>1.50%</td>
                                    <td id="rpt2">0</td> <!-- rpt =  Risk Per Trade -->
                                </tr>
                                <tr>
                                    <td>1.00%</td>
                                    <td id="rpt3">0</td> <!-- rpt =  Risk Per Trade -->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-2 mt-2">
                        <div class="card-body" style="padding:9px">
                            <label class="mt-3" for="buy">Buy</label>
                            <div class="invest-input">
                                <span>Rp.</span>
                                <input type="text" id="buy" name="buy" disabled value="0" data-mask='#.##0,00' onblur="calculateRisk()" min="0" placeholder="0" >
                            </div>

                            <label class="mt-3" for="stop_loss">Stop Loss</label>
                            <div class="invest-input mb-3">
                                <span>Rp.</span>
                                <input type="text" id="stoploss" name="stoploss" disabled value="0" data-mask='#.##0,00' onblur="calculateRisk()" min="0" placeholder="0" value="0">
                            </div>

                            <table class="table table-bordered m-0">
                                <tbody class="text-center">
                                    <tr>
                                        <td>Risk</td>
                                        <td id="risk">0</td>
                                        <td id="riskpercent">0.0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center mb-4">PRINSIP RISK MANAGEMENT</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <p> 1. Selalu menggunakan Stop Loss!</p>
                                    <p> 2. Say NO to Average Down</p>
                                    <p> 3. Risk : Reward Ratio minimal = 1 : 2</p>
                                </div>
                                <div class="col-md-6">
                                    <p> 4. Max Loss = 10%</p>
                                    <p> 5. Max Risk per Trade = 2% </p>
                                    <p> 6. Max dana yang digunakan 25% - 30% dari modal (tambahan)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                            <label for="target_profit_1">Target Profit 1</label>
                            <div class="invest-input">
                                <span>Rp.</span>
                                 <input type="text" id="tp1" name="tp1" disabled value="0" onblur="calculateProfit(this)" data-mask='#.##0,00' min="0" placeholder="0">  {{-- tp = target profit --}}
                            </div>

                            <label class="mt-2" for="target_profit_2">Target Profit 2</label>
                            <div class="invest-input">
                                <span>Rp.</span>
                                 <input type="text" id="tp2" name="tp2" disabled value="0"  onblur="calculateProfit(this)" data-mask='#.##0,00' min="0" placeholder="0"> {{-- tp = target profit --}}
                            </div>

                            <label class="mt-2" for="target_profit_3">Target Profit 3</label>
                            <div class="invest-input">
                                <span>Rp.</span>
                                 <input type="text" id="tp3" name="tp3" disabled value="0" onblur="calculateProfit(this)" data-mask='#.##0,00' min="0" placeholder="0"> {{-- tp = target profit --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <tbody class="text-center">
                                    <tr>
                                        <td>Reward 1</td>
                                        <td id="tp1">0</td>
                                        <td id="tp1p">0</td>
                                    </tr>
                                    <tr>
                                        <td>Reward 2</td>
                                        <td id="tp2">0</td>
                                        <td id="tp2p">0</td>
                                    </tr>
                                    <tr>
                                        <td>Reward 3</td>
                                        <td id="tp3">0</td>
                                        <td id="tp3p">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <tbody class="text-center">
                                <tr>
                                    <td>Risk : Reward 1</td>
                                    <td id="tp1r">0</td>
                                    <td rowspan="3" class="align-middle">Risk Reward Minimal 1 : 2</td>
                                </tr>
                                <tr>
                                    <td>Risk : Reward 2</td>
                                    <td id="tp2r">0</td>
                                </tr>
                                <tr>
                                    <td>Risk : Reward 3</td>
                                    <td id="tp3r">0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr class="text-center">
                                        <td>Risk</td>
                                        <td colspan="2">Lot Ideal</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>2.00%</td>
                                        <td id="lot1">0</td>
                                    </tr>
                                    <tr>
                                        <td>1.50%</td>
                                        <td id="lot2">0</td>
                                    </tr>
                                    <tr>
                                        <td>1.00%</td>
                                        <td id="lot3">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr class="text-center">
                                        <td>Risk</td>
                                        <td colspan="3">Dana yang di gunakan</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>2.00%</td>
                                        <td id="dana1">0</td>
                                        <td id="danaPercent1">0</td>
                                        <td rowspan="3" class="align-middle">Dari Modal</td>
                                    </tr>
                                    <tr>
                                        <td>1.50%</td>
                                        <td id="dana2">0</td>
                                        <td id="danaPercent2">0</td>
                                    </tr>
                                    <tr>
                                        <td>1.00%</td>
                                        <td id="dana3">0</td>
                                        <td id="danaPercent3">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr class="text-center">
                                        <td  colspan="5">PROYEKSI</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Stop Loss</td>
                                        <td>TP 1</td>
                                        <td>TP 2</td>
                                        <td>TP 3</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td id="pSL1">0</td>
                                        <td id="pTP1-1">0</td>
                                        <td id="pTP2-1">0</td>
                                        <td id="pTP3-1">0</td>
                                    </tr>
                                    <tr>
                                        <td id="pSL2">0</td>
                                        <td id="pTP1-2">0</td>
                                        <td id="pTP2-2">0</td>
                                        <td id="pTP3-2">0</td>
                                    </tr>
                                    <tr>
                                        <td id="pSL3">0</td>
                                        <td id="pTP1-3">0</td>
                                        <td id="pTP2-3">0</td>
                                        <td id="pTP3-3">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        let options = {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }

        function calculateModal(e)
        {
            let value = e.value.replace(/\./g, '').replace(/,/g, '');
            let val1 = value * (2 / 100);
            let val2 = value * (1.5 / 100);
            let val3 = value * (1 / 100);

            $('#rpt1, #pSL1').text(val1.toLocaleString('id-ID', options));
            $('#rpt2, #pSL2').text(val2.toLocaleString('id-ID', options));
            $('#rpt3, #pSL3').text(val3.toLocaleString('id-ID', options));

            // undisabled buy input
            if(value > 0) {
                $('input[id=buy]').prop('disabled', false);
                $('input[id=stoploss]').prop('disabled', false);
            }

        }

        function calculateRisk()
        {
            let buy =$('#buy').val().replace(/\./g, '').replace(/,/g, '');
            let stoploss = $('#stoploss').val().replace(/\./g, '').replace(/,/g, '');

            let risk = buy - stoploss;
            let riskpercent = risk / buy * (100/100) * 100 ;

            $('#risk').text(risk.toLocaleString('id-ID', options));
            $('#riskpercent').text(riskpercent.toFixed(2) + '%');
            if(riskpercent > 10) {
                $('#riskpercent').css({
                    'background-color': 'red',
                    'color': 'white'
                });
            }else {
                $('#riskpercent').css({
                    'background-color': 'white',
                    'color': 'black'
                });
            }

            calculateLot();
            if(buy > 0 && stoploss > 0) {
                $('#tp1').prop('disabled', false);
                $('#tp2').prop('disabled', false);
                $('#tp3').prop('disabled', false);
            }
        }

        function calculateLot()
        {
            let rpt1 = $('#rpt1').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
            let rpt2 = $('#rpt2').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
            let rpt3 = $('#rpt3').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
            let risk = $('#risk').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');

            let lot1 = Math.floor(rpt1 / risk / 100);
            let lot2 = Math.floor(rpt2 / risk / 100);
            let lot3 = Math.floor(rpt3 / risk / 100);
            $('#lot1').text(lot1);
            $('#lot2').text(lot2);
            $('#lot3').text(lot3);

            calculateDana(lot1,lot2,lot3);
        }

        function calculateDana(lot1,lot2,lot3)
        {
            let buy = $('#buy').val().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
            let modal = $('#modal').val().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');

            let dana1 = buy * lot1 * 100;
            let dana2 = buy * lot2 * 100;
            let dana3 = buy * lot3 * 100;

            let danaPercent1 = dana1 / modal * 100;
            let danaPercent2 = dana2 / modal * 100;
            let danaPercent3 = dana3 / modal * 100;

            $('#dana1').text(dana1.toLocaleString('id-ID', options));
            $('#dana2').text(dana2.toLocaleString('id-ID', options));
            $('#dana3').text(dana3.toLocaleString('id-ID', options));

            $('#danaPercent1').text(danaPercent1.toFixed(2) + '%');
            $('#danaPercent2').text(danaPercent2.toFixed(2) + '%');
            $('#danaPercent3').text(danaPercent3.toFixed(2) + '%');
        }

        function calculateProfit(e)
        {
            let buy = $('#buy').val().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
            let risk = $('#riskpercent').text().replace('%', '');
            let val = e.value.replace(/\./g, '').replace(/,/g, '').replace('Rp', '');

            if(val != '' || val == 0) {
                let profit = val - buy;
                let profitPercent = profit / buy * (100/100) * 100;

                let riskRatio = profitPercent/risk;

                $('td[id='+e.id+']').text(profit.toLocaleString('id-ID', options));
                $('td[id='+e.id+'p]').text(profitPercent.toFixed(2) + '%');
                $('td[id='+e.id+'r]').text(riskRatio.toFixed(2));

                let stopLoss1 = $('#pSL1').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
                let stopLoss2 = $('#pSL2').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');
                let stopLoss3 = $('#pSL3').text().replace(/\./g, '').replace(/,/g, '').replace('Rp', '');

                let targetProfit1 = riskRatio *  stopLoss1;
                let targetProfit2 = riskRatio *  stopLoss2;
                let targetProfit3 = riskRatio *  stopLoss3;

                let getIdNumber = e.id.replace('tp', '');

                $('#pTP'+getIdNumber+'-1').text(Math.floor(targetProfit1).toLocaleString('id-ID', options));
                $('#pTP'+getIdNumber+'-2').text(Math.floor(targetProfit2).toLocaleString('id-ID', options));
                $('#pTP'+getIdNumber+'-3').text(Math.floor(targetProfit3).toLocaleString('id-ID', options));
            }
           
        }
    </script>
@endsection
