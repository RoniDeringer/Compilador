# 🖥️ Analisador Sintático - Descida Recursiva

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

* fazer uma grámatica na ferramenta **gals** pra aceitar os valores ali
* Fazer um Objeto chamada Token que vai ter: token, lexema, pos. inicial, pos. final,
* Fazer uma classe main, que vai chamar os analisadores lexicos e sintaticos
* O analisador lexico vai servir como parametro pro analisador sintatico
* e a verificacao vai ocorrer dentro do analisador sintatico
* IMPRIMIR:
    * lista de tokens do analisador lexico
    * o retorno do analisador sintatico se o código foi aceito ou nao

LL LEFT -> RIGHT  derivação mais a esquerda

## 🔧 Ferramenta Gals:
Tokens:

    if:"if"
    AP:"("
    FP:")"
    id:{letras}({letras}|{numeros})*
    const:{numeros} +
    :{ws}
    PV:";"

Definições Regulares:

    letras:[a-zA-Z]
    numeros[0-9]
    ws:[\ \n\r]

Nao terminais

    <P>
    <VAR>


gramatica

    <P> ::=if AP <VAR> FP const PV;
    <VAR> ::= id|const;

**$** significa q deu tudo certo

## ⚡ Gramática:

    PROGRAMA        ::=
    S               ::=     funcao( LISTA_PARAMETRO ){ LISTA_CORPO } | LISTA_CORPO
    LISTA_CORPO     ::=     & | CORPO | CORPO LISTA_CORPO
    CORPO           ::=     IMPRIMA | VARIAVEL | IF
    LISTA_PARAMETRO ::=     & | VARIAVEL | VARIAVEL LISTA_PARAMETRO
    IMPRIMA         ::=     imprima VARIAVEL
    IF              ::=     if( BLOCO )
    BLOCO           ::=     PARAM OPERADOR PARAM
    OPERADOR        ::=     > | < | == | !=
    PARAM           ::=     VARIAVEL | CONST
    CONST           ::=     NUMEROS
