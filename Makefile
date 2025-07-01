
##@ General

# The help target prints out all targets with their descriptions organized
# beneath their categories. The categories are represented by '##@' and the
# target descriptions by '##'. The awk commands is responsible for reading the
# entire set of makefiles included in this invocation, looking for lines of the
# file as xyz: ## something, and then pretty-format the target and help. Then,
# if there's a line with ##@ something, that gets pretty-printed as a category.
# More info on the usage of ANSI control characters for terminal formatting:
# https://en.wikipedia.org/wiki/ANSI_escape_code#SGR_parameters
# More info on the awk command:
# http://linuxcommand.org/lc3_adv_awk.php

#help:
#	echo "
#		doctrine
#     doctrine:migrations:current                [current] Outputs the current version.
#     doctrine:migrations:diff                   [diff] Generate a migration by comparing your current database to your mapping information.
#     doctrine:migrations:dump-schema            [dump-schema] Dump the schema for your database to a migration.
#     doctrine:migrations:execute                [execute] Execute a single migration version up or down manually.
#     doctrine:migrations:generate               [generate] Generate a blank migration class.
#     doctrine:migrations:latest                 [latest] Outputs the latest version number
#     doctrine:migrations:migrate                [migrate] Execute a migration to a specified version or the latest available version.
#     doctrine:migrations:rollup                 [rollup] Roll migrations up by deleting all tracked versions and inserting the one version that exists.
#     doctrine:migrations:status                 [status] View the status of a set of migrations.
#     doctrine:migrations:up-to-date             [up-to-date] Tells you if your schema is up-to-date.
#     doctrine:migrations:version                [version] Manually add and delete migration versions from the version table.
#     doctrine:migrations:sync-metadata-storage  [sync-metadata-storage] Ensures that the metadata storage is at the latest version.
#     doctrine:migrations:list                   [list-migrations] Display a list of all available migrations and their status."

MAIN_COMMAND = bin/console
EXP = '~^(?!(messenger_messages)$$)~'
FORMATED_MAKEFILE =awk 'BEGIN {FS = ":.*\#\#"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_0-9-]+:.*?\#\#/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^\#\#@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } '  Makefile
quotestr = $(subst ','\'',$1)

.PHONY: help
help: ## Display this help.
	${FORMATED_MAKEFILE}

##@ Development

.PHONY: fix
fix: ## Format source code. by variable path Example: make fix path="YourPathToFileOrDir"
	vendor/bin/php-cs-fixer fix $(path)

.PHONY: isdf
isdf: ## sync db with site
	${MAIN_COMMAND} app:import-site --src=db --level=full

.PHONY: isdfp
isdfp: ## sync db with site 1 external product id
	${MAIN_COMMAND} app:import-site --src=db --level=full --product-external-id=$(id)

.PHONY: isdq
isdq: ## sync db with site q
	${MAIN_COMMAND} app:import-site --src=db --level=quick

.PHONY: ipbyei
ipbyei: ## sync db with site for one product id=42608340
	${MAIN_COMMAND} app:import-site --src=db --level=full --product-external-id=$(id) -vvv

ci_cd: ## run ci/cd logic
	composer install --prefer-dist --no-scripts && php -d memory_limit=2048M ${MAIN_COMMAND} doctrine:migrations:migrate --no-interaction && php -d memory_limit=2048M ${MAIN_COMMAND} cache:clear

ci_cd_stg: ## run ci/cd logic stg
	composer install --prefer-dist --no-scripts && composer update --no-scripts && php -d memory_limit=2048M ${MAIN_COMMAND}  doctrine:migrations:migrate --no-interaction && php -d memory_limit=2048M ${MAIN_COMMAND} cache:clear

##@ Migration

.PHONY: mg
mg: ## [generate] Generate a blank migration class.
	${MAIN_COMMAND} doctrine:migrations:generate

.PHONY: md
md: ## [diff] Generate a migration by comparing your current database to your mapping information.
	${MAIN_COMMAND} doctrine:migrations:diff --filter-expression=$(EXP)

.PHONY: mmv
mmv: ## You can show more information about the process by increasing the verbosity level. To see the executed queries, set the level to debug with -vv:
	${MAIN_COMMAND} doctrine:migrations:migrate -vv

.PHONY: mma
mma: ## Wrap the entire migration in a transaction.
	${MAIN_COMMAND} doctrine:migrations:migrate --all-or-nothing

.PHONY: mmi
mmi: ## Execute the migration without a warning message which you need to interact with
	${MAIN_COMMAND} doctrine:migrations:migrate --no-interaction

.PHONY: ms
ms: ## View the status of a set of migrations.
	${MAIN_COMMAND} doctrine:migrations:status

##@ Validation

.PHONY: dsvv
dsvv: ## Validate the mapping files --verbose debug
	${MAIN_COMMAND} doctrine:schema:validate -vvv

.PHONY: dsv
dsv: ## Validate the mapping files
	${MAIN_COMMAND} doctrine:schema:validate

.PHONY: dsufv
dsufv: ## The doctrine:schema:update with --force -v
	${MAIN_COMMAND} doctrine:schema:update --force -v

.PHONY: php_stan
ps: ## Validate code with php stan
	vendor/bin/phpstan analyse --configuration phpstan.neon

.PHONY: analyse
analyse: ps ## analyze code style

##@ Schema

.PHONY: dsuf
dsuf: ## The doctrine:schema:update  with -force
	${MAIN_COMMAND} doctrine:schema:update --force

##@ Cache

.PHONY: cc
cc: ## Clear cache
	${MAIN_COMMAND} cache:clear

##@ Debug

.PHONY: dr
dr: ## Debug route command
	${MAIN_COMMAND} debug:route
dc: ## debug container example: c=doctrine.orm.
	${MAIN_COMMAND} debug:container $(c)

##@ Entity

.PHONY: em
em: ## Make entity or update
	${MAIN_COMMAND} make:entity

##@ EasyAdmin

.PHONY: mac
mac: ## Command creates a new EasyAdmin CRUD controler
	${MAIN_COMMAND} make:admin:crud

##@Tailwind

.PHONY: dam
dam: ## Debug assets map
	${MAIN_COMMAND} debug:asset-map

.PHONY: damf
damf: ## Debug assets map with full path
	${MAIN_COMMAND} debug:asset-map --full

.PHONY: tb
tb: ## tailwind build
	${MAIN_COMMAND} tailwind:build

.PHONY: amc
amc: ## asset-map:compile
	${MAIN_COMMAND} asset-map:compile

##@ Local

.PHONY: php_restart
php_restart: ## PHP restart
	/etc/init.d/php8.3-fpm restart

.PHONY: nginx_restart
nginx_restart: ## Nginx restart
	/etc/init.d/nginx restart
