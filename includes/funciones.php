<?php

require 'app.php';

function incluirTemplate(string $nombreTemplate, bool $inicio = false) {
  //echo TEMPLATES_URL . "/$nombreTemplate.php";
  include TEMPLATES_URL . "/$nombreTemplate.php";
}