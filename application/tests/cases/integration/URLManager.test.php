<?php

use \testlib\IntegrationTest;
use \testlib\util\SessionUtil;
use \testlib\util\RequestUtil;
use \ch\aeberhardo\url\URLManager;
use \Laravel\URL;

class URLManagerTest extends IntegrationTest {

    /**
     * @var URLManager
     */
    private $urlManager;

    protected function setUp() {
        parent::setUp();

        $this->urlManager = URLManager::make();
    }

    public function test_unknown_name() {
        $this->assertEquals('#', $this->urlManager->getURL('unknown'));
    }

    public function test_set_without_oldInput() {
        $this->urlManager->set('url_name', function() {
                    return 'url_address';
                });

        $this->assertEquals('url_address', $this->urlManager->getURL('url_name'));
    }

    public function test_set_with_oldInput() {

        // Input-Daten erzeugen, nach old Input flashen und danach current Input wieder clearen.
        // Input::merge(array('old_url_name' => 'old_url_address'));
        // Input::flash();
        // Input::clear();

        SessionUtil::addOldInput('url_name', 'old_url_address');

        $this->urlManager->set('url_name', function() {
                    return 'new_url_address';
                });

        $this->assertEquals('old_url_address', $this->urlManager->getURL('url_name'));
    }

    public function test_referrer_without_oldInput() {
        RequestUtil::addReferrer('referred_url_address');

        $this->urlManager->referrer('url_name');
        $this->assertEquals('referred_url_address', $this->urlManager->getURL('url_name'));
    }

    public function test_referrer_without_oldInput_with_nullReferrer() {
        $this->urlManager->referrer('url_name');
        $this->assertEquals(URL::home(), $this->urlManager->getURL('url_name'));
    }

    public function test_referrer_with_oldInput() {
        RequestUtil::addReferrer('referred_url_address');
        SessionUtil::addOldInput('url_name', 'old_url_address');

        $this->urlManager->referrer('url_name');
        $this->assertEquals('old_url_address', $this->urlManager->getURL('url_name'));
    }

    public function test_home_without_oldInput() {
        $this->urlManager->home('url_name');
        $this->assertEquals(URL::home(), $this->urlManager->getURL('url_name'));
    }

    public function test_home_with_oldInput() {
        SessionUtil::addOldInput('url_name', 'old_url_address');

        $this->urlManager->home('url_name');
        $this->assertEquals('old_url_address', $this->urlManager->getURL('url_name'));
    }

    public function test_magic_get() {
        $this->assertEquals('#', $this->urlManager->unknown);

        $this->urlManager->set('url_name', function() {
                    return 'url_address';
                });

        $this->assertEquals('url_address', $this->urlManager->url_name);
    }

    public function test_set_multiple() {

        RequestUtil::addReferrer('referred_url_address');

        $this->urlManager
                ->home('home_name')
                ->referrer('referrer_name')
                ->set('url_name', function() {
                            return 'url_address';
                        });

        $this->assertEquals(URL::home(), $this->urlManager->home_name);
        $this->assertEquals('referred_url_address', $this->urlManager->referrer_name);
        $this->assertEquals('url_address', $this->urlManager->url_name);
    }

    public function test_toHTML() {
        $this->urlManager->set('success', function() {
                    return 'url_success';
                });

        $this->urlManager->set('cancel', function() {
                    return 'url_cancel';
                });

        $expected = '<input type="hidden" name="success" value="url_success"><input type="hidden" name="cancel" value="url_cancel">';

        $this->assertEquals($expected, $this->urlManager->toHTML());
    }

    public function test_toHTML_empty() {
        $this->assertEquals('', $this->urlManager->toHTML());
    }

}
