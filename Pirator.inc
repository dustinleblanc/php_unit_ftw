<?php

class Pirator {
  /**
   * Determines whether a node should be pirated.
   * How bout every other node?
   * @return BOOL
   */
  public function shouldYe(stdClass $node) {
    if ($node->nid % 2 == 0) {
      return TRUE;
    }
    return FALSE;
  }

  public function translate(stdClass $node) {
    $wrapper = entity_metadata_wrapper('node', $node);
    $text = $this->getBody($wrapper);
    $translation = $this->getTranslation($text);
    $this->setContent($node, $translation);
    dpm($wrapper->value());
    return $wrapper->value();
  }

  /**
   * Call to the arrpi and get a translation
   *
   * @param string the text to translate
   */
  protected function getTranslation($text) {
    $data = array(
      'text' => $text,
    );
    $url = url('http://isithackday.com/arrpi.php', array('query' => $data));
    $r = drupal_http_request($url);

    if ($r->code == 200) {
      return $r->data;
    }
    else {
      drupal_set_message(t($r->error), 'error');
    }
  }

  /**
   * Get page text
   *
   * @param EntityValueWrapper $wrapper wrapped node
   *
   * @return string the node body text
   */
  protected function getBody(EntityDrupalWrapper $wrapper) {
    return $wrapper->body->value->value();
  }

  /**
   * Set translated
   *
   * @param EntityValueWrapper $wrapper wrapped node
   * @param string $translation [description]
   */
  protected function setContent(stdClass $node, $translation) {
    return $node->content['body'][0]['#markup'] = $translation;
  }
}
