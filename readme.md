## Submission of the sample assignment.

My main focus has been on implementing a clean and well-structured domain design, focusing on the domain models specified in the assignment and the services suggesting project teams.
I have deliberately not implemented an ORM, but if I had to choose, doctrine would be my choice, because it is the least intrusive ORM design-wise, that I know of.
The design is also prepared for integration with an ORM by means of the Persistor and Finder interfaces. A short notice on the split into finder and persister is that this split usually minimises the "object relational impedance mismatch".
My next steps would have been to implement proper routing in a way that would ease exposing the routes to the frontend most likely by means of auto-discoverable responses, so that we move the implementation in direction of the richardson maturity model level 3. A logical subset of that work, would be to also implement json-schemas as part of the responses. Json-schemas that should also be used for validating client-input.
The frontend is all but non-existing since I planned for the assignment to be completed as an API-only submission. Unfortunately I didn't have the time to fully complete a RESTful api. This API would have provided all the endpoints needed for adding data as specified.

### Uncertainties
I was a bit uncertain if I should categorise the skills into education, skills etc. but it seemed to me that having a simple modle could fulfill the use-case of creating team-suggesions based on what competences were required and what was available.


### E/R diagram:
![alt text](https://github.com/jariwiklund/SigniflyAssignment/blob/master/er_diagram.png?raw=true "ER diagram")


### To install
*composer install*


### Run the tests:
*php vendor/phpunit/phpunit/phpunit tests*

### Run the server
(from the root of the installation)
*php -S localhost:8000 src/www/router.php*
Navigate to *localhost:8000* in a browser