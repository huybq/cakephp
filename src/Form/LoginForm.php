<?php
// in src/Form/ContactForm.php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LoginForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('username', ['type' => 'string'])
            ->addField('password', ['type' => 'password']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator->add('username', 'length', [
                'rule' => ['minLength', 8],
                'message' => 'A username is required'
            ])->add('password', 'format', [
                'rule' => ['minLength', 8],
                'message' => 'A valid password is required',
            ]);
    }

    protected function _execute(array $data)
    {
        echo "KAJHSDKJAHSKDJHASKDJHKSDHJ";
        return true;
    }

    public function setErrors($errors)
    {
    	$this->_errors = $errors;
    }
}
?>