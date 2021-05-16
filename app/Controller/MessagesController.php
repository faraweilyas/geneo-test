<?php

App::uses('AppController', 'Controller');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class MessagesController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Flash');

	protected $timeLimit = 5;

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

	public function getUserIP()
	{
		$userIP = "";
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$userIP = $_SERVER['HTTP_CLIENT_IP'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
		if (empty($userIP))
			$userIP = $_SERVER['REMOTE_ADDR'];
		return $userIP;
	}

	public function getTimeDifference($created)
	{
		$currentTime 	= new \DateTime();
		$createdTime 	= new \DateTime($created);
		$interval 		= $currentTime->diff($createdTime);
		return $interval->format('%i');
	}

	/**
	 * Check if submission is allowed after 5 mins
	 *
	 * @param string created
	 * @return boolean
	 */
	public function isSubmissionAllowed($created)
	{
		return ($this->getTimeDifference($created) > $this->timeLimit) ? true : false;
	}

	public function getTimeLeft($created)
	{
		return $this->timeLimit - $this->getTimeDifference($created);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this->layout = "main";

		if ($this->request->is('post')) {

			// Get most recent message sent by user to limit request
			$ipAddress 			= $this->getUserIP();
			$message 			= $this->Message->find('first', [
				'order' 		=> ['Message.created' => 'desc'],
				'conditions' 	=> ['Message.ip' => $ipAddress]
			]);

			// If a message was found then check if the time has elapsed
			// to know whether message will be saved or not
	        if (!empty($message)):
				if (!$this->isSubmissionAllowed($message['Message']['created']))
				{
					$timeLeft = $this->getTimeLeft($message['Message']['created']);
					$this->Flash->error(__("Please wait for {$timeLeft} min(s) before sending a new message."));
					return $this->redirect(array('action' => 'add'));
				}
	        endif;

	        // redirect if file upload fails but continue if file was uploaded or not
			$filename = $this->upload_file();
			if ($filename === false)
				return $this->redirect(array('action' => 'add'));

            $this->request->data['Message']['ip'] 	= $ipAddress;
            $this->request->data['Message']['file'] = $filename;

			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}
	}

	public function upload_file()
	{
		$filename 	= '';
		$uploadData = $this->request->data['Message']['file'] ?? "";
		if (empty($uploadData['name']))
			return $filename;

		if ($uploadData['size'] == 0 || $uploadData['error'] !== 0):
			$this->Flash->error(__("Invalid file."));
			return false;
		endif;

		$types = ['application/pdf', 'text/csv', 'application/vnd.ms-excel'];
		if (!in_array($uploadData['type'], $types)):
			$this->Flash->error(__("Invalid file format, only '.pdf, .xlsx and .csv' are allowed."));
			return false;
		endif;

		$filename 		= basename($uploadData['name']);
		$uploadFolder 	= WWW_ROOT.'documents';
		$filename 		= time().'_'.$filename;
		$uploadPath 	= $uploadFolder . DS . $filename;
		if (!file_exists($uploadFolder))
			mkdir($uploadFolder);

		if (!move_uploaded_file($uploadData['tmp_name'], $uploadPath)):
			$this->Flash->error(__("File upload failed."));
			return false;
		endif;

		return $filename;
	}
}
