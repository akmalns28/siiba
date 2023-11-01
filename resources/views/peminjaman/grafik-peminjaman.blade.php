@extends('layout.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.css">
    <style>
        .highcharts-credits {
            display: none;
        }
    </style>
@endpush
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>{{ $header }}</h4>
        </div>
        <div class="card-body">
            <div id="chart">
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
        <script>
            var options = {
                series: [{
                    name: "Peminjaman",
                    data: @json($data['dataTotalPeminjaman'])
                }],
                chart: {
                    height: 280,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Grafik Data Peminjaman Per Tahun',
                    align: 'center'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: @json($data['dataBulan']),
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endpush
@endsection
