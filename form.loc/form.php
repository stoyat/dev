<?php

class Form
{
	public function sendForm () {
		if ( ! empty($_POST['contact']))
		{
			$valid =
				[
					'name'    => ['/^[a-z0-9_-]{6,12}$/', 'Вы ввели не корректное имя'],
					'email'   => ['/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD', 'Вы ввели не корректный email.'],
				];

			$errors = [];

			foreach ($valid as $field => $data)
			{
				$regex = $data[0];
				$message = $data[1];

				$input = trim($_POST[$field]);

				if (empty($input) OR ! preg_match($regex, $input))
				{
					$errors += array($field => $message);
				}
			}

			$result = empty($errors) ? 'success' : 'errors';

			echo json_encode(
				[
					'result' => $result,
					'errors' => $errors,
				]);
			exit;
		}
	}
}

$send = new Form();
$send->sendForm();

