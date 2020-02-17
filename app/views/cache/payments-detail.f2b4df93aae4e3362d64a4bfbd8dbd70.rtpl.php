<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-tachometer"></i> Home</a></li>
                    <li class="active"><a href="/payments">Pagamentos</a></li>
                    <li class="active"><a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail">Cliente</a></li>
                </ol>
            </section>

            <section class="container">
                <div class="col-xs-7">
                    <h2>Cliente</h2>
                </div>
                <div class="col-xs-5" align="right">
                    <a href="/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/create" class="btn btn-success">Cadastrar Pagamento</a>
                </div>
            </section>

            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-header">
                                <?php if( $success != '' ){ ?>
                                    <div class="box-header bg-green" align="center">
                                        <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px"><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordid">ID</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordcli">Cliente</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordpla">Plano</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordrec">Recor</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/orddtp">Data</a></th>
                                        <th><a href="/order/payments/<?php echo htmlspecialchars( $idclient, ENT_COMPAT, 'UTF-8', FALSE ); ?>/detail/ordvlp">Valor</a></th>
                                        <th style="width: 140px">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter1=-1;  if( isset($payment) && ( is_array($payment) || $payment instanceof Traversable ) && sizeof($payment) ) foreach( $payment as $key1 => $value1 ){ $counter1++; ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["desclient"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["vlrecurrence"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo formatDate($value1["dtpayment"]); ?></td>
                                        <td><?php echo formatPrice($value1["vlpayment"]); ?></td>
                                        <td>
                                            <a href="/payments/<?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            <a href="/payments/<?php echo htmlspecialchars( $value1["idpayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
            </section>

        </div>
    </section>
</div>