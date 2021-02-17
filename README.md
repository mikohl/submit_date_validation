# submit_date_validation
A Drupal 8+ validation experiment.

A problem I ran into when working on form validation was that I couldn't
seem to validate base fields like Title and Submit Date for a specific bundle.

With custom fields, you would use hook_entity_bundle_field_info_alter(), which
takes the bundle as a parameter. Easy peasy to apply your validation to a
specific bundle type there.

Base fields are a different kettle of fish. To validate these fields you must use hook_entity_base_field_info_alter(). However the bundle information is not
a parameter in this hook.

You can get the bundle information in the Constraint Validator by using
$bundle = $items->getEntity()->bundle(). Then you can choose to apply your
validation only if the bundle type matches.
