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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * @package mod_vimeo
 * @author Bruno Magalhães <brunomagalhaes@blackbean.com.br>
 * @copyright 2018 by BlackBean Inc, all rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Loading all libraries, classes
 * and functions required by this
 * class execution.
 */
require_once(__DIR__.'/../../course/moodleform_mod.php');
require_once(__DIR__.'/locallib.php');

/**
 * 
 */
class mod_vimeo_mod_form extends moodleform_mod
{
    /**
     * 
     */
    public function definition() {
        /**
         * 
         */
        $this->_form->addElement('header', 'general', get_string('general', 'form'));
        $this->_form->addElement('hidden', 'id');
        $this->_form->setType('id', PARAM_INT);

        /**
         * 
         */
        $this->_form->addElement('text', 'name', get_string('label_name', 'mod_vimeo'), ['size' => '240']);
        $this->_form->setType('name', PARAM_TEXT);
        $this->_form->addRule('name', null, 'required', null, 'client');
        $this->_form->addRule('name', get_string('maximumchars', '', 240), 'maxlength', 240, 'client');
        $this->_form->addHelpButton('name', 'label_name', 'mod_vimeo');

        /**
         * 
         */
        $this->_form->addElement('text', 'video', get_string('label_video', 'mod_vimeo'), ['size' => '240']);
        $this->_form->setType('video', PARAM_TEXT);
        $this->_form->addRule('video', null, 'required', null, 'client');
        $this->_form->addRule('video', get_string('maximumchars', '', 240), 'maxlength', 240, 'client');
        $this->_form->addHelpButton('video', 'label_video', 'mod_vimeo');

        /**
         * 
         */
        $this->standard_intro_elements();

        /**
         * 
         */
        $this->_form->addElement('text', 'color', get_string('label_color', 'mod_vimeo'), 'maxlength="6" size="10"');
        $this->_form->setType('color', PARAM_TEXT);
        $this->_form->addHelpButton('color', 'label_color', 'mod_vimeo');

        /**
         * 
         */
        $this->_form->addElement('select', 'autoplay', get_string('label_autoplay', 'mod_vimeo'), [0 => get_string('label_no', 'mod_vimeo'), 1 => get_string('label_yes', 'mod_vimeo')]);
        $this->_form->setType('autoplay', PARAM_INT);
        $this->_form->addHelpButton('autoplay', 'label_autoplay', 'mod_vimeo');

        /**
         * 
         */
        $this->_form->addElement('select', 'autoloop', get_string('label_autoloop', 'mod_vimeo'), [0 => get_string('label_no', 'mod_vimeo'), 1 => get_string('label_yes', 'mod_vimeo')]);
        $this->_form->setType('autoloop', PARAM_INT);
        $this->_form->addHelpButton('autoloop', 'label_autoloop', 'mod_vimeo');

        /**
         * 
         */
        $this->_form->addElement('select', 'popupopen', get_string('label_popupopen', 'mod_vimeo'), [0 => get_string('label_no', 'mod_vimeo'), 1 => get_string('label_yes', 'mod_vimeo')]);
        $this->_form->setType('popupopen', PARAM_INT);
        $this->_form->addHelpButton('popupopen', 'label_popupopen', 'mod_vimeo');

        /**
         * 
         */
        $this->_form->addElement('text', 'popupwidth', get_string('label_popupwidth', 'mod_vimeo'), 'maxlength="4" size="10"');
        $this->_form->setType('popupwidth', PARAM_INT);
        $this->_form->addHelpButton('popupwidth', 'label_popupwidth', 'mod_vimeo');
        $this->_form->disabledIf('popupwidth', 'popupopen', 'eq', 0);
        $this->_form->setDefault('popupwidth', 640);

        /**
         * 
         */
        $this->_form->addElement('text', 'popupheight', get_string('label_popupheight', 'mod_vimeo'), 'maxlength="4" size="10"');
        $this->_form->setType('popupheight', PARAM_INT);
        $this->_form->addHelpButton('popupheight', 'label_popupheight', 'mod_vimeo');
        $this->_form->disabledIf('popupheight', 'popupopen', 'eq', 0);
        $this->_form->setDefault('popupheight', 360);

        /**
         * 
         */
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    /**
     * Add elements for setting
     * the custom completion rules.
     *  
     * @category completion
     * @return array List of added element names, or names of wrapping group elements.
     */
    public function add_completion_rules() {
        /**
         * 
         */
        $group = [
            $this->_form->createElement('select', 'completionprogress', ' ', [0 => '0%',
                                                                              10 => '10%',
                                                                              20 => '20%',
                                                                              30 => '30%',
                                                                              40 => '40%',
                                                                              50 => '50%',
                                                                              60 => '60%',
                                                                              70 => '70%',
                                                                              80 => '80%',
                                                                              90 => '90%',
                                                                              100 => '100%']),
            $this->_form->createElement('checkbox', 'completionenable', ' ', get_string('label_enable', 'mod_vimeo')),
        ];
        $this->_form->setType('completionprogress', PARAM_INT);
        $this->_form->addGroup($group, 'completionprogress', get_string('label_completion','mod_vimeo'), [''], false);
        $this->_form->addHelpButton('completionprogress', 'label_completion', 'mod_vimeo');
        $this->_form->disabledIf('completionprogress', 'completionenable', 'notchecked');

        /**
         * 
         */
        return ['completionprogress'];
    }

    /**
     * Called during validation to see
     * whether some module-specific
     * completion rules are selected.
     *
     * @param array $data Input data not yet validated.
     * @return bool True if one or more rules is enabled, false if none are.
     */
    public function completion_rule_enabled($data) {
        $data['completionenable'] = intval($data['completionenable']);
        $data['completionprogress'] = intval($data['completionprogress']);
        return($data['completionenable'] == 1 and
                $data['completionprogress'] >= 0 and
                $data['completionprogress'] <= 100);
    }

    /**
     * This function is responsible for validating
     * the supplied Vimeo video data and returning
     * all the validation errors as an array.
     * 
     * @param array $data
     * @param array $files
     * @return array
     */
    function validation($data, $files) {
        /**
         * Normalizing the supplied data and files parameters
         * and making sure they are within the required ranges,
         * or more precisely at least an array.
         */
        $data = (array)$data;
        $files = (array)$files;

        /**
         * Using the default validation errors
         * rules to validate the supplied data
         * and capturing the results.
         */
        $errors = parent::validation($data, $files);

        /**
         * Transforming the supplied data
         * array into an object required by
         * the internal validation function.
         */
        $video = (object)$data;

        /**
         * Validating the supplied Vimeo video object
         * using this module validation function and
         * merging any found validation errors into
         * the previous validation errors array.
         */
        if (vimeo_validate_video($video) == false) {
            $errors = array_merge($errors, $video->errors);
        }

        /**
         * Returning the validation errors
         * array as this function result.
         */
        return($errors);
    }
}