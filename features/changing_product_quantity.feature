Feature: Changing the product quantity
  In order to acquire more or less merchandise
  As a Customer
  I want to be able to change a product quantity

  Background:
    Given there is a "PHP Mug" product that costs 100.00 USD
    And I am a "john@doe.com" customer
    And I have the "PHP Mug" product in my cart

  Scenario: Adding more items to the cart
    When I increase the "PHP Mug" quantity to 2
    Then my cart total should be 200.00 USD

  Scenario: Removing items from the cart
    Given I have increased the "PHP Mug" quantity to 2
    When I decrease the "PHP Mug" quantity to 1
    Then my cart total should be 100.00 USD
