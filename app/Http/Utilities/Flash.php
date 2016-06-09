<?php

namespace App\Http\Utilities;

class Flash
{
	protected function create($title, $message, $type)
	{
		session()->flash('flash_message', compact('title', 'message', 'type'));
	}

	public function info($title, $message)
	{
		return $this->create($title, $message, 'info');
	}

	public function success($title, $message)
	{
		return $this->create($title, $message, 'success');
	}

	public function error($title, $message)
	{
		return $this->create($title, $message, 'error');
	}

	public function warning($title, $message)
	{
		return $this->create($title, $message, 'warning');
	}
}