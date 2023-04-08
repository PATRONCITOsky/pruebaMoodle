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

/**
 * Archivo para localizar mensaje
 * 
 * @package local_greetings
 * @copyright 2023 Hoover <h2verhernandez@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 o posterior
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Get a localised greeting message for a user
 * 
 * @param  \stdClass $user
 * @return string
 */
function local_greetings_get_greeting($user) {
    if ($user == null) {
        return get_string('greetinguser', 'local_greetings');
    }

    $country = $user->country;
    switch ($country) {
        case 'ES':
            $langstr = 'greetinguseres';
            break;
        case 'AU':
            $langstr = 'greetinguserau';
            break;
        case 'FJ':
            $langstr = 'greetinguserfj';
            break;
        case 'NZ':
            $langstr = 'greetingusernz';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }

    return get_string($langstr, 'local_greetings', fullname($user));
}

/**
 * Inserta un enlace a index.php en el menú de navegación de la página principal del sitio.
 *
 * @param navigation_node $frontpage Nodo que representa la página principal en el árbol de navegación.
 */
function local_greetings_extend_navigation_frontpage(navigation_node $frontpage)
{
    $frontpage->add(
        get_string('pluginname', 'local_greetings'),
        new moodle_url('/local/greetings/index.php'),
        navigation_node::TYPE_CUSTOM,
        null,
        null,
        new pix_icon('t/message', '')
    );
}

/**
 * NO SÉ
 * 
 * @param global_navigation $root jajajajajja
 */
function local_greetings_extend_navigation(global_navigation $root)
{
    $node = navigation_node::create(
        get_string('pluginname', 'local_greetings'),
        new moodle_url('/local/greetings/index.php')
    );

    $node->showinflatnavigation = true;
    $root->add_node($node);
}
