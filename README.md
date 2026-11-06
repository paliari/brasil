Utilidades para brasil.
===============


## Install

```bash

 composer require paliari/brasil

```

CPF, CNPJ, UF, Date

### CNPJ alfanumérico

`CNPJ::validar`, `CNPJ::formatar`, `CNPJ::validarFormato` e `Mascaras::formataCPFCNPJ`
aceitam o CNPJ alfanumérico (ex.: `12.ABC.345/01DE-35`), mantendo compatibilidade com o numérico.

```php
CNPJ::gerar();     // numérico, ex.: 92.122.313/0001-30
CNPJ::gerar(true); // alfanumérico, ex.: NN.7G6.EHN/SALO-26
```

### MASCARAS: 
- formataCNPJ
- formataCPF
- formataCPFCNPJ
- formataCOSIF
- formataCMC
- formataCEP
- formataCodLS
- formataFone
- formataCodVal
- formataMoeda
- formataNumero


### valorExtenso


### DATA:

- dataExtensa
- proxDiaUtil
- anteriorDiaUtil
- toMesRef
- dateTimeToXMLValue
- dateTimeToString
- dateToXMLValue
- diasDeDate
