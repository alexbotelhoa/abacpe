<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <section class="container">
                    <h2>Estatísticas</h2>
                </section>

                <!-- INDICADORES PERCENTUAIS DE STATUS DAS MÉTRICAS SAAS -->
                <div class="row">
                    <div class="box box-primary">
                        <div class="col-sm-6 col-xs-12">
                            <div class="box-footer">
                                <?php $counter1=-1;  if( isset($datachart) && ( is_array($datachart) || $datachart instanceof Traversable ) && sizeof($datachart) ) foreach( $datachart as $key1 => $value1 ){ $counter1++; ?>
                                    <?php if( $counter1 < 4 ){ ?>
                                    <div class="col-xs-3">
                                        <div class="description-block">
                                            <span class="description-percentage text-<?php echo htmlspecialchars( $value1["vsblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-caret-<?php echo htmlspecialchars( $value1["caretblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["perblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
                                            <h5 class="description-header"><?php echo htmlspecialchars( $value1["vlblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                            <h5 class="description-text"><?php echo htmlspecialchars( $value1["nameblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="box-footer">
                                <?php $counter1=-1;  if( isset($datachart) && ( is_array($datachart) || $datachart instanceof Traversable ) && sizeof($datachart) ) foreach( $datachart as $key1 => $value1 ){ $counter1++; ?>
                                    <?php if( $counter1 > 3 && $counter1 < 8 ){ ?>
                                    <div class="col-xs-3">
                                        <div class="description-block">
                                            <span class="description-percentage text-<?php echo htmlspecialchars( $value1["vsblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-caret-<?php echo htmlspecialchars( $value1["caretblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["perblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
                                            <h5 class="description-header"><?php echo htmlspecialchars( $value1["vlblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                            <h5 class="description-text"><?php echo htmlspecialchars( $value1["nameblock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MÉTRICAS SAAS POR REFERÊNCIA DO MÊS -->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;Nicho de mercado com maoir taxa representativa por cada métrica Saas.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Nicho de Mercado - Mês</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Recurrent</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["8"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#39CCCC">
                                        <h5><?php echo htmlspecialchars( $datachart["8"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">New</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["9"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#00a65a">
                                        <h5><?php echo htmlspecialchars( $datachart["9"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Resurrected</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["10"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#8f26ae">
                                        <h5><?php echo htmlspecialchars( $datachart["10"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-lg-2 text-center">
                                        <div class="knob-header">Expansion</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["11"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#3c8dbc">
                                        <h5><?php echo htmlspecialchars( $datachart["11"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-lg-2 text-center">
                                        <div class="knob-header">Contraction</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["12"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#f39c12">
                                        <h5><?php echo htmlspecialchars( $datachart["12"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-lg-2 text-center">
                                        <div class="knob-header">Cancelled</div>
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="<?php echo htmlspecialchars( $datachart["13"]["nichoseg"]["0"]["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                               data-width="170" data-height="170" data-fgColor="#d54b39">
                                        <h5><?php echo htmlspecialchars( $datachart["13"]["nichoseg"]["0"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MÉTRICAS SAAS DOS TOP 5 DOS CLIENTES POR PLANOS -->
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="box box-success">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;Valores percentuais formados pela quantidade de clientes por plano.</li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Planos Vendidos</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="planoChart" style="height:230px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="box box-danger">
                            <div class="box-header">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>&nbsp;<b>Churn:</b> Valor formado pela soma da quantidade de clientes cancelados divido pela quantidade de clientes existente e multiplicado
                                        por 100.
                                    </li>
                                </ul>
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Rate Churn</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="churnChart" style="height:230px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INDICADORES PERCENTUAIS DOS TOP 3 DE CLIENTES E REGIÕES -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-xs-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>&nbsp;<b>Resurretecd:</b> Valor formato pela soma dos pagamentos das mensalidades de clientes <u>RECUPERADOS</u>.</li>
                                        <li class="divider"></li>
                                        <li>&nbsp;Os Top 3 por Cliente e Região.</li>
                                    </ul>
                                    <h3 class="box-title">Resurrected</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php $counter1=-1;  if( isset($datachart["10"]["nichostt"]) && ( is_array($datachart["10"]["nichostt"]) || $datachart["10"]["nichostt"] instanceof Traversable ) && sizeof($datachart["10"]["nichostt"]) ) foreach( $datachart["10"]["nichostt"] as $key1 => $value1 ){ $counter1++; ?>
                                    <div class="clearfix">
                                        <span class="pull-left">#<?php echo htmlspecialchars( $counter1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo stateBrazil($value1["0"]); ?></span>
                                        <small class="pull-right"><?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</small>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar <?php if( $counter1==5 ){ ?>progress-bar-default<?php }else{ ?>progress-bar-light-blue<?php } ?>" style="width: <?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%;"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="box box-fuchsia">
                                <div class="box-header">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>&nbsp;<b>Expansion:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>AUMENTO</u> de valores.</li>
                                        <li class="divider"></li>
                                        <li>&nbsp;Os Top 3 por Cliente e Região.</li>
                                    </ul>
                                    <h3 class="box-title">Expansion</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php $counter1=-1;  if( isset($datachart["11"]["nichostt"]) && ( is_array($datachart["11"]["nichostt"]) || $datachart["11"]["nichostt"] instanceof Traversable ) && sizeof($datachart["11"]["nichostt"]) ) foreach( $datachart["11"]["nichostt"] as $key1 => $value1 ){ $counter1++; ?>
                                    <div class="clearfix">
                                        <span class="pull-left">#<?php echo htmlspecialchars( $counter1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo stateBrazil($value1["0"]); ?></span>
                                        <small class="pull-right"><?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</small>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar <?php if( $counter1==5 ){ ?>progress-bar-default<?php }else{ ?>progress-bar-light-fuchsia<?php } ?>" style="width: <?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%;"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-6">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>&nbsp;<b>Contraction:</b> Valor formado pela soma dos pagamentos das mensalidades de clientes que sofreram <u>DIMINUIÇÃO</u> de valores.
                                        </li>
                                        <li class="divider"></li>
                                        <li>&nbsp;Os Top 3 por Cliente e Região.</li>
                                    </ul>
                                    <h3 class="box-title">Contraction</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php $counter1=-1;  if( isset($datachart["12"]["nichostt"]) && ( is_array($datachart["12"]["nichostt"]) || $datachart["12"]["nichostt"] instanceof Traversable ) && sizeof($datachart["12"]["nichostt"]) ) foreach( $datachart["12"]["nichostt"] as $key1 => $value1 ){ $counter1++; ?>
                                    <div class="clearfix">
                                        <span class="pull-left">#<?php echo htmlspecialchars( $counter1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo stateBrazil($value1["0"]); ?></span>
                                        <small class="pull-right"><?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</small>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar <?php if( $counter1==5 ){ ?>progress-bar-default<?php }else{ ?>progress-bar-warning<?php } ?>" style="width: <?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%;"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>&nbsp;<b>Cancelled:</b> Valor formado pela soma dos <u>NÃO PAGAMENTOS</u> das mensalidades de clientes.</li>
                                        <li class="divider"></li>
                                        <li>&nbsp;Os Top 3 por Cliente e Região.</li>
                                    </ul>
                                    <h3 class="box-title">Cancelled</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php $counter1=-1;  if( isset($datachart["13"]["nichostt"]) && ( is_array($datachart["13"]["nichostt"]) || $datachart["13"]["nichostt"] instanceof Traversable ) && sizeof($datachart["13"]["nichostt"]) ) foreach( $datachart["13"]["nichostt"] as $key1 => $value1 ){ $counter1++; ?>
                                    <div class="clearfix">
                                        <span class="pull-left">#<?php echo htmlspecialchars( $counter1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo stateBrazil($value1["0"]); ?></span>
                                        <small class="pull-right"><?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</small>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar <?php if( $counter1==5 ){ ?>progress-bar-default<?php }else{ ?>progress-bar-danger<?php } ?>" style="width: <?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%;"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </section>
</div>

<!-- jQuery Knob -->
<script src="/abasce2/res/site/js/jquery.knob.js"></script>

<!-- ChartJS 1.0.1 -->
<script src="/abasce2/res/site/js/Chart.min.js"></script>

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
        var $bronzePlanoChart = [];
        var $prataPlanoChart = [];
        var $ouroPlanoChart = [];
        var $platinaPlanoChart = [];
        var $churnChart = [];

        <?php $counter1=-1;  if( isset($datachart) && ( is_array($datachart) || $datachart instanceof Traversable ) && sizeof($datachart) ) foreach( $datachart as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $counter1 > 13 ){ ?>
                $month.push("<?php echo htmlspecialchars( $value1["month"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                $bronzePlanoChart.push("<?php echo htmlspecialchars( $value1["bronzePlanoChart"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                $prataPlanoChart.push("<?php echo htmlspecialchars( $value1["prataPlanoChart"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                $ouroPlanoChart.push("<?php echo htmlspecialchars( $value1["ouroPlanoChart"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                $platinaPlanoChart.push("<?php echo htmlspecialchars( $value1["platinaPlanoChart"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
                $churnChart.push("<?php echo htmlspecialchars( $value1["churnChart"], ENT_COMPAT, 'UTF-8', FALSE ); ?>");
            <?php } ?>
        <?php } ?>

            var ChartOptions = {
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
                //Boolean - Whether to show a dot for each point
                pointDot: false,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to make the chart responsive,
                responsive: true,
                maintainAspectRatio: true,
                datasetFill: false
            };


            //---------------------
            //-  PLANOS VENDIDOS  -
            //---------------------

            var planoChartCanvas = $("#planoChart").get(0).getContext("2d");
            var planoChart = new Chart(planoChartCanvas);
            var planChartOptions = ChartOptions;
            var planoChartData = {
                labels: $month,
                datasets: [
                    {
                        label: "Bronze",
                        fillColor: "rgba(137, 66, 54, 1)",
                        strokeColor: "rgba(137, 66, 54, 1)",
                        pointColor: "#894218",
                        pointStrokeColor: "rgba(137, 66, 54, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(137, 66, 54, 1)",
                        data: $bronzePlanoChart
                    },
                    {
                        label: "Prata",
                        fillColor: "rgba(192, 192, 192, 1)",
                        strokeColor: "rgba(192, 192, 192, 1)",
                        pointColor: "#c0c0c0",
                        pointStrokeColor: "rgba(192, 192, 192, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(192, 192, 192, 1)",
                        data: $prataPlanoChart
                    },
                    {
                        label: "Ouro",
                        fillColor: "rgba(255, 215, 0, 1)",
                        strokeColor: "rgba(255, 215, 0, 1)",
                        pointColor: "#ffd700",
                        pointStrokeColor: "rgba(255, 215, 0, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(255, 215, 0, 1)",
                        data: $ouroPlanoChart
                    },
                    {
                        label: "Plantina",
                        fillColor: "rgba(160, 170, 198, 1)",
                        strokeColor: "rgba(160, 170, 198, 1)",
                        pointColor: "#a0b2c6",
                        pointStrokeColor: "rgba(160, 170, 198, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(160, 170, 198, 1)",
                        data: $platinaPlanoChart
                    }
                ]
            };

            planChartOptions.scaleBeginAtZero = false;
            planChartOptions.multiTooltipTemplate = "<%=datasetLabel %>: <%=value %>%";
            planoChart.Line(planoChartData, planChartOptions);


            //---------------
            //-  RATE CHURN -
            //---------------

            var churnChartCanvas = $("#churnChart").get(0).getContext("2d");
            var churnChart = new Chart(churnChartCanvas);
            var churnChartOptions = ChartOptions;
            var churnChartData = {
                labels: $month,
                datasets: [
                    {
                        label: "Churn",
                        fillColor: "rgba(221, 75, 57, 1)",
                        strokeColor: "rgba(221, 75, 57, 1)",
                        pointColor: "#dd4b39",
                        pointStrokeColor: "rgba(221, 75, 57, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(221, 75, 57, 1)",
                        data: $churnChart
                    }
                ]
            };

            churnChartOptions.tooltipTemplate = "<%if (label){%><%=label%>: <%}%><%= value %>%";
            churnChart.Line(churnChartData, churnChartOptions);

        }
    );
</script>
<?php if( $alert == 1 ){ ?>
<script type="text/javascript">
    $().ready(function () {

        setTimeout(function () {
            $('#aguarde').show(); // "foo" é o id do elemento que seja manipular.
        }, 0); // O valor é representado em milisegundos.

        setTimeout(function () {
            $('#aguarde').hide(); // "foo" é o id do elemento que seja manipular.
        }, 3000); // O valor é representado em milisegundos.
    });

</script>
<?php } ?>
<?php if( $alert == 2 ){ ?>
<script type="text/javascript">
    $().ready(function () {

        setTimeout(function () {
            $('#pesquisa').show(); // "foo" é o id do elemento que seja manipular.
        }, 0); // O valor é representado em milisegundos.

        setTimeout(function () {
            $('#pesquisa').hide(); // "foo" é o id do elemento que seja manipular.
        }, 3000); // O valor é representado em milisegundos.
    });

</script>
<?php } ?>