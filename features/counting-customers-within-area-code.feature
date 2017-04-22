Feature: Counting Customers within a given area code
  In order to know how many customers I have within a given area code
  As a Sales Manager
  I need to be able to count occurrences of an area code within my list of customers

Scenario: Counting the occurrences of an area code within a list which does have occurrences
  Given I have the phone numbers:
    | phone_number |
    | 01474219080 |
    | 01322229089 |
    | 01634239088 |
    | 01322249087 |
    | 01659259086 |
    | 01474269085 |
    | 01322279084 |
    | 01757289083 |
    | 01324299082 |
    | 01474209081 |
  When I Count occurrences of the 01474 area code
  Then The log should contain "3 occurrences found"