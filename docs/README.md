
# Partes

## SSO Server

O SSO Server é o serviço responsável pela autenticação do usuário e por registra os Brokers. Somente os Brokers registrados podem tentar fazer login no SSO Server.

## Broker

O Broker é a aplicação (pagina web, api, etc) que você quer permitir que o usuário acesse após se autenticar no SSO Server. Cada Broker possui um ID e uma chave privada que é utilizada para fazer a conexão entre o Broker e o SSO Server.

Quando uma nova requisição é feita por um Broker, este recebe do SSO Server um token referente a requisição, no ambiente em qual ele foi requisitado. Isso vai ficar mais claro logo abaixo.

## Client

Client é quem deseja se autenticar no SSO Server para acessar conteúdos que são disponibilizados pelos Brokers.

# Como funciona tudo isso?

Um cliente no nosso caso é um assinante. O assinante possui credenciais de acesso a aplicação e elas que são utilizadas para autenticar no SSO Server.

O assinante só pode se autenticar através de algum Broker. No exemplo que estamos utilizando, nós temos, então, dois Brokers:

    Broker App Financeiro (BAF)
    Broker App Site (BAS)

Quando um Client instancia um BAF via Browser, por ex., o Broker vai até o SSO Server e se autentica. Após se autenticar, ele devolve para o Client um Cookie com um hash único que o identifica, dentro daquela instância.




Cada aplicação tem sua própria gerência de sessão. 



## Caso #1: Usuário não possui sessão ativa

    O cliente abre o browser e requisita um conteúdo privado;
    O Broker Session Manager entra e ação e verifica se o Client possui sessão ativa;
    Se não possuir, o Client é redirecionado para a página de login. Ele entra com as suas credenciais e submete o formulário;
    Nesse momento, duas autenticações acontecem:
    1. O Broker se autentica no SSO Server;
    2. O usuário se autentica pelo SSO Server.
    Independente das credenciais do Client serem válidas, o SSO Server retorna para o Broker um token único daquela requisição, que por sua vez é salva num Cookie no navegador do Client.
    Se as credenciais forem válidas, o SSO Server retorna para o Broker um objeto com o Assinante. Considere isso como primeiro retorno e ele tem algumas informações importantes. A primeira é que ele contém dados da sessão que foi criada no SSO Server que contem o Objeto Assinante. A segunda é que ela contém m token de acesso que dá permissão para acessar a API do sistema financeiro, que também é um Broker, lembra? Ele é o Broker App Financeiro (BAF).
    O Broker, ao receber o Objeto do Assinante, procura por um cabeçalho do Assinante no próprio Broker. Esse cabeçalho é uma entidade de mapeamento. É como se também houvesse no Broker uma Assinantes com o ID do assinante no Broker e o ID do assinante do SSO Server. Isso nos permite a fazer algo como “Logar Como…” e é isso que o Broker faz. Depois de encontrar o assinante nele mesmo, ele internamente faz uma autenticação por ID. Só que nesse caso o ID utilizado é o ID do artista no SSO Server.
    Por fim, o Broker retorna para o Client Cookies que representam as duas sessões existentes para esse Client.

## Caso #2: Autenticando em outro Broker

Vamos considerar aqui que agora queremos acessar o conteúdo do sistema de Mensagens (Broker App Mensagens — BAM). Para isso, o usuário precisa se autenticar também no sistema de mensagem, mas NÃO precisa se autenticar novamente no SSO Server, pois ele já possui uma sessão ativa com o SSO Server.

Logo, o processo é semelhante ao Caso #1, a diferença é que a única coisa que precisamos fazer é recuperar o Objeto Assinante (que o Client já tem) e forçar um novo login no sistema de Mensagens. Ou seja, só precisamos executar o passo 6 e 7 do Caso #1. Feito isso, temos um novo login também no Broker App Mensagens e o Client passa a ter um novo Cookie com informações do novo Broker.

Esse processo se repete para todos os demais Brokers.
## Caso #3: Brokers que possuem formulário de login

Quando se trata de integração com APIs, é fácil de entender o processo, a autenticação forçada para acontecer internamente sem que o usuário perceba, etc. Mas quando temos dois Brokers que possuem formulário de login, como fazemos?

Esse é um dos grandes trunfos do SSO. Lembra que todos os Brokers são identificáveis no SSO Server? Lembra também que o Client, quando autenticado, possui uma Sessão ativa com o SSO Server? Então… É aqui que a mágica acontece.

Digamos que vc tem um Broker App Financeiro e outro com o seu CMS. Quando o usuário se autentica pelo Broker App Financeiro, no momento que ele requisitar algo no privado no CMS, o Broker Session Manager do CMS entrará em ação. Ai tudo acontece como disse no Caso #2 sem apresentar pro usuário um formulário de login. A autenticação acontece internamente. Simples assim.

Se o usuário iniciar a sessão no CMS e requisitar algo no Broker App Financeiro, o Broker Session Manager do Financeiro irá agir da mesma maneira e, dessa vez, é o formulário de login do Broker App Financeiro que não será apresentado pro usuário.

Isso significa que quando o Client se autentica em qualquer um dos Brokers, automaticamente ele estará autenticado no outro.