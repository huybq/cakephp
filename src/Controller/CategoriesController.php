<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Categories Controller
 * @property \App\Model\Table\CategoriesTable $Categories
 * @property \App\Model\Table\BooksTable $Books
 */
class CategoriesController extends AppController
{

	public $paginate = [];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	$this->paginate = [
			'limit'=>1
    	];

        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
    	$category = $this->Categories->find('all', array(
    			'conditions'=>array('Categories.slug'=>$slug)
    	))->first();

    	if ($category == null || empty($category)) {
    		throw new NotFoundException(__("Không tìm thấy danh mục nào"));
    	}

        $this->set('category', $category);
        $this->set('_serialize', ['category']);

       $this->paginate = [
       		'fields'=> array('id', 'title', 'slug', 'sale_price', 'image'),
       		'contain'=> array(
       				'Writers',
       				'Categories'
       		),
       		'conditions'=> array(
       				'published'=>1,
       				'Categories.slug'=>$slug
       		),
       		'limit'=>5
       ];

        $books = $this->paginate('Books');
        $this->set('books', $books);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

//     START ADMIN

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function admin_index()
    {
    	$categories = $this->paginate($this->Categories);

    	$this->set(compact('categories'));
    	$this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_view($id = null)
    {
    	$category = $this->Categories->get($id, [
    			'contain' => ['Books']
    	]);

    	$this->set('category', $category);
    	$this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
    	$category = $this->Categories->newEntity();
    	if ($this->request->is('post')) {
    		$category = $this->Categories->patchEntity($category, $this->request->data);
    		if ($this->Categories->save($category)) {
    			$this->Flash->success(__('The category has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The category could not be saved. Please, try again.'));
    		}
    	}
    	$this->set(compact('category'));
    	$this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
    	$category = $this->Categories->get($id, [
    			'contain' => []
    	]);
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$category = $this->Categories->patchEntity($category, $this->request->data);
    		if ($this->Categories->save($category)) {
    			$this->Flash->success(__('The category has been saved.'));

    			return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error(__('The category could not be saved. Please, try again.'));
    		}
    	}
    	$this->set(compact('category'));
    	$this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
    	$this->request->allowMethod(['post', 'delete']);
    	$category = $this->Categories->get($id);
    	if ($this->Categories->delete($category)) {
    		$this->Flash->success(__('The category has been deleted.'));
    	} else {
    		$this->Flash->error(__('The category could not be deleted. Please, try again.'));
    	}

    	return $this->redirect(['action' => 'index']);
    }
}
