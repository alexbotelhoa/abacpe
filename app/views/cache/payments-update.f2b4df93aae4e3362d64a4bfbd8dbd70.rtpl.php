<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li><a href="/payments">Pagamentos</a></li>
                    <li class="active"><a href="/payments/<?php echo htmlspecialchars( $payment["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update">Editar</a></li>
                </ol>
            </section> <!-- /.content-header -->

            <section class="container">
                <h1>
                    Editar Pagamento
                </h1>
            </section> <!-- /.content-header -->

            <!-- Main content -->
            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <!-- form start -->
                            <form role="form" action="/payments/<?php echo htmlspecialchars( $payment["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="idclient">Nome Cliente</label>

                                        <!--
                                        <input type="text" class="form-control" id="idclient" name="idclient" step="0.01" placeholder="Informe o ID do Cliente">
                                        -->


                                        <select class="form-control" name="idclient">
                                            <?php $counter1=-1;  if( isset($clients) && ( is_array($clients) || $clients instanceof Traversable ) && sizeof($clients) ) foreach( $clients as $key1 => $value1 ){ $counter1++; ?>

                                            <option <?php if( $value1["id"] == $payment["idclient"] ){ ?> selected="selected" <?php } ?> value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="idplan">Nome Plano</label>
                                        <select class="form-control" name="idplan">
                                            <?php $counter1=-1;  if( isset($plans) && ( is_array($plans) || $plans instanceof Traversable ) && sizeof($plans) ) foreach( $plans as $key1 => $value1 ){ $counter1++; ?>

                                            <option <?php if( $value1["idplan"] == $payment["idplan"] ){ ?> selected="selected" <?php } ?> value="<?php echo htmlspecialchars( $value1["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="vlrecurrence">Recorrência</label>
                                        <select class="form-control" name="vlrecurrence">
                                            <option <?php if( $payment["vlrecurrence"] == 1  ){ ?> selected="selected" <?php } ?> value="1">1 Mês</option>
                                            <option <?php if( $payment["vlrecurrence"] == 3  ){ ?> selected="selected" <?php } ?> value="3">3 Meses</option>
                                            <option <?php if( $payment["vlrecurrence"] == 6  ){ ?> selected="selected" <?php } ?> value="6">6 Meses</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dtpayment">Data Pagamento</label>
                                        <input type="date" class="form-control" id="dtpayment" name="dtpayment" step="0.01" placeholder="dd/mm/yyy" value="<?php echo htmlspecialchars( $payment["dtpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>
                                </div> <!-- /.box-body -->

                                <div class="box-footer">
                                    <div class="col-md-8 col-xs-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                    <?php if( $error != '' ){ ?>

                                    <div class="col-md-4 col-xs-6">
                                        <div class="box-header bg-red">
                                            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>

                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section> <!-- /.content -->

        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div>