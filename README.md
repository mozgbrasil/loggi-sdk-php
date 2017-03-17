[checkmark]: https://raw.githubusercontent.com/mozgbrasil/mozgbrasil.github.io/master/assets/images/logos/Red_star_32_32.png "MOZG"
![valid XHTML][checkmark]

[psr4]: http://www.php-fig.org/psr/psr-4/
[getcomposer]: https://getcomposer.org/
[uninstall-mods]: https://getcomposer.org/doc/03-cli.md#remove
[url-method]: https://www.loggi.com/contas/criar/GH5THM/

# Mozg\LoggiSdkPhp

## Sinopse

SDK de integração a [Loggi][url-method]

## Instalação - Atualização - Desinstalação

Esta biblioteca destina-se a ser instalado usando o [Composer][getcomposer].

Autoloading compatível é [PSR-4][psr4]

--

### Para instalar o módulo execute o comando a seguir no terminal do seu servidor

    composer require mozgbrasil/loggi-sdk-php

-- 

### Para atualizar o módulo execute o comando a seguir no terminal do seu servidor

    composer clear-cache && composer update

--

### Para [desinstalar][uninstall-mods] o módulo execute o comando a seguir no terminal do seu servidor

    composer remove mozgbrasil/loggi-sdk-php && composer clear-cache && composer update

## Perguntas mais frequentes "FAQ"

### Simulação de transação

Podemos executar o comando curl via terminal ou pelo seguinte serviço http://onlinecurl.com/

### Requisição de Orçamentos

	curl --request POST https://staging.loggi.com/api/v1/endereco/orcamento/ --header 'Content-Type: application/json;charset=UTF-8' --header 'Authorization: ApiKey [email da conta]:[chave da API da conta]' --data '{
	"city": 1,
	"package_type": "document",
	"payment_method": 3225,
	"transport_type": 1,
	"slo": 1,
	"waypoints": [
	    {
	        "by": "cep",
	        "query": {
	            "cep": "05135400",
	            "instructions": "Retirar pacote 182 com Silvio.",
	            "number": 77
	        }
	    },
	    {
	        "by": "address",
	        "query": {
	            "address": "Angélica",
	            "address_complement": "cj. 124",
	            "category": "Avenida",
	            "instructions": "Deixar pacote 182 com Celina.",
	            "number": 2491
	        }
	    }
	]
	}' --verbose

### Listar Pedidos 

	curl --request GET https://staging.loggi.com/api/v1/pedidos-status/ --header 'Content-Type: application/json;charset=UTF-8' --header 'Authorization: ApiKey [email da conta]:[chave da API da conta]'

### Listar Métodos de Pagamento 

	curl --request GET https://staging.loggi.com/api/v1/metodos-de-pagamento/ --header 'Content-Type: application/json;charset=UTF-8' --header 'Authorization: ApiKey [email da conta]:[chave da API da conta]' 

## Badges

[![Join the chat at https://gitter.im/mozgbrasil](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/mozgbrasil/)
[![Latest Stable Version](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/v/stable)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![Total Downloads](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/downloads)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/v/unstable)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![License](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/license)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![Monthly Downloads](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/d/monthly)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![Daily Downloads](https://poser.pugx.org/mozgbrasil/loggi-sdk-php/d/daily)](https://packagist.org/packages/mozgbrasil/loggi-sdk-php)
[![Reference Status](https://www.versioneye.com/php/mozgbrasil:loggi-sdk-php/reference_badge.svg?style=flat-square)](https://www.versioneye.com/php/mozgbrasil:loggi-sdk-php/references)
[![Dependency Status](https://www.versioneye.com/php/mozgbrasil:loggi-sdk-php/1.0.0/badge?style=flat-square)](https://www.versioneye.com/php/mozgbrasil:loggi-sdk-php/1.0.0)

:cat2: