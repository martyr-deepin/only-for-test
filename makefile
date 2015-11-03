all:

dist:
	tar zcf core.tar.gz * --exclude=templates/
	tar zcf app_config.tar.gz templates/
	echo "new branch test"

