<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::error($this->getMessage(), 
        	array(
                'user' => array( 'id' => auth()->user()->id ?? 1, 'nickname' => auth()->user()->nickname ?? 'guest' ),
	        	'code' => $this->getCode(),
	        	'file' => $this->getFile(),
	        	'line' => $this->getLine(),
        	)
        );
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(array('exception' => $this->getMessage()), 500);
    }
}
