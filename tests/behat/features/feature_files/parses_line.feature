Feature: Parsing log file lines
  In order understand an HAProxy log file line
  As a sysadmin
  I want the line to be parsed and presented in some meaningful way

  Scenario: Some determinable business situation
    Given I have a log parser
    When I give the log parser the line 'haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0'
    Then The parser should be saying that the date is in February
