Feature: Parsing log file lines
  In order understand an HAProxy log file line
  As a sysadmin
  I want the line to be parsed and presented in some meaningful way

  Scenario: Some determinable business situation
    Given I have a log parser
    When I give the log parser the line of HTTP log 'haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"'
    Then The parser should be saying that the date is in February
