@product_catalog
Feature: Managing products
  In order to sell my merchandise
  As a Store Owner
  I want to be able to manage my product catalog

  @application
  Scenario: Adding new product
    When I add a "PHP Mug" product that costs 100.00 USD
    Then I should see a "PHP Mug" in my product catalog
