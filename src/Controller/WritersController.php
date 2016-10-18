<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Writers Controller
 * @property \App\Model\Table\WritersTable $Writers
 */
class WritersController extends AppController
{

	public $paginate = [];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $writers = $this->paginate($this->Writers);

        $this->set(compact('writers'));
        $this->set('_serialize', ['writers']);
    }

    /**
     * View method
     *
     * @param string|null $id Writer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {

        $writer = $this->Writers->find('all', array(
        		'conditions'=>array('slug'=>$slug),
        		'recursive'=>-1
        ))->first();

        if ($writer == null) {
        	throw new NotFoundException(__("Không tìm thấy trang này !"));
        }

        $this->set('writer', $writer);

        $this->paginate = [
        		'recursive'=>-1,
        		'fields'=>array('id','title','slug','image','sale_price'),
        		'order'=>array('created'=>'desc'),
        		'limit'=>1,
        		'contain'=>array(
        				'Writers'
        		),
        		'join' => array(
        				array(
        						'table'=>'books_writers',
        						'alias'=>'BooksWriters',
        						'conditions'=>'Books.id = BooksWriters.book_id'
        				),
        				array(
        						'table'=>'writers',
        						'alias'=>'Writers',
        						'conditions'=>'BooksWriters.writer_id = Writers.id'
        				)
        		),
        		'conditions'=> array(
        				'published'=>1,
        				'Writers.slug'=>$slug
        		),
        ];

        $books = $this->paginate('Books');
        $this->set('books', $books);
    }

//     START ADMIN
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function admin_index()
    {
    	$writers = $this->paginate($this->Writers);

    	$this->set(compact('writers'));
    	$this->set('_serialize', ['writers']);
    }

    /**
     * View method
     *
     * @param string|null $id Writer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_view($id = null)
    {
    	$writer = $this->Writers->get($id, [
    			'contain' => ['Books']
    	]);

    	$this->set('writer', $writer);
    	$this->set('_serialize', ['writer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
    	$writer = $this->Writers->newEntity();
    	if ($this->request->is('post')) {
    		$writer = $this->Writers->patchEntity($writer, $this->request->data);
    		if ($this->Writers->save($writer)) {
    			$this->Flash->success(__('The writer has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The writer could not be saved. Please, try again.'));
    		}
    	}
    	$books = $this->Writers->Books->find('list', ['limit' => 200]);
    	$this->set(compact('writer', 'books'));
    	$this->set('_serialize', ['writer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Writer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
    	$writer = $this->Writers->get($id, [
    			'contain' => ['Books']
    	]);
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$writer = $this->Writers->patchEntity($writer, $this->request->data);
    		if ($this->Writers->save($writer)) {
    			$this->Flash->success(__('The writer has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The writer could not be saved. Please, try again.'));
    		}
    	}
    	$books = $this->Writers->Books->find('list', ['limit' => 200]);
    	$this->set(compact('writer', 'books'));
    	$this->set('_serialize', ['writer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Writer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
    	$this->request->allowMethod(['post', 'delete']);
    	$writer = $this->Writers->get($id);
    	if ($this->Writers->delete($writer)) {
    		$this->Flash->success(__('The writer has been deleted.'));
    	} else {
    		$this->Flash->error(__('The writer could not be deleted. Please, try again.'));
    	}

    	return $this->redirect(['action' => 'index']);
    }
}
