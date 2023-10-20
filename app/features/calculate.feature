Feature: Calculate numbers
  In order to spare people
  to use their brain excessively
  this app will calculate for them


  Scenario Outline: Addition
    Given I have <numberOne>
    When I add <numberTwo>
    Then the sum should be <sum>

    Examples:
      | numberOne | numberTwo | sum |
      | 1 | 2 | 3 |
      | -0.6 | 0.8 | 0.2 |
      | 0.1 | 0.7 | 0.8 |
      | 3.3543876 | -54687.3543878 | -54684.0000002 |
      | 568 | 13 | 581 |

  Scenario Outline: Subtraction
    Given I have <numberOne>
    When I subtract a <numberTwo>
    Then the difference should be <difference>

    Examples:
      | numberOne | numberTwo | difference |
      | 1 | 2 | -1 |
      | -0.6 | 0.8 | -1.4 |
      | 0.8 | 0.7 | 0.1 |
      | 3.3543876 | -54687.3543878 | 54690.7087754 |
      | 568 | 13 | 555 |
      | -0.1 | 0.7 | -0.8 |
      | -0.1 | -0.7 | 0.6 |
      | 0.7+0.1 | 0.8 | 0 |

  Scenario Outline: Multiplication
    Given I have <numberOne>
    When I multiply it by a <numberTwo>
    Then the product should be <product>

    Examples:
      | numberOne | numberTwo | product |
      | 1 | 2 | 2 |
      | -0.6 | 0.8 | -0.48 |
      | 0.1 | 0.7 | 0.07 |
      | 3.3543876 | -54687.3543878 | -54684.0000002 |
      | 568 | 13 | 581 |

  Scenario Outline: Division
    Given I have <numberOne>
    When I divide it by a <numberTwo>
    And this <numberTwo> is not 0
    Then the quotient should be <quotient>

    Examples:
      | numberOne | numberTwo | quotient |
      | 1 | 2 | 3 |
      | -0.6 | 0.8 | 0.2 |
      | 0.1 | 0.7 | 0.8 |
      | 3.3543876 | -54687.3543878 | -54684.0000002 |
      | 568 | 13 | 581 |

  Scenario: Division by 0
    Given I have <numberOne>
    When I divide it by a <numberTwo>
    And this <numberTwo> is 0
    Then a division by zero error message should be thrown