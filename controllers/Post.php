<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Post Controller
 */
class Post extends CI_Controller
{
    public $crud;
    //public $id;
	function __construct()
	{
		parent::__construct();
		$this->load->model('crud');
	}

	public function index()
	{
        log_message('info', 'Vibhore informational message here.');
        log_message('error', 'this is vibhore custom message');
		$data['data'] = $this->crud->get_records('posts');
		$this->load->view('post/list', $data);
	}


	public function create()
	{
		$this->load->view('post/create');
	}


	public function store()
	{
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		$this->crud->insert('posts', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been saved successfully.</div>');
		redirect(base_url());
	}

	public function edit()
	{
        //echo "vibhore";die;
        $id = $this->uri->segment(3);
        //echo $id;
		$data['data'] = $this->crud->find_record_by_id('posts', $id);
        //print_r($data);die;
		$this->load->view('post/edit', $data);
	}

	public function update()
	{
        $id = $this->uri->segment(3);
        //echo $id;die;
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		$this->crud->update('posts', $data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been updated successfully.</div>');
		redirect(base_url());
	}

	public function delete()
	{
        $id = $this->uri->segment(2);
     	$this->crud->delete('posts', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been deleted successfully.</div>');
		redirect(base_url());
	}
}