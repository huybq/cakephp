<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;

/**
 *
 * @property \App\Model\Table\WritersTable $Writers
 */
class ContactController extends AppController
{
	public function index()
	{
		$contact = new ContactForm();
		if ($this->request->is('post')) {
			pr($this->request->data);
			if ($contact->execute($this->request->data)) {
				$this->Flash->success('We will get back to you soon.');
			} else {
				$this->Flash->error('There was a problem submitting your form.');
			}
		}

		if ($this->request->is('get')) {
			//Values from the User Model e.g.
// 			$this->request->data['name'] = 'John Doe';
// 			$this->request->data['email'] = 'john.doe@example.com';
		}

// 		$contact->setErrors(["name" => ["_required" => "Your name is required"],
// 							"email" => ["_required" => "Your email is required"]]);
		$this->set('contact', $contact);
	}
}

?>