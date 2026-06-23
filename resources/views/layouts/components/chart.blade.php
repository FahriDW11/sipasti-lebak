
<!-- charts -->
 <div class="card bg-base-100 shadow-xl">

     <div class="card-body">
         <h2 class="card-title">{{ $chartTitle ?? 'My Chart' }}</h2>
         <div id="{{ $chartId ?? 'my-chart' }}"></div>
        </div>
    </div>



<!-- scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const options = {
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },

        series: [{
            name: 'Kegiatan',
            data: @json($chartData['data']) 
        }],

        xaxis: {
            categories: @json($chartData['labels'])
        },

        stroke: {
            curve: 'smooth'
        },

        dataLabels: {
            enabled: false
        },

        tooltip: {
            enabled: true
        }
    };

    const chart = new ApexCharts(
        document.querySelector("#" + "{{ $chartId ?? 'my-chart' }}"),
        options
    );

    chart.render();
});
</script>