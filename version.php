<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
* Version information for profilefield_radio
*
* @package    profilefield_radio
* @copyright  2012 onwards Dan Marsden {@link http://danmarsden.com}
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2024012600;        // Version date: YYYYMMDDXX
$plugin->requires  = 2022112800;        // Requires Moodle 4.2
$plugin->supported = [402, 403];        // Supported Moodle versions: 4.2-4.3
$plugin->component = 'profilefield_radio';
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '4.2.0';