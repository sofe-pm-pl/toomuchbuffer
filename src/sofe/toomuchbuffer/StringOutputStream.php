<?php

/*
 *
 * toomuchbuffer
 *
 * Copyright (C) 2017 SOFe
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace sofe\toomuchbuffer;

class StringOutputStream implements AmendableOutputStream{
	/** @var string */
	private $string;

	public function __construct(string &$string){
		$this->string =& $string;
	}

	public function write(string $bytes){
		$this->string .= $bytes;
	}

	public function amend(int $startOffset, string $data){
		if($startOffset + strlen($data) > strlen($this->string)){
			throw new \OverflowException("Amendment will overflow the current buffer");
		}
		$this->string = substr_replace($this->string, $data, $startOffset);
	}

	public function close(){
	}
}
