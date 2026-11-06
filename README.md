# paliari/brasil

Utilidades para o Brasil em PHP: validação e formatação de CPF e CNPJ (incluindo o
**CNPJ alfanumérico**), máscaras, valor por extenso, datas no formato brasileiro,
dias úteis e feriados nacionais, UFs, meses e dias da semana.

## Requisitos

- PHP 8.2 ou superior (testado até o 8.5)
- Carbon 3, via [`paliari/php-date-time`](https://github.com/paliari/php-date-time) 3

## Instalação

```bash
composer require paliari/brasil
```

| Versão do brasil | Carbon | paliari/php-date-time | PHP |
|---|---|---|---|
| 4.x | 3 | ^3.0 | ^8.2 |
| 3.1 (branch `3.x`) | 2 | ^2.0 | ^8.2 |

Projetos que ainda usam Carbon 2 devem instalar `composer require paliari/brasil:^3.1`.

## Atualizando da 3.x para a 4.0

A API do `brasil` (CPF, CNPJ, máscaras, `DiaUtil`, `DataExtenso` etc.) não mudou, e as
saídas de `DateBr`, `DateTimeBr` e `DateMesBr` (`__toString`, `toJSON`, `dataExtenso`)
continuam as mesmas.

A quebra vem do Carbon: `DateBr`, `DateTimeBr` e `DateMesBr` passam a ser objetos
**Carbon 3**. Se você chama métodos do Carbon nesses objetos, revise principalmente:

- `diffIn*` retorna `float` e com sinal por padrão (ex.: `diffInDays` de uma data futura para
  uma passada é negativo). Para dias inteiros, prefira `intervalDays()`, que retorna `int`.
- `createFromTimestamp` usa UTC por padrão.
- Métodos de criação e setters ficam mais estritos com valores inválidos.

Seu projeto também precisa aceitar Carbon 3. Veja o
[guia de migração do Carbon 3](https://carbon.nesbot.com/guide/getting-started/migration.html#migrate-to-carbon-3).

## CPF

```php
use Paliari\Brasil\CPF;

CPF::validar('123.456.789-09');        // true
CPF::validarFormato('123.456.789-09'); // true (só confere a máscara)
CPF::formatar('12345678909');          // '123.456.789-09'
CPF::digitos('123.456.789-09');        // '12345678909'
CPF::verificador('123.456.789-09');    // '09'
CPF::gerar();                          // CPF válido aleatório, já formatado
```

`formatar` e `verificador` retornam `''` quando a entrada não tem 11 dígitos.

## CNPJ

Suporta o CNPJ numérico e o alfanumérico da Receita Federal (12 primeiras posições
`A-Z0-9`, 2 dígitos verificadores numéricos).

```php
use Paliari\Brasil\CNPJ;

CNPJ::validar('92.122.313/0001-30');        // true
CNPJ::validar('12.ABC.345/01DE-35');        // true
CNPJ::validarFormato('12.ABC.345/01DE-35'); // true (só confere a máscara)
CNPJ::formatar('12abc34501de35');           // '12.ABC.345/01DE-35'
CNPJ::digitos('12.abc.345/01de-35');        // '12ABC34501DE35'
CNPJ::verificador('92.122.313/0001-30');    // '30'
CNPJ::gerar();                              // numérico, ex.: '92.122.313/0001-30'
CNPJ::gerar(true);                          // alfanumérico, ex.: 'NN.7G6.EHN/SALO-26'
```

`formatar` e `verificador` retornam `''` quando a entrada não tem 14 caracteres ou o
dígito verificador não é numérico. Letras fazem parte do CNPJ e não são descartadas.

## Máscaras

```php
use Paliari\Brasil\Mascaras;

Mascaras::formataCPF('12345678909');        // '123.456.789-09'
Mascaras::formataCNPJ('92122313000130');    // '92.122.313/0001-30'
Mascaras::formataCPFCNPJ('92122313000130'); // decide pelo tamanho (11 = CPF, 14 = CNPJ)
Mascaras::formataCEP('87020160');           // '87.020-160' (false se inválido)
Mascaras::formataFone('44999999999');       // '(44) 99999-9999'
Mascaras::formataFone('4433334444');        // '(44) 3333-4444'
Mascaras::formataFone('08002424243');       // '0800 242-4243'
Mascaras::formataMoeda(1234567.891);        // '1.234.567,89'
Mascaras::formataMoeda(0);                  // '' (use formataMoeda(0, false) para '0,00')
Mascaras::formataNumero(1234.5678, 3);      // '1.234,568'
Mascaras::formataCOSIF('23543529');         // '2.3.5.43.52-9' (false se inválido)
Mascaras::formataCMC('29');                 // '000029'
Mascaras::formataCodLS('2001');             // '20.01'
Mascaras::formataCodVal('456243987');       // '456-243-987'
```

## Valor por extenso

```php
use Paliari\Brasil\ValorExtenso;

ValorExtenso::valorExtenso(1234.56);
// 'um mil, duzentos e trinta e quatro reais e cinquenta e seis centavos'

ValorExtenso::valorExtenso(1234.56, true);       // com iniciais maiúsculas
ValorExtenso::valorExtenso(2, false, '', 'F');   // 'duas' (sem moeda, feminino)
```

Parâmetros: `($valor, $maiusculas = false, $moeda = 'R', $sexo = 'M')`.

## Datas

`DateTimeBr`, `DateBr` e `DateMesBr` estendem
[`paliari/php-date-time`](https://github.com/paliari/php-date-time) (baseado no Carbon 3)
e aceitam data no formato brasileiro, universal ou timestamp.

```php
use Paliari\Brasil\DateTime\DateBr;
use Paliari\Brasil\DateTime\DateTimeBr;
use Paliari\Brasil\DateTime\DateMesBr;
use Paliari\Brasil\DateTime\DataExtenso;

echo new DateBr('25/12/2026');                 // '25/12/2026'
echo new DateBr('2026-12-25');                 // '25/12/2026'
echo new DateTimeBr('25/12/2026 14:30:00');    // '25/12/2026 14:30:00'
echo new DateMesBr('25/12/2026');              // '12/2026'

(new DateTimeBr('25/12/2026 14:30:00'))->toJSON(); // '2026-12-25T14:30:00+00:00'

$data = new DateBr('25/12/2026');
$data->dataExtenso();                              // 'sexta-feira, 25 de dezembro de 2026'
$data->dataExtenso(DataExtenso::DIA_MES_ANO);      // '25 de dezembro de 2026'
```

Formatos de `DataExtenso`: `SEMANA_DIA_MES_ANO`, `DIA_MES_ANO`,
`SEMANA_DIA_MES_ANO_HORA`, `DIA_MES_ANO_HORA`.

## Dias úteis e feriados

Considera fins de semana, feriados nacionais fixos, Sexta-feira Santa e Páscoa.

```php
use Paliari\Brasil\DateTime\DateBr;
use Paliari\Brasil\DateTime\DiaUtil;

DiaUtil::proxDiaUtil(new DateBr('25/12/2026'));     // 28/12/2026
DiaUtil::anteriorDiaUtil(new DateBr('25/12/2026')); // 24/12/2026
DiaUtil::isFeriado(new DateBr('03/04/2026'));       // true (Sexta-feira Santa)
DiaUtil::isWeekend(new DateBr('26/12/2026'));       // true

DiaUtil::dataPascoa(new DateBr('01/01/2026'));      // 05/04/2026
DiaUtil::dataCarnaval(new DateBr('01/01/2026'));    // 17/02/2026
// também: dataPaixaoCristo, dataQuartaCinzas, dataCorpusChristi, dataDomingoRamos
```

`proxDiaUtil` e `anteriorDiaUtil` retornam uma nova data; a data passada não é alterada.

Feriados estaduais, municipais ou vindos do banco de dados podem ser adicionados com um handler:

```php
DiaUtil::setFeriadoHandler(function ($data) {
    return $data->format('m-d') === '09-08';
});
```

## UF, meses e dias da semana

```php
use Paliari\Brasil\UF;
use Paliari\Brasil\Mes;
use Paliari\Brasil\Semana;

UF::$SIGLAS;           // ['AC' => 'AC', ...]
UF::$NOMES['PR'];      // 'Paraná'
UF::$REGIOES['SUL'];   // ['PR' => 'Paraná', 'RS' => 'Rio Grande do Sul', 'SC' => 'Santa Catarina']

Mes::$NOMES['03'];     // 'março'
Mes::$SIGLAS['03'];    // 'mar'

Semana::$NOMESF[1];    // 'segunda-feira' (1 = segunda ... 7 = domingo)
Semana::$SIGLAS[1];    // 'seg'
```

## Acentos

```php
use Paliari\Brasil\Acentos;

Acentos::remove('São Paulo, Ação');          // 'Sao Paulo, Acao'
Acentos::ucwords('SÃO JOSÉ DOS PINHAIS');    // 'São José Dos Pinhais'
```

## Testes

```bash
composer install
vendor/bin/phpunit
vendor/bin/phpunit --exclude-group slow   # pula os testes longos de datas
```

## Licença

[MIT](LICENSE)
