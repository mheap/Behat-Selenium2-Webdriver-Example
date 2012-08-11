Feature: Visit Google and search

Scenario: Run a search for Behat
	Given I'm on "http://google.com/?complete=0"
	And I search for "behat"
	Then I should see "Behat — BDD for PHP" as the first result