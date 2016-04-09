<?php

class Messages extends MY_Controller{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('myteam/messages_model');
    }

    function index()
    {
        $data = array();
        $data['inbox'] = $this->messages_model->get_messages_from_folder(0);
    	$this->user_view('user/myteam/messages',$data);
    }

    function compose($action="",$id="")
    {
        $data = array();
        if ($action == "reply")
        {
            $message = $this->messages_model->get_message($id);
            $data['reply_teamid'] = $message->from_team_id;
            if (strtolower(substr($message->subject,0,4)) != 're:')
                $data['reply_subject'] = 'Re: '.$message->subject;
            else
                $data['reply_subject'] = $message->subject;
        }
        $data['owners'] = $this->messages_model->get_league_owners_data();
        $data['teamid'] = $this->teamid;
        $this->user_view('user/myteam/messages/compose', $data);
    }

    function send_message()
    {
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $body = $this->input->post('body');

        $this->messages_model->insert_new_message($to, $subject, $body);
    }

    function ajax_get_message()
    {
        $id = $this->input->post('id');
        $data['message'] = $this->messages_model->get_message($id);
        $this->load->view('user/myteam/messages/ajax_display_message',$data);
    }

    function delete_message()
    {
        $this->messages_model->delete_message($this->input->post('id'));
        //$this->messages_model->delete_message(9);
        
    }

    function ajax_message_list()
    {
        $data['messages'] = $this->messages_model->get_messages_from_folder($this->input->post('id'));
        $this->load->view('user/myteam/messages/ajax_message_list',$data);
    }

}