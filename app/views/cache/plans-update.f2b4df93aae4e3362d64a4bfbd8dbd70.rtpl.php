<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-tachometer"></i> Home</a></li>
                    <li><a href="/plans">Planos</a></li>
                    <li class="active"><a href="/plans/<?php echo htmlspecialchars( $plan["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update">Editar</a></li>
                </ol>
            </section>

            <section class="container">
                <h2>Editar Plano</h2>
            </section>

            <!-- Main content -->
            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <!-- form start -->
                            <form role="form" action="/plans/<?php echo htmlspecialchars( $plan["idplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="desplan">Nome Plano</label>
                                        <input type="text" class="form-control" id="desplan" name="desplan"
                                               placeholder="Digite o nome do produto" value="<?php echo htmlspecialchars( $plan["desplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="vlplan">Valor Plano</label>
                                        <input type="number" class="form-control" id="vlplan" name="vlplan" step="0.01"
                                               placeholder="0.00" value="<?php echo htmlspecialchars( $plan["vlplan"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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