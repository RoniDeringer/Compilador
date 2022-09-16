# 🖥️ Analisador SLR

## ⚒️ O que precisa ser feito:
Fazer um analisador Sintático que aceite:

    funcao nome (variavel){
        tipo variavel = valor
        if(valor > numero){
            imprime (valor)
        }
    }
    chama nome()


## 📌 Dicas:

LR RIGHT -> RIGHT  derivação mais a direita

### AUTOMATO

* o ponto define o lugar q ta lendo
* fazer todas as transições
* todas as reduções e desvios que será feito
* mostrar todas as possibilidades até achar um terminal

### AÇÃO
* utiliza o conceito de follows e firts
* reduz sempre nos follows
* shift _S_
* redução _R_
* reudução inica a qtd de estados para desimpilhar 



### GOTO
* mostra para qual estado desviar para indicar a redução
* 


### PILHA

pilha | entrada | ação
---|----|---
num. de todas as pilhas | o q ta lendo | S ou reduz e desvio

obs: reduz e desvio não avação os estados

## ⚡ Gramática:

    <P>             ::=     DEC ID ABRE_PAR <LISTA_PARAM> FECHA_PAR ABRE_BLOCO <LISTA_BLOCO> FECHA_BLOCO
    <LISTA_PARAM>   ::=     <PARAM> VIRGULA <LISTA_PARAM> | <PARAM>
    <PARAM          ::=     TIPO ID
    <LISTA_BLOCO>   ::=     <BLOCO> <LISTA_BLOCO> | EPSILON
    <BLOCO>         ::=     <ATR> | <SEL_IF>
    <ATR>           ::=     ID ATRIBUICAO <VAR>
    <VAR>           ::=     ID | CONST
    <SEL_IF>        ::=     IF ABRE_PAR ID COMPARA ID FECHA_PAR ABRE_BLOCO <BLOCO> FECHA_BLOCO


## ⚡ Ação:


