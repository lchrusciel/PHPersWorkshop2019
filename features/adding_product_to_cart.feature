Feature: Adding a product to a cart
  In order to acquire merchandise
  As a Customer
  I want to be able to add a product to a cart

  Background:
    Given there is a "PHP Mug" product that costs 100.00 USD
    And I am a "john@doe.com" customer

  Scenario: Adding single product to the cart
    When I add the "PHP Mug" product to my cart
    Then my cart should have "PHP Mug" product inside
    And my cart total should be 100.00 USD

  Scenario: Adding multiple products to the cart
    Given there is a "PHPers Mug" product that costs 150.00 USD
    When I add the "PHP Mug" product to my cart
    And I add the "PHPers Mug" product to my cart
    Then my cart should have "PHP Mug" and "PHPers Mug" products inside
    And my cart total should be 250.00 USD
