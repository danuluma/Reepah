<?php
function os_redirect( $target )
{
	header( "Location: {$target}" );
	exit();
}

function os_mail( $receipients, $subject = 'Email From Transformers', $message = '', $cc = null, $attachments = null, $signature = null )
{
	$mailer = new PHPMailer\PHPMailer\PHPMailer(true);
	$receipients = is_array( $receipients ) ? $receipients : array( $receipients );

	foreach ( $receipients as $email => $name ) {
		$mailer -> addAddress( $email, $name );
	}

	if ( !is_null( $attachments ) ) {
		$attachments = is_array( $attachments ) ? $attachments : array( $attachments );

		foreach ($attachments as $file => $name ) {
			$mailer -> addAttachment( $file, $name );
		}
	}

	$signature = is_null( $signature ) ? get_option( 'about' ) : $signature;

	$mailer -> isHTML( true );

	$mailer -> From = get_option('email');
	$mailer -> FromName = get_option('name');

	$mailer -> Subject = $subject;
	$mailer -> Body = "<article>{$message}</article>\r\r<em>{$signature}</em>";
	$mailer -> AltBody = $message;

	return $mailer -> send();
}