<?php
/**
 * Implements hook_node_view()
 */
function example_node_view($node, $view_mode, $langcode) {
  // Should I pirate?
  if (!$node->nid % 2 == 0) {
    return;
  }
  // Get page text
  $wrapper = entity_metadata_wrapper('node', $node);
  $text = $wrapper->body->value();
  // Call to the pirate API
  $r = new HttpRequest('http://isithackday.com/arrpi.php', HttpRequest::METH_GET);
  $r->addQueryData(array('text' => $text));
  try {
    $r->send();
    if ($r->getResponseCode() == 200) {
      $pirate_text = $r->getResponseBody());
    }
  } catch (HttpException $ex) {
    drupal_set_message($ex);
  }
  // Replace node text
  $wrapper->body->set($pirate_text);
  // Return the node
  $node = $wrapper->value();
}
