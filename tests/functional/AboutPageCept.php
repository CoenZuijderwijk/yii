<?php
    $I = new FunctionalTester($scenario);
    $I->wantTo('perform actions and see result');
    $I->amOnPage('/');
    $I->see('About');
    $I->click('About');
    $I->amOnPage('/site/about');
    $I->see('About');
    $I->dontSee('apple');
?>
