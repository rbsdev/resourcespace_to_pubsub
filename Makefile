build:
	composer install

clean-zips:
	rm -f *.tar.gz *.rsp

tar: clean-zips build
	git archive --format tar.gz --prefix resourcespace_to_pubsub/ -o resourcespace_to_pubsub.tar.gz HEAD

rsp: tar
	git archive --format tar.gz --prefix resourcespace_to_pubsub/ -o resourcespace_to_pubsub.rsp HEAD

download:
	#curl -fLJ https://github.com/rbsdev/resourcespace_to_pubsub/archive/refs/heads/main.tar.gz -o plugin.tar.gz
	curl -fLJ https://github.com/rbsdev/resourcespace_to_pubsub/archive/refs/tags/0.1.tar.gz -o plugin.tar.gz

install:
	curl -fLJ https://github.com/rbsdev/resourcespace_to_pubsub/archive/refs/tags/0.1.tar.gz -o plugin.tar.gz
	tar -xzvf plugin.tar.gz
	mv resourcespace_to_pubsub-0.1/ resourcespace_to_pubsub/
	sudo mv resourcespace_to_pubsub/ /var/www/resourcespace/filestore/plugins/
