<?php if(!class_exists('Rain\Tpl')){exit;}?>        <!-- Main content -->
        <div class="maincontent-area">
            <div class="zigzag-bottom"></div>
            <section class="content">


                <!-- MÉTRICAS SAAS POR REFERÊNCIA DO MÊS -->

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;Métricas SaaS em percentuais de crescimento dentro do mês pesquisado.</li>
                                    <li>&nbsp;<b>Receitas de Entrada:</b> A soma da Recurrent + New + Expansion + Resurrected deve totalizar 100%.</li>
                                    <li>&nbsp;<b>Receitas de Saída:</b> A soma da Contraction + Cancelled deve totalizar 100%.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Métricas SaaS</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Recurrent</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["5"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#39CCCC">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">New</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["4"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#00a65a">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Resurrected</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["3"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#8f26ae">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Expansion</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["2"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#3c8dbc">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-lg-2 text-center">
                                        <div class="knob-header">Contraction</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["1"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#f39c12">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-lg-2 text-center">
                                        <div class="knob-header">Cancelled</div>
                                        <label>
                                            <input type="text" class="knob" value="<?php echo htmlspecialchars( $datachart["0"]["saas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-width="170" data-height="170" data-fgColor="#d54b39">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.MÉTRICAS SAAS POR REFERÊNCIA DO MÊS -->


                <div class="row">
                    <div class="col-md-6 col-sm-6">

                    <!-- MRR -->

                        <div class="box box-primary">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>MRR:</b> Valor formado pela soma de todas as Receitas de Entrada seja as Variáveis e as Fixas.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Fixas:</b> Valor formado pela soma de todas as Receitas de Entrada que não sofreram mudança de valores.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">MRR</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="mrrChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>

                    <!-- ./MRR -->

                    <!-- TICKET MÉDIO (ARPU) -->

                        <div class="box box-info">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>Meta:</b> Valor traçado pelo empresa como meta de crescimento da emrpesa.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Ticket Médio:</b> Valor fomado pela divisão da MRR pela quantidade de pagamentos realizados.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Ticket Médio (ARPU)</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="tkmChart" style="height:230px"></canvas>
                                </div>
                            </div>
                        </div>

                    <!-- ./TICKET MÉDIO (ARPU) -->

                    </div>
                    <div class="col-md-6 col-sm-6">

                    <!-- RECEITAS VARIÁVEIS -->

                        <div class="box box-success">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>Entradas:</b> Valor formado pela soma de todas as MRRs dos tipos <u>New</u>, <u>Resurrected</u> e <u>Expansion</u>.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Saída:</b> Valor formado pela soma de todas as MRRs dos tipos <u>Contraction</u> e <u>Cancelled</u>.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Receitas Variáveis</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="recinoutChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>

                    <!-- ./RECEITAS VARIÁVEIS -->

                    <!-- RECEITAS VARIÁVEIS FATIADAS -->

                        <div class="box box-warning">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>New:</b> Valor formado pela soma dos pagamentos das mensalidades de <u>NOVOS</u> clientes.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Resurretecd:</b> Valor formato pela soma dos pagamentos das mensalidades de clientes <u>RECUPERADOS</u>.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Expansion:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>AUMENTO</u> de valores.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Contraction:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>DIMINUIÇÃO</u> de valores.</li>
                                    <li class="divider"></li>
                                    <li>&nbsp;<b>Cancelled:</b> Valor formado pela soma dos <u>NÃO PAGAMENTOS</u> das mensalidades de clientes.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Receitas Variáveis Fatiada</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="chart-responsive">
                                            <canvas id="recdetChart" height="165"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3">
                                        <div>
                                            <ul class="chart-legend clearfix">
                                                <li><i class="fa fa-circle-o text-green"></i> New</li>
                                                <li><i class="fa fa-circle-o text-fuchsia"></i> Resurrected</li>
                                                <li><i class="fa fa-circle-o text-blue"></i> Expansion</li>
                                                <li><i class="fa fa-circle-o text-yellow"></i> Contraction</li>
                                                <li><i class="fa fa-circle-o text-red"></i> Cancelled</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- ./RECEITAS VARIÁVEIS FATIADAS -->

                    </div>
                </div>
            </section>
        </div>

        <!-- jQuery Knob -->
        <script src="/res/site/js/jquery.knob.js"></script>

        <!-- ChartJS 1.0.1 -->
        <script src="/res/site/js/Chart.min.js"></script>

        <!-- page script -->
        <script>
            $(function () {

                //----------------------
                //-  NICHO DE MERCADO  -
                //----------------------

                $(".knob").knob({

                    draw: function () {

                        if (this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)     // Angle
                                , sa = this.startAngle      // Previous start angle
                                , sat = this.startAngle     // Start angle
                                , ea                        // Previous end angle
                                , eat = sat + a             // End angle
                                , r = true;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.value);
                                this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.previousColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });

                $(".sparkline").each(function () {
                    var $this = $(this);
                    $this.sparkline('html', $this.data());
                });

                drawDocSparklines();
                drawMouseSpeedDemo();

            });

            $(function () {

                var $month = [];
                var $mrr = [];
                var $recorrentes = [];
                var $arpu = [];
                var $entradas = [];
                var $saidas = [];
                var $recdetails = [];

                <?php $counter1=-1;  if( isset($datachart) && ( is_array($datachart) || $datachart instanceof Traversable ) && sizeof($datachart) ) foreach( $datachart as $key1 => $value1 ){ $counter1++; ?>
                    $month.push("<?php echo htmlspecialchars( $value1["month"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $mrr.push("<?php echo htmlspecialchars( $value1["mrr"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $recorrentes.push("<?php echo htmlspecialchars( $value1["recorrentes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $arpu.push("<?php echo htmlspecialchars( $value1["arpu"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $entradas.push("<?php echo htmlspecialchars( $value1["entradas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $saidas.push("<?php echo htmlspecialchars( $value1["saidas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                    $recdetails.push("<?php echo htmlspecialchars( $value1["recdetails"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                <?php } ?>


                var ChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
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
                    //multiTooltipTemplate: "<%=datasetLabel%>: R$ <%=value%>",
                    multiTooltipTemplate: "<%=datasetLabel %>: R$ <%= value %>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                };


                    //---------
                //-  MRR  -
                //---------

                var mrrChartCanvas = $("#mrrChart").get(0).getContext("2d");
                var mrrChart = new Chart(mrrChartCanvas);
                var mrrChartData = {
                    labels: $month,
                    datasets: [
                        {
                            label: "MRR",
                            fillColor: "rgba(204, 210, 220, 0.9)",
                            strokeColor: "rgba(204, 210, 220, 0.8)",
                            pointColor: "rgba(204, 210, 220, 1)",
                            pointStrokeColor: "#ccd2dc",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(204, 210, 220, 1)",
                            data: $mrr
                        },
                        {
                            label: "Recorrente",
                            fillColor: "rgba(57, 204, 204, 1)",
                            strokeColor: "rgba(57, 204, 204, 1)",
                            pointColor: "#39cccc",
                            pointStrokeColor: "rgba(57, 204, 204, 1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(57, 204, 204, 1)",
                            data: $recorrentes
                        }
                    ]
                };

                //Create the line chart
                mrrChart.Line(mrrChartData, ChartOptions);


                //------------------
                //-  TICKET MÉDIO  -
                //------------------

                var tkmChartCanvas = $("#tkmChart").get(0).getContext("2d");
                var tkmChart = new Chart(tkmChartCanvas);
                var tkmChartData = {
                    labels: $month,
                    datasets: [
                        {
                            label: "Médio",
                            fillColor: "rgba(0, 192, 239 , 1)",
                            strokeColor: "rgba(0, 192, 239 , 1)",
                            pointColor: "rgba(0, 192, 239 , 1)",
                            pointStrokeColor: "#39CCCC",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(0, 192, 239 , 1)",
                            data: $arpu
                        }
                    ]
                };
                var tkmChartOptions = ChartOptions;

                tkmChartOptions.datasetFill = false;
                tkmChartOptions.scaleBeginAtZero = false;
                tkmChartOptions.barShowStroke = true;
                tkmChartOptions.barStrokeWidth = 2;
                tkmChartOptions.barValueSpacing = 5;
                tkmChartOptions.barDatasetSpacing = 10;
                tkmChartOptions.tooltipTemplate = "<%if (label){%><%=label%>: <%}%> R$<%= value %>";
                tkmChart.Line(tkmChartData, tkmChartOptions);


                //------------------------
                //-  RECEITAS VARIÁVEIS  -
                //------------------------

                var recinoutChartCanvas = $("#recinoutChart").get(0).getContext("2d");
                var recinoutChart = new Chart(recinoutChartCanvas);
                var recinoutChartData = {
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
                var recinoutChartOptions = ChartOptions;

                recinoutChartOptions.datasetFill = false;
                recinoutChart.Line(recinoutChartData, recinoutChartOptions);



                //---------------------------------
                //-  RECEITAS VARIÁVEIS FATIADAS  -
                //---------------------------------

                var recdetChartCanvas = $("#recdetChart").get(0).getContext("2d");
                var recdetChart = new Chart(recdetChartCanvas);
                var recdetChartData = [
                    {
                        value: $recdetails[0],
                        color: "#00a65a",
                        highlight: "#00c275",
                        label: "New"
                    },
                    {
                        value: $recdetails[1],
                        color: "#8f26ae",
                        highlight: "#d627f5",
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
                        label: "Contraction"
                    },
                    {
                        value: $recdetails[4],
                        color: "#d54b39",
                        highlight: "#ff503b",
                        label: "Cancelled"
                    }
                ];
                var recdetChartOptions = {
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
                recdetChart.Doughnut(recdetChartData, recdetChartOptions);


            });
        </script>