# Makefile for php project setup

AUTHOR        = Jason Ball <nomaddesign@gmail.com>
PHPUNITCONFIG = Tests/Conf/phpunit.xml
RELEASE_VERSION = 0.1
RELEASE_MESSAGE = new version

define license
MIT License (MIT)

init:
	composer update -v -o
	@echo "$$license" > LICENSE

test:
	./Vendors/bin/phpunit --configuration $(PHPUNITCONFIG)

release:
	@git tag -a "v$$RELEASE_VERSION" -m "$$RELEASE_MESSAGE"
	git describe --tags
	git push --tags