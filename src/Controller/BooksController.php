<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Book;
use Cake\Network\Session;
use Cake\Network\Exception\NotFoundException;
use function Cake\ORM\toArray;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 */
class BooksController extends AppController
{

	public $paginate = [
			'contain'=>array('Writers'),
			'limit' => 10
	];

	public function listBooks() {
		$books = $this->paginate($this->Books);
		$this->set('books', $books);
	}

	public function detailBook($slug = null) {

		$book = $this->Books->find('all', array(
				'contain' => ['Categories', 'Writers', 'Comments'],
				'conditions'=> array('Books.slug'=>$slug),
		))->first();

		if ($book == null) {
			throw new NotFoundException(__("Không tìm thấy quyển sách nào !"));
		}

        $this->set('book', $book);
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	$books = $this->Books->find('all', array(
    		'fields'=>array('id', 'title', 'image' , 'sale_price','slug'),
    		'limit'=>15,
    		'contain'=>array('Writers')
    	));
        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
    	$book = $this->Books->find('all', array(
    			'conditions'=>array('Books.slug'=> $slug),
    			'contain'=> array(
    					'Writers' => function (\Cake\ORM\Query $query) {
        					return $query->select(['name', 'slug']);
    					}
    			)
    	))->first();

    	if ($book == null) {
    		throw new NotFoundException(__("Không tìm thấy quyển sách này !"));
    	}

        $this->set('book', $book);

        // display comment
        $this->loadModel("Comments");

        $comments = $this->Comments->find('all', array(
        		'conditions'=>array('book_id'=>$book->id),
        		'order'=>array('Comments.created'=>'asc'),
        		'contain'=>array(
        				'Users'=> function (\Cake\ORM\Query $query) {
        					return $query->select(['username']);
        				}
        		)
        ))->toArray();
        $this->set('comments', $comments);

        $relateBooks = $this->Books->find('all', array(
        		'fields'=>array('id', 'title', 'slug', 'sale_price', 'image', 'category_id'),
        		'contain'=>array(
        				'Writers'=>function (\Cake\ORM\Query $query) {
        					return $query->select(['name','slug']);
        				}
        		),
        		'conditions'=>array(
        				'Books.id'<>$book->id,
        				'category_id'=>$book->category_id,
        				'published'=>1
        		),
        		'limit'=>5,
        		'order'=>'rand()'

        ))->toArray();
        $this->set('relateBooks', $relateBooks);
    }

//     START ADMIN

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function admin_index()
    {
    	$this->paginate = [
    			'contain' => ['Categories']
    	];
    	$books = $this->paginate($this->Books);

    	$this->set(compact('books'));
    	$this->set('_serialize', ['books']);
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_view($id = null)
    {
    	$book = $this->Books->get($id, [
    			'contain' => ['Categories', 'Writers', 'Comments']
    	]);

    	$this->set('book', $book);
    	$this->set('_serialize', ['book']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
    	$book = $this->Books->newEntity();
    	if ($this->request->is('post')) {
    		$book = $this->Books->patchEntity($book, $this->request->data);
    		if ($this->Books->save($book)) {
    			$this->Flash->success(__('The book has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The book could not be saved. Please, try again.'));
    		}
    	}
    	$categories = $this->Books->Categories->find('list', ['limit' => 200]);
    	$writers = $this->Books->Writers->find('list', ['limit' => 200]);
    	$this->set(compact('book', 'categories', 'writers'));
    	$this->set('_serialize', ['book']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
    	$book = $this->Books->get($id, [
    			'contain' => ['Writers']
    	]);
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$book = $this->Books->patchEntity($book, $this->request->data);
    		if ($this->Books->save($book)) {
    			$this->Flash->success(__('The book has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The book could not be saved. Please, try again.'));
    		}
    	}
    	$categories = $this->Books->Categories->find('list', ['limit' => 200]);
    	$writers = $this->Books->Writers->find('list', ['limit' => 200]);
    	$this->set(compact('book', 'categories', 'writers'));
    	//         $this->set('_serialize', ['book']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
    	$this->request->allowMethod(['post', 'delete']);
    	$book = $this->Books->get($id);
    	if ($this->Books->delete($book)) {
    		$this->Flash->success(__('The book has been deleted.'));
    	} else {
    		$this->Flash->error(__('The book could not be deleted. Please, try again.'));
    	}

    	return $this->redirect(['action' => 'index']);
    }
}
