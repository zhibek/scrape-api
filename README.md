# Scrape API

## Usage

Start by cloning this repository.

To run the app locally in the dev appserver:

~~~~
boot2docker init
boot2docker up
boot2docker shellinit
gcloud preview app run ./dispatch.yaml default/app.yaml phantomjs/app.yaml
~~~~

If needed, you can enable debug output:

~~~~
gcloud --verbosity debug preview app run ./dispatch.yaml default/app.yaml phantomjs/app.yaml
~~~~

To deploy the app in production:

~~~~
gcloud preview app deploy ./dispatch.yaml default/app.yaml phantomjs/app.yaml
~~~~