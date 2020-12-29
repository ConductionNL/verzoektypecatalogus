Verzoek Type Catalogus, VTC
-------
De verzoektype catalogus biedt een overzicht van mogelijke door de gebruiker te starten verzoeken en de te verwachte afhandeling. Zij laat zich in deze het best vergelijken met een digitale beschrijving van een formulier, waarbij zij zich zuiver beperkt tot de definiëring van de eindwaarde. Ze bevat in deze dus een reeks van velden en de voorwaarde waaraan deze moeten voldoen. 

De door de gebruiker aan te leveren velden noemen we properties, en iedere property kan worden beschreven. Voor het omschrijven van de velden gebruiken we de OpenApi Standaard als richtlijn, dat betekent dat alle daarin opgenomen typering voor velden mogen worden toegepast. Dit kan op een aantal manieren:

**Simpel:**  

bijvoorbeeld een naam is een string van minimaal 5 en maximaal 255 teken. 

**Abstract:** 

bijvoorbeeld een link is een geldige URL

**Linked Data:**
 
en vanuit de Common Ground gedachte kan het ook in de trant van een linked data object beschrijving. In dat laatste geval wordt gebruik gemaakt van de OpenAPI 2 norm extensie voor types. Waarbij een type wordt gedefinieerd als {{componentCode}}/{{resource}}. Bijvoorbeeld een persoon is een cc/people (ofwel een persoon in het contacten component).

Linked data bevindt zich per definitie in andere componenten die bronhouder zijn, dat wil zeggen dat in de dataset van een verzoek alleen de verwijzing naar de bron wordt opgeslagen. Er kan echter wel gebruik worden gemaakt van de in NL API strategie omschreven extend functionaliteit. Dat wil zeggen het mogelijk is om aan de VTC API te vragen om externe bronnen in te voegen als objecten in plaats van verwijzingen. Op deze manier is het mogelijk om een verzoek met onderliggende data in één keer op te halen.

Omgekeerd is het ook mogelijk om onderliggende resources in andere componenten aan te maken (door in plaats van een verwijzing een object mee te geven, maar niet te voorzien van een id property) of deze bij te werken (door in plaats van een verwijzing een object mee te geven, maar wel te voorzien van een id property).  

Als laatste kan een verzoek type ook spelregels bevatten over wat er moet gebeuren als een verzoek van status verandert. Zo is het bijvoorbeeld mogelijk om bij het indienen van een verzoek, een zaak van een bepaald zaaktype te laten aanmaken in een API die de ZGW standaard ondersteunt of om bij bijvoorbeeld het opstarten van een verzoek een camunda proces op te starten.

## License
Copyright � [Gemeente 's-Hertogenbosch](https://www.s-hertogenbosch.nl/) 2019

[Licensed under the EUPL](LICENCE.md)
