<?php

function order_by($id)
{
    if ($id = 0){return 'last_name';}
    if ($id = 1){return 'position.text_id';}
    if ($id = 2){return 'club_id';}

    return 'last_name';

}

function player_modal($id = 0)
{
	?>
	<!-- Confirm modal -->
		<div class="modal fade" id="confirm-modal" aria-hidden="true" style="z-index:1060; top:25%">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body text-center">
						Player Modal
					</div>
				</div>
			</div>
		</div>
	<?
}

function t_mysql($unixtimestamp = null)
{
    if ($unixtimestamp == null)
        $unixtimestamp = time();
    return date("Y-m-d H:i:s", $unixtimestamp);
}

function gmail_send($to,$subject,$body)
{
    $from = "ffl@mylanparty.net";
    require_once "Mail.php";

    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'ffl@mylanparty.net',
            'password' => 'wolf spider political search'
        ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo('<p>' . $mail->getMessage() . '</p>');
    } else {
        echo('<p>Message successfully sent!</p>');
    }
}