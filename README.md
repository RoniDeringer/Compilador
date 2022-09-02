# 🚀 Compilador
Trabalho realizado na disciplina de Compiladores no curso de Ciências da computação.
Professora orientadora: Marcela Leite.

Esse trabalho será divido em fases, segue as fases:
![Segue os indices:](img/fases_compilador.png)


## 📌 [Analise Léxica](analisador_lexico)
**Objetivo:** Identificar e classificar as "palavras" em uma sentença.<br>
*Obs:* A função principal da análise léxica é criar uma lista de `tokens` que são essas palavras.<br>
`Lexema` é uma sequência de caracteres reconhecidos por um padrão<br>

* Conceitos de forma simples
  * Lexema: o que foi enviado. ex: nomepessoa
  * token: o que é. ex: váriavel
  * Token: pode ser o conjunto todo também. ex: < lexema, token >

___
## 📌 Análise Sintática
**Objetivo:** Validar a ordem dos tokens a partir da gramática, e isso pode ser feito pelas:

#### Análise Descendente [(Top-Down)](/analisador_sintatico/top_down)
Dervivação (mais à esquerda)
 a cada passo: determinar a produção a ser aplicada para uma variaval
* Analisador com descida recursiva
  * Exige retrocesso **backtrack** que é a recursão, mas isso demanda muito desempenho
  * Criar um procedimento para cada varíavel até achar um terminal

* Analisador Preditivo
    * **First** é os possíveis inicios daquele terminal
    * Tenta prever o próximo token para prever o próximo passo
    * Usa a mesma lógica do automato de pilha
    * Não possui backtrack,

####  Análise Ascendente (Bottom-Up)
  * Redução
  * Usa Recursão
  * +complexo e melhor desempenho


Forma de Backus-Naur ou **BNF** `::=`


<br>
<br>

#### 📌 Análise Sintática

#### 📌 Análise Semântica

#### 📌 Gerador de código Intermediário

#### 📌 Otimizador de código

#### 📌 Gerador de código objeto

