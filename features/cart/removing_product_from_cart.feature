Feature: Removing the product to a cart
  In order to remove obsolete products when I change my mind
  As a Customer
  I want to be able to remove a product from a cart

  Background:
    Given there is a "PHP Mug" product that costs 100.00 USD
    And I am a "john@doe.com" customer
    And I have the "PHP Mug" product in my cart

  Scenario:
    When I remove the "PHP Mug" from my cart
    Then my cart should not have "PHP Mug" product inside
    And its total should be 0 USD
