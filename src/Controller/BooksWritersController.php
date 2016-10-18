<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BooksWriters Controller
 *
 * @property \App\Model\Table\BooksWritersTable $BooksWriters
 */
class BooksWritersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Books', 'Writers']
        ];
        $booksWriters = $this->paginate($this->BooksWriters);

        $this->set(compact('booksWriters'));
        $this->set('_serialize', ['booksWriters']);
    }

    /**
     * View method
     *
     * @param string|null $id Books Writer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $booksWriter = $this->BooksWriters->get($id, [
            'contain' => ['Books', 'Writers']
        ]);

        $this->set('booksWriter', $booksWriter);
        $this->set('_serialize', ['booksWriter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $booksWriter = $this->BooksWriters->newEntity();
        if ($this->request->is('post')) {
            $booksWriter = $this->BooksWriters->patchEntity($booksWriter, $this->request->data);
            if ($this->BooksWriters->save($booksWriter)) {
                $this->Flash->success(__('The books writer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The books writer could not be saved. Please, try again.'));
            }
        }
        $books = $this->BooksWriters->Books->find('list', ['limit' => 200]);
        $writers = $this->BooksWriters->Writers->find('list', ['limit' => 200]);
        $this->set(compact('booksWriter', 'books', 'writers'));
        $this->set('_serialize', ['booksWriter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Books Writer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $booksWriter = $this->BooksWriters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booksWriter = $this->BooksWriters->patchEntity($booksWriter, $this->request->data);
            if ($this->BooksWriters->save($booksWriter)) {
                $this->Flash->success(__('The books writer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The books writer could not be saved. Please, try again.'));
            }
        }
        $books = $this->BooksWriters->Books->find('list', ['limit' => 200]);
        $writers = $this->BooksWriters->Writers->find('list', ['limit' => 200]);
        $this->set(compact('booksWriter', 'books', 'writers'));
        $this->set('_serialize', ['booksWriter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Books Writer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booksWriter = $this->BooksWriters->get($id);
        if ($this->BooksWriters->delete($booksWriter)) {
            $this->Flash->success(__('The books writer has been deleted.'));
        } else {
            $this->Flash->error(__('The books writer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
