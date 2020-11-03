# Boxalino Real Time User Experience (RTUX) Integration - PHP

## Introduction
For the PHP integration, Boxalino comes with a divided approach: framework layer, data export layer and integration layer.
The current repository is used as aN **integration layer**.

This repository is a test-framework for the API requests, response and the API library.
With the use of Docker, will create a symfony web-server on which the API requests can be tested.
**The response is returned raw JSON**


## Integration
This repository is **not** subject to Boxalino maintenance on client setup.
This means, the guidelines are supposed to be integrated in a repository/plugin maintainted & developed by the client`s team.

This repository can be deployed for testing Boxalino features or in order to prepare your own integration.
In order to deploy it as is in a local environment, check the *Setup* steps bellow.

## Prerequisites
You are able to use the repository if:
1. you have access to Boxalino API credentials
2. a data index is available for your Boxalino account
3. narratives and layout blocks have been designed in the Boxalino Intelligence admin

## Documentation
The latest documentation is available in the wiki.

## Setup (for local/testing purposes)
1. Clone/Fork the repository
  ``git clone ``

2. Create the environment file (.env) based on .env.dist and set the credentials

3. Run the CLI image and do a composer update to install dependencies
  ``docker-compose run --rm cli-setup /bin/bash``
  ``composer update``
  
4. Launch the Symfony web server
  ``docker-compose up -d app``
  
5. Check the **port** that`s assigned to component's port 8000
  ``docker ps -a | grep 8000/tcp``
  
6. Check the API response / request for each use-cases:
 * listing :                    /navigation/<id>
 * search :                     /search/?query=<query>&page=<page-nr>&order=<order>&sort=<sort-field>
 * product recommendation :     /product/<id>
 * basket recommendation  :     /cart/?product_id=<last-product-id>&other_cart_ids=<id|id|id>
 * autocomplete :               /autocomplete?query=<query>

## Contact us!

If you have any question, just contact us at support@boxalino.com
