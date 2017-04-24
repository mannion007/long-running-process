Feature: Counting Customers within a given area code
  In order to know how many customers I have within a given area code
  As a Sales Manager
  I need to be able to count occurrences of an area code within my list of customers

Scenario: Counting the occurrences of an area code within a list which does have occurrences
  Given I have the list of customers with phone numbers:
    | name | phone_number |
    | Bart Simpson | 01474219080 |
    | Homer Simpson | 01322229089 |
    | Marge Simpson | 01634239088 |
    | Lisa Simpson | 01322249087 |
    | Maggie Simpson | 01659259086 |
    | Moe Szyslak | 01474269085 |
    | Barney Gumble | 01322279084 |
    | Carl Carlson | 01757289083 |
    | Lenny Leonard | 01324299082 |
    | Clancy Wiggum | 01474209081 |
  When I count occurrences of the 01474 area code
  Then The log should contain "3 of 10 phone numbers matched"