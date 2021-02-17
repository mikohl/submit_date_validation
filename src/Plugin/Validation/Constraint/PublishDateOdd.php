<?php

namespace Drupal\submit_date_validation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Checks if submit date is an odd date.
 *
 * @Constraint(
 *   id = "PublishDateOdd",
 *   label = @Translation("Publish Date Odd", context = "Validation"),
 *   type = "string",
 * )
 */
class PublishDateOdd extends Constraint {

  public $notOdd = 'Article must be published on an odd date. %value is not odd.';

}

/**
 * Validates Publish Date Odd constraint.
 */
class PublishDateOddValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {
    // Constraint can't be added to base field for specific content types
    // Check bundle before validation applied.
    $bundle = $items->getEntity()->bundle();
    if ($bundle == "article") {
      foreach ($items as $item) {
        if (date("d", $item->value) % 2 == 0) {
          $this->context->addViolation($constraint->notOdd, ['%value' => date("M d, Y", $item->value)]);
        }
      }
    }
  }

}
