<?php
// Este archivo es parte de Moodle - https://moodle.org/
//
// Moodle es software libre: puede redistribuirlo y/o modificarlo
// bajo los términos de la Licencia Pública General GNU como publicado por
// la Free Software Foundation, ya sea la versión 3 de la Licencia, o
// (a su elección) cualquier versión posterior.
//
// Moodle se distribuye con la esperanza de que sea útil,
// pero SIN NINGUNA GARANTÍA; sin siquiera la garantía implícita de
// COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la
// Licencia pública general de GNU para obtener más detalles.
//
// Debería haber recibido una copia de la Licencia pública general GNU
// junto con Moodle. Si no, vea <https://www.gnu.org/licenses/> ;.
//

/**
 * Archivo principal para ver saludos
 * 
 * @package local_greetings
 * @copyright 2023 Hoover <h2verhernandez@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 o posterior
 */

require_once('../../config.php');
require_once($CFG->dirroot. '/local/greetings/lib.php');
require_once($CFG->dirroot. '/local/greetings/message_form.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/greetings/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_greetings'));


$messageform = new local_greetings_message_form();

echo $OUTPUT->header();

if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
}

if (!isloggedin()) {
    echo get_string('greetinguser', 'local_greetings');
}

$messageform->display();
if ($data = $messageform->get_data()) {
    $message = required_param('message', PARAM_TEXT);
    
    echo $OUTPUT->heading($message, 4);
}

echo $OUTPUT->footer();