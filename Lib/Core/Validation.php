<?php
namespace Scandiweb\Lib\Core;

/**
 * Description of Validation
 *
 * @author Sune
 */
class Validation
{
    public $errors = [];
    
    /**
     * validations method
     * @param string $field form field
     * @param string $label form label
     * @param array $rules validation rules
     */
    public function validateField(Request $req, $field, $rules=[])
    {
        $inputValue = $req->getInput($field);
        // Please, provide the data of indicated type
        if (!empty($rules)) {
            foreach ($rules as $key => $value) {
                // Check required rule in the array
                if ($key == "required" && $value == true) {
                    if (empty($inputValue)) {
                        $this->addError($field, "Please, submit required data");
                    }
                }

                // Check unique rule in the array
                if ($key == "unique" && $value == true) {
                    if ($rules["model"]) {
                        $model = new $rules["model"]();
                        $record = $model->findOne([$field => $inputValue]);
                        if ($record) {
                            $this->addError($field, "This field is unique and record already exist");
                        }
                    } else {
                        throw new \Exception("Model must be provided");
                    }
                }

                // Check numeric rule in the array
                if ($key == "numeric" && $value == true) {
                    if (!is_numeric($inputValue)) {
                        $this->addError($field, "Please, provide the data of indicated type");
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Check if all fields is validated
     *  @return boolean
     */
    public function isValidated()
    {
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    } 

    /**
     * validations method
     * 
     * @param string $field form field
     * @param string $message form error message
     */
    public function addError(string $field, string $message)
    {
        $this->errors[$field] = $message;
    }

    /**
     * validate all fields at once
     * 
     * @param array $rules 
     */
    public function validate(Request $req, $rules)
    {
        foreach ($rules as $key => $value) {
            $this->validateField($req, $key, $value);
        }
    }
}
