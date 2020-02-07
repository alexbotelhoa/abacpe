<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <section class="content">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="container">
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-tachometer"></i> Home</a></li>
                    <li class="active"><a href="/about">Sobre</a></li>
                </ol>
            </section>

            <section class="container">
                <h2>Sobre</h2>
            </section>

            <!-- Main content -->
            <section class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="col-md-12 col-sm-12">
                                <div class="box-header">
                                    <div class="callout callout-info">
                                        <h2>==> PRECISA ATUALIZAR AS INFORMAÇÕES <==</h2>
                                        <h2>Sistema de Controle Empresarial</h2>
                                        <p><b>Versão 1.0.0 - Documentação</b></p>
                                        <p><b>Geral</b> - O sistema foi batizado geréricamente de Sistema de Controle de Projetos.
                                            Todo o sistema foi trabalhado para ser responsivo à todas as plataformas de visualização, como Desktop, Tablets e Celulares.
                                            O sistema está publicado na web utilizando o recurso Lightsail da Amazon, para haver visualização do sistema em funcionamento.
                                            O código fonte do sistema encontra-se publicado no meu GitHub (https://github.com/alexbotelhoa) para visualizações.
                                        </p>
                                        <p>
                                            <b>Cabeçalho</b> - Não foi colocado um recurso à ser implementado de tradução da página. Foi criado um logotipo para melhor aparência do sistema.
                                            Logo a baixo encontra-se o menu com cinco opções: Home, Projetos, Tarefas, Status e Sobre.
                                        </p>
                                        <p>
                                            <b>Rodapé</b> - Existe três quadros informativos, um da 'Empresa Hallyz Cia & Ltda' (fake), um de 'Navegação' servido apenas como atalhos do sistema e
                                            um recursos à ser desenvolvido de 'Newsletter'.
                                        </p>
                                        <p>
                                            <b>&#8226; Página Home</b> - Utilizada apenas para visualização do andamento dos projetos e das tarefas.
                                            No gráfico 'Status dos Projetos' em formato de Donut, mostrar o andamento geral dos projetos, os projetos atrasados em vermelho e não atrasados em verde.
                                            No quadro 'Tarefas Antigas', mostra as 6 tarefas com status 'Aberta' e com data de fechamento mais antigas. É possível fechar a terefa através desse quadra.
                                            No canto superior direito dos quadros 'Status dos Projetos' e 'Tarefas Antigas', existem opções de minimizar o quadro e de fechá-lo. Retornando quando a página for atualizada.
                                            No quadro 'Últimos 6 Projetos', mostra os 6 projetos mais recentemente criados e informando o status de atrasado em vermelho e não atrasado em verde e clicando nos botões 'PREV' e 'NEXT' você pode percorrer por esses projetos.
                                        </p>
                                        <p>
                                            <b>&#8226; Página Projetos</b> - Utilizada para visualização, criação, edição e exclusão de projetos.
                                            Clicando nos títulos de cada coluna da tabela, automáticamente toda a tabela será ordenado em ordem crescente de acordo com a coluna escolhida.
                                            Abaixo da tabela tem a opção de paginação, pois foi configurado para apresenar apenas seis projetos por página.
                                            Para realizar com cadastro, basta clicar em 'Cadastrar Projeto', informar o nome do projeto, a data de previsão de início do projeto e a data de previsão de fechamento do projeto e depois clicar em 'Cadastrar'.
                                            Para realiar uma alteração, basta clicar em 'Editar' e alterar as informações desejadas e depois clicar em 'Salvar' e para excluir, basta clicar em 'Excluir' e confirmar a exclusão para finalizar o processo.
                                            Importante: Existe uma restrição criada no sistema, para não ser possível excluir um projeto que tenha tarefas vinculadas.
                                        </p>
                                        <p>
                                            <b>&#8226; Página Tarefas</b> - Utilizada para visualização, criação, edição e exclusão de tarefas.
                                            Clicando nos títulos de cada coluna da tabela, automáticamente toda a tabela será ordenado em ordem crescente de acordo com a coluna escolhida.
                                            Existe a opção de fechar a tarefas nessa tabela, para alterar o status de uma tarefa, basta clicar no botão existente na coluna 'Situação' referente a tarefa escolhida.
                                            Abaixo da tabela tem a opção de paginação, pois foi configurado para apresenar apenas seis tarefas por página.
                                            Para realizar com cadastro, basta clicar em 'Cadastrar Tarefas', informar o nome da tarefa, escolher a qual projeto estará vinculada essa tarefa, informar a data de previsão de início da tarefa e a data de previsão de fechamento da tarefa e depois clicar em 'Cadastrar'.
                                            Para realiar uma alteração, basta clicar em 'Editar' e alterar as informações desejadas e depois clicar em 'Salvar' e para excluir, basta clicar em 'Excluir' e confirmar a exclusão para finalizar o processo.
                                        </p>
                                        <p>
                                            <b>&#8226; Página Status</b> - Utilizada para uma visualização mais detalhada dos projetos Atrasados e Não Atrasado, com relação a página principal.
                                            Clicando nos títulos de cada coluna da tabela, automáticamente toda a tabela será ordenado em ordem crescente de acordo com a coluna escolhida.
                                        </p>
                                        <p>
                                            <b>&#8226; Página Sobre</b> - Página utilizada para registro das informações do sistema, tanto quanto os recursos utilizados para o seu desenvolvimento.
                                        </p>
                                    </div>
                                </div> <!-- /.box-header -->
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="box-header">
                                    <div class="callout callout-info">
                                        <p>Recursos utilizados no Front-End:</p>
                                        <p>
                                            <ul>
                                                <li><i class="fab fa-html5"></i> HTML 5 - Novos conceitos de marcação de código</li>
                                                <li><i class="fab fa-js"></i> JavaScript - Utilizados em vários recursos</li>
                                                <li><i class="fab fa-bootstrap"></i> Bootstrap v3.2.0 - Utilizado no layout das páginas</li>
                                                <li><i class="fab fa-fonticons"></i> Font Awesome Free v5.12.0 - Para os ícones</li>
                                                <li><i class="fab fa-css3"></i> CSS v3.0.0 - Para vários stylos de font no site</li>
                                                <li>j<i class="fab fa-quora"></i> jQuery v1.11.1 - Para o slides em carrossel</li>
                                                <li><i class="far fa-file-code"></i> BxSlider v4.1.2 - Para o slides em carrossel</li>
                                                <li><i class="far fa-file-code"></i> Ionicons v2.0.0 - Utilizado no ícone do carrossel</li>
                                            </ul>
                                        </p>
                                    </div>
                                </div> <!-- /.box-header -->
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="box-header">
                                    <div class="callout callout-info">
                                        <p>Recursos utilizados no Back-End:</p>
                                        <p>
                                            <ul>
                                                <li><i class="fas fa-database"></i> MariaDB v10.4.10 - Utlizado como SGBD</li>
                                                <li><i class="fas fa-feather-alt"></i> Apache v2.4.41 - Como Web Services</li>
                                                <li><i class="fab fa-php"></i> PHP v7.3.12 - Linguagem com foco em POO</li>
                                                <li><i class="fas fa-link"></i>  PDO - Utilizado para conexão com o BD</li>
                                                <li><i class="far fa-music"></i> Composer - Para gerenciar as dependências do projeto</li>
                                                <li><i class="far fa-rainbow"></i> RainTLP v3.0.0 - Para separas as camadas de desenvolvimento</li>
                                                <li><i class="far fa-file-code"></i> Slim v2.6.3 - Para melhoras a navegação e chamadas de recursos</li>
                                            </ul>
                                        </p>
                                    </div>
                                </div> <!-- /.box-header -->
                            </div>

                        </div>
                    </div>
                </div>
            </section> <!-- /.content -->


        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div>