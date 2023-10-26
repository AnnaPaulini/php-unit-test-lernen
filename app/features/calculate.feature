Feature: Calculate numbers
  In order to spare people
  to use their brain excessively
  this app will calculate for them


  Scenario Outline: Addition
    Given I have a number <numberOne>
    When I add to the first number the number <numberTwo>
    Then the sum should be <sum>
    And no exception should have been thrown

    Examples:
      | numberOne | numberTwo      | sum            |
      | 1         | 2              | 3              |
      | -0.6      | 0.8            | 0.2            |
      | 0.1       | 0.7            | 0.8            |
      | 3.3543876 | -54687.3543878 | -54684.0000002 |
      | 568       | 13             | 581            |

  Scenario Outline: Subtraction
    Given I have a number <numberOne>
    When I subtract from the first number the number <numberTwo>
    Then the difference should be <difference>
    And no exception should have been thrown

    Examples:
      | numberOne | numberTwo      | difference    |
      | 1         | 2              | -1            |
      | -0.6      | 0.8            | -1.4          |
      | 0.8       | 0.7            | 0.1           |
      | 3.3543876 | -54687.3543878 | 54690.7087754 |
      | 568       | 13             | 555           |
      | -0.1      | 0.7            | -0.8          |
      | -0.1      | -0.7           | 0.6           |
      | 0.8       | 0.8            | 0             |

  Scenario Outline: Multiplication
    Given I have a number <numberOne>
    When I multiply the first number by the number <numberTwo>
    Then the product should be <product>
    And no exception should have been thrown

    Examples:
      | numberOne | numberTwo | product |
      | 8         | 7         | 56      |
      | -0.6      | 0.8       | -0.48   |
      | 0.1       | 0.7       | 0.07    |
      | -0.1      | -0.7      | 0.07    |
      | 0         | 357687    | 0       |
      | -274      | 0         | 0       |

  Scenario Outline: Division
    Given I have a number <numberOne>
    When I divide the first number by the number <numberTwo>
    Then the quotient should be <quotient>
    And no exception should have been thrown

    Examples:
      | numberOne | numberTwo         | quotient           |
      | 1         | 2                 | 0.5                |
      | -0.6      | 0.8               | -0.75              |
      | 0         | 357687            | 0                  |
      | 0.1       | 0.7               | 0.8                |
      | 4         | -16384            | -0.000244140625    |
      | 1         | 10000000000000000 | 0.0000000000000001 |
      | 1         | 3                 | 0.3333333333333333 |

  Scenario: Division by 0
    Given I have a number 1.0
    When I divide the first number by the number 0.0
    Then a division by zero error message should be thrown

  Scenario: Combination of Multiplication and Addition
    Given I have a number 7.0
    When I multiply the first number by the number 3.5
    And I add to the result the number 17.5
    Then the result should be 42.0
    And no exception should have been thrown

  Scenario: Combination of all four basic arithmetics
    Given I have a number 23
    When I add to the first number the number 7
    And I divide the result by the number 5
    And I multiply the result by the number 8
    And I subtract from the result the number 6
    Then the result should be 42.0
    And no exception should have been thrown
