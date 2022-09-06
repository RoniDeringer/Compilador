# 🖥️ Analisador Sintático - Analisador Preditivo

**LL** = analisa a próxima produção

## ⚡ Gramática:

    S   ::=     aB | bC
    B   ::=     bB | &
    C   ::=     cC | &

**Firts**<br>
_Primeiras produções dos terminais_<br>
Ele avalia a próxima produção para voltar e tentar refazer <br> a outra produção caso der erro, ou seja, ele não usa **backtrack**

    First(S) = {a, b}
    First(a) = {a}
    First(B) = {b, &}
    First(C) = {c, &}

**Follow**<br>
Usa um símbolo para indicar o fim da pilha, pode ser qualquer um, vamos usar o `$`<br>
_Determina o próximo terminal da produção atual_<br>
Eu avalio a produção que vem imediatamente depois do terminal que estou avaliando<br>
Obs: Se a próxima produção for vazia eu avalio a outra próxima produção

    Follow(S) = {$}
    Follow(B) = {$}
    Follow(C) = {$}

_____

**Tabela de transição** - Tabela M

 - | a | b | & | c | $
 ---|---|---|---|---|--
 S | S->aB | S->bC | - | - | ACC
 B | - | B->bB | B->& | - | B->&
 C | - | - | C->& | C->cC | ACC


______

Pilha | Entrada | Ação
:---|:---:|---
$ | abb | Empilha S
S$ | abb | Desempilha S <br> Empilha S -> aB
aB$ | bb | Desempilha a
B$ | bb | Desempilha B <br> Empilha produção B -> bB
bB$ | bb | Desempilha b
B$ | b | Desempilha B <br> Empilha produção B -> bB
bB$ | b | Desempilha b
B$ | $ | Desempilha B <br> Empilha B -> b
$ | $ | Acc

____
## ⚡ Outro exemplo:

    FUN         ::=     fun (LISTAVAR){BLOCO}
    LISTAVAR    ::=     VAR LISTAVAR | &
    VAR         ::=     id | const
    BLOCO       ::=     ATRIB | DECLARACAO
    ATRIB       ::=     id = VAR
    DECALRACAO  ::=     dec id


**Firts**<br>
_Primeiras produções dos terminais_<br>
Ele avalia a próxima produção para voltar e tentar refazer <br> a outra produção caso der erro, ou seja, ele não usa **backtrack**

    First(FUN)        : {fun}
    First(LISTAVAR)   : {id, const, &}
    First(VAR)        : {id, const}
    First(BLOCO)      : {id, dec}
    First(ATRIB)      : {id}
    First(DECLARACAO) : {dec}


**Follow**<br>
Usa um símbolo para indicar o fim da pilha, pode ser qualquer um, vamos usar o `$`<br>
_Determina o próximo terminal da produção atual_<br>
Eu avalio a produção que vem imediatamente depois do terminal que estou avaliando<br>
Obs: Se a próxima produção for vazia eu avalio a outra próxima produção

    Follow(FUN)        = {$}
    Follow(LISTAVAR)   = {)}
    Follow(VAR)        = {id, const, &, )}
    Follow(BLOCO)      = {}}
    Follow(ATRIB)      = {}}
    Follow(DECLARACAO) = {}}


**Tabela de transição** - Tabela M

<p align="center">
<img src="img\tabela_m.png" width="630" text-align="center" height="200">
</p>
______

Pilha | Entrada | Ação
:---|:---:|---
$ | abb | Empilha S
S$ | abb | Desempilha S <br> Empilha S -> aB
aB$ | bb | Desempilha a
B$ | bb | Desempilha B <br> Empilha produção B -> bB
bB$ | bb | Desempilha b
B$ | b | Desempilha B <br> Empilha produção B -> bB
bB$ | b | Desempilha b
B$ | $ | Desempilha B <br> Empilha B -> b
$ | $ | Acc