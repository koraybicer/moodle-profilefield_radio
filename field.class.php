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
 * Radio button profile field class.
 *
 * @package    profilefield_radio
 * @copyright  2012 onwards Dan Marsden {@link http://danmarsden.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class profile_field_radio extends profile_field_base {
    /** @var array $options List of radio options */
    protected array $options;
    
    /** @var int|null $datakey Selected option key */
    protected ?int $datakey;

    /**
     * Constructor
     *
     * @param int $fieldid Profile field id
     * @param int $userid User id
     */
    public function __construct(int $fieldid = 0, int $userid = 0) {
        parent::__construct($fieldid, $userid);
        
        $options = explode("\n", $this->field->param1);
        $this->options = array_map('format_string', $options);
        
        if ($this->data !== null) {
            $this->datakey = (int)array_search($this->data, $this->options, true);
        }
    }

    /**
     * Add field to form
     *
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_add($mform): void {
        $radioarray = [];
        $attributes = [];
        
        foreach ($this->options as $option) {
            $name = format_string($option);
            if (!empty($this->field->param2)) {
                $name .= '<br/>';
            }
            $radioarray[] = $mform->createElement('radio', $this->inputname, '', 
                $name, format_string($option), $attributes);
        }
        
        $mform->addGroup($radioarray, $this->inputname . '_grp', 
            format_string($this->field->name), [' '], false);
            
        if ($this->is_required()) {
            $mform->addRule($this->inputname, get_string('required'), 'required', null, 'client');
        }
    }

    /**
     * Lock field if required
     *
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_set_locked($mform): void {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }

        if ($this->is_locked() && !has_capability('moodle/user:update', context_system::instance())) {
            $mform->hardFreeze($this->inputname);
            $mform->setConstant($this->inputname, $this->datakey);
        }
    }
}
