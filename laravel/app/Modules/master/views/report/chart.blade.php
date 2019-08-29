

<canvas id="lineChart" height="140"></canvas>



    <!-- ChartJS-->	<!-- 
<script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('assetss/js/plugins/chartJs/Chart.min.js')}}"></script> -->
<script type="text/javascript">

	/* END BASIC */

  
    var lineData = {
        labels: [{!!$label!!}],
        datasets: [
            {
                label: "Example dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [{!!$p!!}]
            }
            
        ]
    };

    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    var myNewChart = new Chart(ctx).Line(lineData, lineOptions);


</script>

