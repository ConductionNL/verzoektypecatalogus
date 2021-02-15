# Request Type Catalogue 

Description
----
The request type catalogue provides an overview of possible requests to be initiated by the user, and the expected handling of these requests. 
In this respect, it can best be compared with a digital description of a form, in which it limits itself purely to the definition of the final value. 
It therefore contains a series of fields, and the condition that it must meet.

The fields to be supplied by the user are called properties, and each property can be described.
For the description of the fields, we use the OpenApi Standard as a guideline, which means that all typing for fields included in it may be applied.
This can be done in a number of ways:

**Simpel:**  

For example a name is a string of minimum 5 and maximum 255 characters. 

**Abstract:** 

For example a link is a valid URL.

**Linked Data:**

And from the Common Ground idea it can also be in the style of a linked data object description.
In the latter case, the OpenAPI 2 standard extension for types is used.
Where a type is defined as {{componentCode}} / {{resource}}.
For example, a person is a cc / people (or a person in the contacts component).


Linked data is by definition located in other components that hold the source, that is to say that only the reference to the source is stored in the dataset of a request.
However, use can be made of the extend functionality described in NL API strategy.
That is, it is possible to ask the VTC API to insert external resources as objects instead of references.
In this way it is possible to retrieve a request with underlying data in one go.

Vice versa it is also possible to create child resources in other components (by passing an object instead of a reference, but not providing it with an id property) or to update it (by giving an object instead of a reference, but providing it with an id property).  

Finally, a request type can also contain rules about what to do when a request changes status.
For example, it is possible when submitting a request, to have a case of a specific case type created in an API that supports the ZGW standard or to start a camunda process when starting a request.

Additional Information
----

- [Contributing](CONTRIBUTING.md)
- [ChangeLogs](CHANGELOG.md)
- [RoadMap](ROADMAP.md)
- [Security](SECURITY.md)
- [Licence](LICENSE.md)


Installation
----
We differentiate between two way's of installing this component, a local installation as part of the provided developers toolkit or an [helm](https://helm.sh/) installation on an development or production environment. 

#### Local installation
First make sure you have [docker desktop](https://www.docker.com/products/docker-desktop) running on your computer. Then clone the repository to a directory on your local machine through a [git command](https://github.com/git-guides/git-clone) or [git kraken](https://www.gitkraken.com) (ui for git). If successful you can now navigate to the directory of your cloned repository in a command prompt and execute docker-compose up. 
```CLI
$ docker-compose up
```
This will build the docker image and run the used containers and when seeing the log from the php container: "NOTICE: ready to handle connections", u are ready to view the documentation at localhost on your preferred browser.

#### Instalation on Kubernetes or Haven
As a haven compliant commonground component this component is installable on kubernetes trough helm. The helm files can be found in the api/helm folder. For installing this component trough helm simply open your (still) favorite command line interface and run 
```CLI
$ helm install [name] ./api/helm --kubeconfig kubeconfig.yaml --namespace [name] --set settings.env=prod,settings.debug=0,settings.cache=1
```
For an in depth installation guide you can refer to the [installation guide](INSTALLATION.md), it also contains a short tutorial on getting your cluster ready to expose your installation to the world

Standards
----

This component adheres to international, national and local standards (in that order), notable standards are:

- Any applicable [W3C](https://www.w3.org) standard, including but not limited to [rest](https://www.w3.org/2001/sw/wiki/REST), [JSON-LD](https://www.w3.org/TR/json-ld11/) and [WEBSUB](https://www.w3.org/TR/websub/)
- Any applicable [schema](https://schema.org/) standard
- [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.0.md)
- [GAIA-X](https://www.data-infrastructure.eu/GAIAX/Navigation/EN/Home/home.html)
- [Publiccode](https://docs.italia.it/italia/developers-italia/publiccodeyml-en/en/master/index.html), see the [publiccode](api/public/schema/publiccode.yaml) for further information
- [Forum Stanaardisatie](https://www.forumstandaardisatie.nl/open-standaarden)
- [NL API Strategie](https://docs.geostandaarden.nl/api/API-Strategie/)
- [Common Ground Realisatieprincipes](https://componentencatalogus.commonground.nl/20190130_-_Common_Ground_-_Realisatieprincipes.pdf)
- [Haven](https://haven.commonground.nl/docs/de-standaard)
- [NLX](https://docs.nlx.io/understanding-the-basics/introduction)
- [Standard for Public Code](https://standard.publiccode.net/), see the [compliancy scan](publiccode.md) for further information. 

Developers toolkit and technical information
----
You can find the data model, OAS documentation and other helpfull developers material like a  postman collection under api/public/schema, development support is provided trough the [samenorganiseren slack channel](https://join.slack.com/t/samenorganiseren/shared_invite/zt-dex1d7sk-wy11sKYWCF0qQYjJHSMW5Q).

Couple of quick tips when you start developing
- If you not yet have setup the component locally read the Tutorial for setting up your local environment.
- You can find the other components on [Github](https://github.com/ConductionNL).
- Take a look at the [commonground componenten catalogus](https://componentencatalogus.commonground.nl/componenten?) to prevent development collitions. 
- Use [Commongroun.conduction.nl](https://commonground.conduction.nl/) for easy deployment of test environments to deploy your development to.
- For information on how to work with the component you can refer to the tutorial [here](TUTORIAL.md).
  

Contributing
----
First of al please read the [Contributing](CONTRIBUTING.md) guideline's ;)

But most imporantly, welcome! We strife to keep an active community at [commonground.nl](https://commonground.nl/), please drop by and tell is what you are thinking about so that we can help you along.


Credits
----

Information about the authors of this component can be found [here](AUTHORS.md)





Copyright © [Gemeente 's-Hertogenbosch](https://www.s-hertogenbosch.nl/) 2019

[Licensed under the EUPL](LICENSE.md)
