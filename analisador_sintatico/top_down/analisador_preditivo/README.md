# 🖥️ Analisador Sintático - Analisador Preditivo

## ⚡ Gramática:

    S   ::=     aB | bC
    B   ::=     bB | &
    C   ::=     cC | &

**Firts**<br>
_Primeiras produções dos terminais_<br>

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

Tabela de transição:

 - | a | b | & | c | $
 ---|---|---|---|---|--
 S | S->aB | S->bC | - | - | ACC
 B | - | B->bB | B->& | - | B->&
 C | - | - | C->& | C->cC | ACC



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