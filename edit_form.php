<?php
//moodleform is defined in formslib.php

defined('MOODLE_INTERNAL') || die();
require_once ($CFG->dirroot . '/course/moodleform_mod.php');
require_once ($CFG->dirroot . '/libdir/formslib.php');
 
class edit_form extends moodleform {
    //Add elements to form
    public function definition() {
         global $COURSE, $DB, $CFG;
 
        $mform = $this->_form; // Don't forget the underscore! 
 
        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('email', 'Please enter email');        //Default value
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
    

}
?>