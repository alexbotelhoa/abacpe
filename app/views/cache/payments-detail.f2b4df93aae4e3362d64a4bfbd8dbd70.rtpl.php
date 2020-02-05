<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                    <li class="active"><a href="/payments">Pagamentos</a></li>
                    <li class="active"><a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail">Detalhes</a></li>
                </ol>
            </section> <!-- /.content-header -->

            <section class="container">
                <h1>
                    Detalhes
                </h1>
            </section> <!-- /.content-header -->





            <!-- Main content -->
            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-header">
                                <div class="col-md-8 col-xs-6">
                                    <a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/create" class="btn btn-success">Cadastrar Pagamento</a>
                                </div>
                                <?php if( $success != '' ){ ?>
                                <div class="col-md-4 col-xs-6">
                                    <div class="box-header bg-green">
                                        <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div> <!-- /.box-header -->

                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px"><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordid">#</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordcli">Nome Cliente</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordpla">Nome Plano</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordrec">Recorrência</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordvlp">Valor Pagamento</a></th>
                                        <th style="width: 140px">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter1=-1;  if( isset($payment) && ( is_array($payment) || $payment instanceof Traversable ) && sizeof($payment) ) foreach( $payment as $key1 => $value1 ){ $counter1++; ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["idclient"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["vlrecurrence"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["vlpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td>
                                            <a href="/payments/<?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            <a href="/payments/<?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div> <!-- /.box-body -->
                        </div>

                        <div class="product-pagination text-center">
                            <nav>
                                <ul class="pagination">

                                    <li><a href="/payments?page=1"><<</a></li>
                                    <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                                    <li><a href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php if( $counter1 == 2 ){ ?><b><?php echo htmlspecialchars( $value1["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b><?php }else{ ?><?php echo htmlspecialchars( $value1["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></a></li>
                                    <?php } ?>
                                    <li><a href="/payments?page=<?php echo htmlspecialchars( $lastpage, ENT_COMPAT, 'UTF-8', FALSE ); ?>">>></a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section> <!-- /.content -->






        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div>