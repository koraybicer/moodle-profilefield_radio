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
 * Radio button profile field definition.
 *
 * @package    profilefield_radio
 * @copyright  2012 onwards Dan Marsden {@link http://danmarsden.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class profile_define_radio extends profile_define_base {

    /**
     * Adds elements to the form for creating/editing this type of profile field.
     *
     * @param moodleform $form
     */
    public function define_form_specific($form): void {
        // Options for the radio buttons
        $form->addElement('textarea', 'param1', 
            get_string('profilemenuoptions', 'admin'),
            ['rows' => 6, 'cols' => 40]
        );
        $form->setType('param1', PARAM_MULTILANG);

        // Default value
        $form->addElement('text', 'defaultdata', 
            get_string('profiledefaultdata', 'admin'),
            ['size' => 50]
        );
        $form->setType('defaultdata', PARAM_MULTILANG);

        // Display orientation
        $orientations = [
            0 => get_string('horizontal', 'profilefield_radio'),
            1 => get_string('vertical', 'profilefield_radio')
        ];
        $form->addElement('select', 'param2', 
            get_string('display', 'profilefield_radio'),
            $orientations
        );
    }

    /**
     * Validates the form field data.
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function define_validate_specific($data, $files): array {
        $errors = [];
        $data->param1 = str_replace("\r", '', $data->param1);
        $options = explode("\n", $data->param1);

        if (empty($options)) {
            $errors['param1'] = get_string('profilemenunooptions', 'admin');
        } else if (count($options) < 2) {
            $errors['param1'] = get_string('profilemenutoofewoptions', 'admin');
        } else if (!empty($data->defaultdata) && !in_array($data->defaultdata, $options, true)) {
            $errors['defaultdata'] = get_string('profilemenudefaultnotinoptions', 'admin');
        }

        return $errors;
    }

    /**
     * Preprocesses data before it is saved.
     *
     * @param stdClass $data
     * @return stdClass
     */
    public function define_save_preprocess($data): object {
        $data->param1 = str_replace("\r", '', $data->param1);
        return $data;
    }
}