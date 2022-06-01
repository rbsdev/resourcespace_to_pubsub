build:
	composer install

tar:
	git archive --format tar.gz  --prefix resourcespace_to_pubsub -o resourcespace_to_pubsub.tar.gz HEAD
