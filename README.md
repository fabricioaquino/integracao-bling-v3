
# Integração com a Bling V3

Um exemplo simples de como autenticar e gravar o token em um BD SQlite.

1 - Baixe o projeto e habilite o drive do SQlite no .ini do PHP.

2 - Execute o projeto, vai ser criado um arquivo db.sqlite 

2 - Siga o fluxo de autorização e cadastre um aplicativo https://developer.bling.com.br/aplicativos#fluxo-de-autoriza%C3%A7%C3%A3o

3 - Durante o cadastro no campo ```Link de redirecionamento``` adicione a URL http://localhost:sua-porta/login.php

3 - No arquivo ```login.php``` na linha 10 e 11 preencha as variáveis com os dados do seu app da bling