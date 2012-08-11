<?php
use Behat\Behat\Context\BehatContext;
    
use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\Selenium2Driver;

use Selenium\Client as SeleniumClient;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class GuiContext extends BehatContext
{

    public function __construct(array $parameters)
    {
		$mink = new Mink(array(
		    'selenium2' => new Session(new Selenium2Driver($parameters['wd_capabilities']['browser'], $parameters['wd_capabilities'], $parameters['wd_host'])),
		));

		$this->gui = $mink->getSession('selenium2');
    }

    /**
     * @Given /^I\'m on "([^"]*)"$/
     */
    public function iMOn($arg1)
    {
        $this->gui->start();
        $this->gui->visit($arg1);
    }

    /**
     * @Given /^I search for "([^"]*)"$/
     */
    public function iSearchFor($arg1)
    {
        $page = $this->gui->getPage();
        $page->fillField("lst-ib", $arg1);
        $page->find("css", ".jsb input[name='btnK']")->click();
        $this->gui->wait(1000);
    }

    /**
     * @Then /^I should see "([^"]*)" as the first result$/
     */
    public function iShouldSeeAsTheFirstResult($arg1)
    {
        $text = $this->gui->getPage()->find('css', "h3 a")->getText();
        assertEquals($text, $arg1);
        $this->gui->stop();
    }
    

}