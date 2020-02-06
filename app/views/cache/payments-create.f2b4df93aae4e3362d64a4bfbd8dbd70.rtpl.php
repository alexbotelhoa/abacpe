<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li><a href="/payments">Pagamentos</a></li>
                    <?php if( $idclient != '' ){ ?>

                        <li class="active"><a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail">Cliente</a></li>
                        <li class="active"><a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/create">Cadastrar</a></li>
                    <?php }else{ ?>

                        <li class="active"><a href="/payments/create">Cadastrar</a></li>
                    <?php } ?>

                </ol>
            </section> <!-- /.content-header -->

            <section class="container">
                <h1>
                    Cadastrar Pagamento
                </h1>
            </section> <!-- /.content-header -->

            <!-- Main content -->
            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">

                            <!-- form start -->
                            <form role="form" action="/payments/<?php if( $idclient != '' ){ ?><?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php } ?>create" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="idclient">Nome do Cliente</label>



                                        <select class="form-control" name="idclient">

                                            <?php if( $idclient != '' ){ ?>


                                                <?php $counter1=-1;  if( isset($clients) && ( is_array($clients) || $clients instanceof Traversable ) && sizeof($clients) ) foreach( $clients as $key1 => $value1 ){ $counter1++; ?>


                                                    <?php if( $value1["id"] == $idclient ){ ?>

                                                        <option selected value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php } ?>


                                                <?php } ?>


                                            <?php }else{ ?>

                                                <option selected value="">Selecione o cliente</option>
                                                <?php $counter1=-1;  if( isset($clients) && ( is_array($clients) || $clients instanceof Traversable ) && sizeof($clients) ) foreach( $clients as $key1 => $value1 ){ $counter1++; ?>

                                                    <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>


                                            <?php } ?>


                                        </select>



                                    </div>

                                    <div class="form-group">
                                        <label for="idplan">Nome do Plano</label>
                                        <select class="form-control" name="idplan">
                                            <option selected value="">Selecione o plano</option>
                                            <?php $counter1=-1;  if( isset($plans) && ( is_array($plans) || $plans instanceof Traversable ) && sizeof($plans) ) foreach( $plans as $key1 => $value1 ){ $counter1++; ?>

                                            <option value="<?php echo htmlspecialchars( $value1["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>  -  R$ <?php echo formatPrice($value1["vlplan"]); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="vlrecurrence">Recorrência do Pagamento</label>
                                        <select class="form-control" name="vlrecurrence">
                                            <option selected value="">Selecione a recorrência</option>
                                            <option value="1">1 Mês</option>
                                            <option value="3">3 Meses</option>
                                            <option value="6">6 Meses</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dtpayment">Data do Pagamento</label>
                                        <input type="date" class="form-control" id="dtpayment" name="dtpayment" step="0.01" placeholder="dd/mm/yyyy">
                                    </div>
                                </div> <!-- /.box-body -->

                                <div class="box-footer">
                                    <div class="col-md-8 col-xs-6">
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                    </div>
                                    <?php if( $error != '' ){ ?>

                                    <div class="col-md-4 col-xs-6">
                                        <div class="box-header bg-red" align="center">
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