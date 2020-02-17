<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-tachometer"></i> Home</a></li>
                    <li class="active"><a href="/plans">Planos</a></li>
                </ol>
            </section>

            <section class="container">
                <h2>Planos</h2>
            </section>

            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="col-md-8 col-xs-6">
                                    <a href="/plans/create" class="btn btn-success">Cadastrar</a>
                                </div>
                                <?php if( $success != '' ){ ?>
                                <div class="col-md-4 col-xs-6">
                                    <div class="box-header bg-green">
                                        <?php echo htmlspecialchars( $success, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px"><a href="/order/plans/ordid">#</a></th>
                                        <th><a href="/order/plans/ordplan">Nome Plano</a></th>
                                        <th><a href="/order/plans/ordvlp">Valor Plano</a></th>
                                        <th style="width: 140px">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter1=-1;  if( isset($plan) && ( is_array($plan) || $plan instanceof Traversable ) && sizeof($plan) ) foreach( $plan as $key1 => $value1 ){ $counter1++; ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars( $value1["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo formatPrice($value1["vlplan"]); ?></td>
                                        <td>
                                            <a href="/plans/<?php echo htmlspecialchars( $value1["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            <a href="/plans/<?php echo htmlspecialchars( $value1["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
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

                                    <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                                    <li><a href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                                    <?php } ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>
</div>