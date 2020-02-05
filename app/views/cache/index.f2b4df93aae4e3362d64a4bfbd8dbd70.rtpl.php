<?php if(!class_exists('Rain\Tpl')){exit;}?>        <!-- Main content -->
        <div class="maincontent-area">
            <div class="zigzag-bottom"></div>
            <section class="content">
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <!-- LINE CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>MRR:</b> Valor formado pela soma de todas as receitas de entrada da empresa.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Recorrência:</b> Valor formado pela soma de todas as receitas de entrada que não sofreram mudança de valores.</li>
                                </ul>
                                <h3 class="box-title">MRR</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height:250px"></canvas>
                                </div>
                            </div> <!-- /.box-body -->
                        </div><!-- /.box -->

                        <!-- BAR CHART -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>Meta:</b> Valor traçado pelo empresa como meta de crescimento da emrpesa.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Ticket Médio:</b> Valor fomado pela divisão da MRR pela quantidade de pagamentos realizados.</li>
                                </ul>
                                <h3 class="box-title">Ticket Médio</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="barChart" style="height:230px"></canvas>
                                </div>
                            </div> <!-- /.box-body -->
                        </div> <!-- /.box -->
                    </div> <!-- /.col (RIGHT) -->

                    <div class="col-md-6 col-sm-6">
                        <!-- AREA CHART -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>Entradas:</b> Valor formado pela soma de todas as MRRs dos tipos <u>New</u>, <u>Resurrected</u> e <u>Expansion</u>.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Saída:</b> Valor formado pela soma de todas as MRRs dos tipos <u>Contration</u> e <u>Cancelled</u>.</li>
                                </ul>
                                <h3 class="box-title">Receitas Totais</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="areaChart" style="height:250px"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        <!-- DONUT CHART -->
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>New:</b> Valor formado pela soma dos pagamentos das mensalidades de <u>NOVOS</u> clientes.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Resurretecd:</b> Valor formato pela soma dos pagamentos das mensalidades de clientes <u>RECUPERADOS</u>.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Expansion:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>AUMENTO</u> de valores.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Contration:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>DIMINUIÇÃO</u> de valores.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Cancelled:</b> Valor formado pela soma dos <u>NÃO PAGAMENTOS</u> das mensalidades de clientes.</li>
                                </ul>
                                <h3 class="box-title">Receitas Detalhadas</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="chart-responsive">
                                            <canvas id="pieChart" height="165"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3">
                                        <div>
                                            <ul class="chart-legend clearfix">
                                                <li><i class="fa fa-circle-o text-green"></i> New</li>
                                                <li><i class="fa fa-circle-o text-light-blue"></i> Resurrected</li>
                                                <li><i class="fa fa-circle-o text-blue"></i> Expansion</li>
                                                <li><i class="fa fa-circle-o text-yellow"></i> Contration</li>
                                                <li><i class="fa fa-circle-o text-red"></i> Cancelled</li>
                                            </ul>
                                        </div> <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /.box -->
                    </div> <!-- /.col (LEFT) -->

                </div> <!-- /.row -->
            </section> <!-- /.content -->
        </div>





<!-- NÃO MEXER NESSA ORDEM -->

        <!-- Distribuição da Versão do Theme -->
        <!--<script src="/res/site/js/core.min.js"></script>-->
        <!--<script src="/res/site/js/script.js"></script>-->

        <!-- ChartJS 1.0.1 -->
        <script src="/res/admin/plugins/chartjs/Chart.min.js"></script>



        <!-- AdminLTE App -->
        <!--<script src="/res/admin/dist/js/app.min.js"></script>-->

<!-- NÃO MEXER NESSA ORDEM -->


        <!-- page script -->
        <script>
            $(function () {

                var $month = [];
                var $mrr = [];
                var $arpu = [];
                var $target = [];
                var $entradas = [];
                var $saidas = [];
                var $recdetails = [];

                <?php $counter1=-1;  if( isset($datachart) && ( is_array($datachart) || $datachart instanceof Traversable ) && sizeof($datachart) ) foreach( $datachart as $key1 => $value1 ){ $counter1++; ?>

                    $month.push("<?php echo htmlspecialchars( $value1["month"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $mrr.push("<?php echo htmlspecialchars( $value1["mrr"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $arpu.push("<?php echo htmlspecialchars( $value1["arpu"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $target.push("<?php echo htmlspecialchars( $value1["target"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $entradas.push("<?php echo htmlspecialchars( $value1["entradas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $saidas.push("<?php echo htmlspecialchars( $value1["saidas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $recdetails.push("<?php echo htmlspecialchars( $value1["recdetails"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");

                <?php } ?>

                var $recorrentes = [
                    $mrr[0]-$entradas[0],
                    $mrr[1]-$entradas[1],
                    $mrr[2]-$entradas[2],
                    $mrr[3]-$entradas[3],
                    $mrr[4]-$entradas[4],
                    $mrr[5]-$entradas[5],
                    $mrr[6]-$entradas[6]
                ]; // RECORRENTE[ Mês ] = MRR[ Mês ] - ENTRADAS[ Mês ]


                //---------
                //-  MRR  -
                //---------


                var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                var lineChart = new Chart(lineChartCanvas);

                var lineChartData = {
                    labels: $month,
                    datasets: [
                        {
                            label: "MRR",
                            fillColor: "rgba(193, 199, 209, 0.9)",
                            strokeColor: "rgba(193, 199, 209, 0.8)",
                            pointColor: "rgba(193, 199, 209, 1)",
                            pointStrokeColor: "#c1c7d1",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(193, 199, 209, 1)",
                            data: $mrr
                        },
                        {
                            label: "Recorrente",
                            fillColor: "rgba(60, 141, 188, 1)",
                            strokeColor: "rgba(60, 141, 188, 1)",
                            pointColor: "#3c8dbc",
                            pointStrokeColor: "rgba(60, 141, 188, 1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60, 141, 188, 1)",
                            data: $recorrentes
                        }
                    ]
                };

                var lineChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //String - A tooltip template
                    multiTooltipTemplate: "<%=datasetLabel %>: R$ <%=value %>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                };

                //Create the line chart
                lineChart.Line(lineChartData, lineChartOptions);


                //------------------
                //-  TICKET MÉDIO  -
                //------------------

                var barChartCanvas = $("#barChart").get(0).getContext("2d");
                var barChart = new Chart(barChartCanvas);

                var barChartData = {
                    labels: $month,
                    datasets: [
                        {
                            label: "Meta",
                            fillColor: "rgba(193, 199, 209, 0.9)",
                            strokeColor: "rgba(193, 199, 209, 0.8)",
                            pointColor: "#c1c7d1",
                            pointStrokeColor: "rgba(193, 199, 209, 1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(193, 199, 209, 1)",
                            data: $target
                        },
                        {
                            label: "Médio",
                            fillColor: "rgba(0, 192, 239 , 1)",
                            strokeColor: "rgba(0, 192, 239 , 1)",
                            pointColor: "rgba(0, 192, 239 , 1)",
                            pointStrokeColor: "#00c0ef",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(0, 192, 239 , 1)",
                            data: $arpu
                        }
                    ]
                };

                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //String - A tooltip template
                    multiTooltipTemplate: "<%=datasetLabel %>: R$ <%=value %>",
                    //Boolean - whether to make the chart responsive,
                    responsive: true,
                    maintainAspectRatio: true
                };

                barChartOptions.datasetFill = false;
                barChart.Line(barChartData, barChartOptions);



                //---------------------
                //-  RECEITAS TOTAIS  -
                //---------------------

                var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
                var areaChart = new Chart(areaChartCanvas);

                var areaChartData = {
                    labels: $month,
                    datasets: [
                        {
                            label: "Entradas",
                            fillColor: "rgba(0, 166, 90 , 1)", // Área do Gráfico
                            strokeColor: "rgba(0, 166, 90 , 1)", // Linha do Gráfico
                            pointColor: "#00a65a", // Caixa da Legenda
                            data: $entradas
                        },
                        {
                            label: "Saídas",
                            fillColor: "rgba(221, 75, 57, 0.8)",
                            strokeColor: "rgba(221, 75, 57, 0.7)",
                            pointColor: "#dd4b39",
                            data: $saidas
                        }
                    ]
                };

                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: false,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //String - A tooltip template
                    multiTooltipTemplate: "<%=datasetLabel %>: R$ <%=value %>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                };

                //Create the line chart
                areaChart.Line(areaChartData, areaChartOptions);



                //-------------------------
                //-  RECEITAS DETALHADAS  -
                //-------------------------

                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);

                var PieData = [
                    {
                        value: $recdetails[0],
                        color: "#00a65a",
                        highlight: "#00c275",
                        label: "New"
                    },
                    {
                        value: $recdetails[1],
                        color: "#00c0ef",
                        highlight: "#09daff",
                        label: "Expansion"
                    },
                    {
                        value: $recdetails[2],
                        color: "#3c8dbc",
                        highlight: "#3fb0e1",
                        label: "Resurrected"
                    },
                    {
                        value: $recdetails[3],
                        color: "#f39c12",
                        highlight: "#ffbe14",
                        label: "Contration"
                    },
                    {
                        value: $recdetails[4],
                        color: "#dd4b39",
                        highlight: "#ff503b",
                        label: "Cancelled"
                    }
                ];

                var pieOptions = {
                    //Boolean - Whether we should show a stroke on each segment
                    segmentShowStroke: true,
                    //String - The colour of each segment stroke
                    segmentStrokeColor: "#fff",
                    //Number - The width of each segment stroke
                    segmentStrokeWidth: 2,
                    //Number - The percentage of the chart that we cut out of the middle
                    percentageInnerCutout: 50, // This is 0 for Pie charts
                    //Number - Amount of animation steps
                    animationSteps: 100,
                    //String - Animation easing effect
                    animationEasing: "easeOutBounce",
                    //Boolean - Whether we animate the rotation of the Doughnut
                    animateRotate: true,
                    //Boolean - Whether we animate scaling the Doughnut from the centre
                    animateScale: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                    //String - A tooltip template
                    tooltipTemplate: "R$ <%=value %>"
                };

                //Create pie or douhnut chart
                pieChart.Doughnut(PieData, pieOptions);


            });
        </script>