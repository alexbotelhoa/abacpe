<h2>Sistema de Controle Empresarial</h2>
<p><b>Versão 1.0.0 - Documentação</b></p>
<p><b>Geral</b> - O sistema foi batizado geréricamente de Sistema de Controle Empresarial.
    Todo o sistema foi trabalhado para ser responsivo à todas as plataformas de visualização, Monitores, Tablets e Celulares.
    O sistema está publicado na web utilizando o recurso Lightsail da Amazon, para haver visualização do sistema em funcionamento.
    O código fonte do sistema encontra-se publicado no meu GitHub (https://github.com/alexbotelhoa) para visualizações.
</p>
<p>
    <b>Cabeçalho</b> - Foi criado um logotipo para melhor aparência do sistema.
    Logo a baixo encontra-se o menu com cinco opções: Home, Planos, Pagamentos, Estatísticas, Sobre e Campos (Mês e Ano) para Pesquisa de Dados.
</p>
<p>
    <b>Rodapé</b> - Existe um quadros informativos da 'Empresa Hallyz Cia & Ltda' (fake).
</p>
<p>
    <b>&#8226; Página Home</b> - Utilizada apenas para visualização do andamento dos estatísticas macro da empresa.
    Nessa página constam os gráficos 'Métricas SaaS','MRR', 'Receitas Variáveis', 'Ticket Médio (ARPU)' e 'Receitas Variáveis Fatiada'.
    No canto superior direito de cada gráfico, existem opções de minimizar o quadro e de fechá-lo. Retornando quando a página for atualizada.
    No canto superior esquerdo, há um botão para maiores informações sobre cada gráfico.
</p>
<p>
    <b>&#8226; Página Planos</b> - Utilizada para visualização, criação, edição e exclusão dos Planos.
    Clicando nos títulos de cada coluna da tabela, automáticamente toda a tabela será ordenado em ordem crescente de acordo com a coluna escolhida.
    Abaixo da tabela tem a opção de paginação, pois foi configurado para apresenar apenas 20 Planos por página.
    Para realizar um cadastro, basta clicar em 'Cadastrar', informar o nome do plano, o valor do plano e depois clicar em 'Cadastrar'.
    Para realiar uma alteração, basta clicar em 'Editar' e alterar as informações desejadas e depois clicar em 'Salvar'.
    Para excluir um registro, basta clicar em 'Excluir' e confirmar a exclusão para finalizar o processo.
    Importante: Existe uma restrição criada no sistema, para não ser possível excluir um plano que tenha pagamentos vinculados.
</p>
<p>
    <b>&#8226; Página Pagamentos</b> - Utilizada para visualização, criação, edição e exclusão de Pagamentos.
    Clicando nos títulos de cada coluna da tabela, automáticamente toda a tabela será ordenado em ordem crescente de acordo com a coluna escolhida.
    Abaixo da tabela tem a opção de paginação, pois foi configurado para apresenar apenas 20 Pagamentos por página.
    Entrando no página aparecerá uma lista de Clientes, mostrando o último plano vgente desse Cliente e a quantidade de pagamentos efetuados por ele.
    Para visualizar os Pagamentos de um cliente basta clicar no botão 'Detalhes'.
    Para realizar com cadastro, basta clicar em 'Cadastrar', selecionar o nome do Cliente, o nome do Plano, definir a recorrência desse pagamento, definir a data do pagamento e depois clicar em 'Cadastrar'.
    Para realiar uma alteração, basta clicar em 'Editar' e alterar as informações desejadas e depois clicar em 'Salvar'.
    Para excluir um registro, basta clicar em 'Excluir' e confirmar a exclusão para finalizar o processo.
</p>
<p>
    <b>&#8226; Página Estatísticas</b> - Utilizada apenas para visualização do andamento das estatísticas analíticas da empresa.
    Nessa página constam os gráficos 'Métricas SaaS', 'Nicho de Mercado', 'Planos Vendidos', 'Rate Churn' e 'Top 5 das Região'.
    No canto superior direito de cada gráfico, existem opções de minimizar o quadro e de fechá-lo. Retornando quando a página for atualizada.
    No canto superior esquerdo, há um botão para maiores informações sobre cada gráfico.
</p>
<p>
    <b>&#8226; Página Sobre</b> - Página utilizada para registro das informações do sistema, tanto quanto os recursos utilizados para o seu desenvolvimento.
</p>