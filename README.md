# 🚀 Compilador
Trabalho realizado na disciplina de Compiladores no curso **Ciências da computação.**<br>
Professora orientadora: Marcela Leite.

Esse trabalho será divido em fases, segue as fases:

<p align="center">
<img src="img/fases_compilador.png" width="650" text-align="center" height="450">
</p>

________

# 📌 [Analise Léxica](analisador_lexico)
**Objetivo:** Identificar e classificar as "palavras" em uma sentença.<br>
*Obs:* A função principal da análise léxica é criar uma lista de `tokens` que são essas palavras.<br>
`Lexema` é uma sequência de caracteres reconhecidos por um padrão<br>

* Conceitos de forma simples
  * Lexema: o que foi enviado. ex: nomepessoa
  * token: o que é. ex: váriavel
  * Token: pode ser o conjunto todo também. ex: < lexema, token >

___
# 📌 [Análise Sintática](analisador_sintatico)
**Objetivo:** Validar a ordem dos tokens a partir da gramática, e isso pode ser feito pelas:

## 🛠️ Análise Descendente (Top-Down)
Dervivação (mais à esquerda)
 a cada passo: determinar a produção a ser aplicada para uma variaval

* 🏆[Analisador com descida recursiva](analisador_sintatico/top_down/descida_recursiva_v2/)
  * Exige retrocesso **backtrack** que é a recursão, mas isso demanda muito desempenho
  * Criar um procedimento para cada varíavel até achar um terminal

* 🏆 [Analisador Preditivo](analisador_sintatico/top_down/analisador_preditivo/)
    * **First** é os possíveis inicios daquele terminal
    * **Follow** são as proxímas produções do proxímo terminal
    * Tenta prever o próximo token para prever o próximo passo
    * Usa a mesma lógica do automato de pilha
    * Não possui backtrack,

## 🛠️ Análise Ascendente (Bottom-Up)
  * Redução
  * Usa Recursão
  * +complexo e melhor desempenho

Forma de Backus-Naur ou **BNF** `::=`
___________
<details>

<summary> Outros Analisadores:</summary>
<br>
<br>

#### 📌 Análise Sintática

#### 📌 Análise Semântica

#### 📌 Gerador de código Intermediário

#### 📌 Otimizador de código

#### 📌 Gerador de código objeto


</details>

<br><br><br>

# 06/08/2022

## 📌 O que eu fiz Ontem

### Histórico de fechamento do magapay
* Ajustei o fluxo do cancelamento, pois antes a NF estava sendo cancelada mas não estava sendo desvinculada
* Agora segue como o comportamento esperado, desvinculando a NF
* Desenvolvi o formulário de visualização do histórico
* Daniel validou meu código e solicitou alguns ajustes, como a criação do formulário e melhoria das boas práticas de programação para melhorar a visualização do código;
* Finalizei a atividade e enviei a migration para o Sasse conferir (Final do dia ele deu um Ok e disse que o magatec é um sistema isolado e não vai impactar na atualização)
* Enviei também pra Leticia o *Pull request*

### Monitor - Repositórios do app
* Becker tinha solicitado alguns ajustes:
    * Ajustar o cabeçalho da listagem de clientes, no qual eu inclui um titulo para as ações *Editar, Ver WebSite, Repositórios de app e Serviços*
    * Também ajustei a identificador do endpoint de cadastro, o ajuste foi:
        * De: `\cliente\{id}\repository\{repo_name}`
        * Para: `\cliente\{id}\repository`
* Também adicionei uma validação no campo de versão para aceitar somente números, já que antes antes apenas aparecia uma mensagem direto do banco e não era entendível para o usuário de o porquê está estourando o erro
* Finalizei e enviei em feedback pro Becker

## 📌 O que vou fazer hoje

### Relatório de NF por loja
* Essa atividade eu já fiz ela a 1 mes e meio atrás, onde que eu inclui duas colunas: **Valor de Imposto** e **Valor outros**
* Porém a dificuldade dessa atividade é conseguir testar, já que só é possível testar em produção, sendo assim, necessitando vários ajustes;
* O ajuste atual é colocar o subTotal de **Valor Outros** negativo;
* Porém o Mateus(QA) não me explicou o porquê, Então hoje vou ver certinho a RN por trás disso


## 📌 Dificuldades
* Nada que impactou severamente no andamento das atividades
