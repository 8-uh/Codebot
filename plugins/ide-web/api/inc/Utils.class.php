<?php
/*
	The MIT License (MIT)

	Copyright (c) 2015 Fernando Bevilacqua

	Permission is hereby granted, free of charge, to any person obtaining a copy of
	this software and associated documentation files (the "Software"), to deal in
	the Software without restriction, including without limitation the rights to
	use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
	the Software, and to permit persons to whom the Software is furnished to do so,
	subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all
	copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
	FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
	COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
	IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
	CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

namespace Codebot;

class Utils {
	public static function errorToException($theErrno, $theErrStr, $theErrfile, $theErrLine, array $theErrContext) {
	    // error was suppressed with the @-operator
	    if (error_reporting() == 0) {
	        return false;
	    }

	    throw new ErrorException($theErrStr, 0, $theErrno, $theErrfile, $theErrLine);
	}

	public static function log($theContent, $theLabel = 'CODEBOT', $theLine = '') {
		if(CODEBOT_LOG_ENABLED) {
			file_put_contents(CODEBOT_LOG_FILE, date('Y-m-d h:i:s') . ' ['.$theLabel.':'.$theLine.'] ' . $theContent . "\n", FILE_APPEND);
		}
	}

	public static function securePath($thePath) {
		$thePath = basename($thePath);
		$thePath = str_replace(array('.', '..', ':', ';'), '', $thePath);

		return escapeshellcmd($thePath);
	}

	public static function escapePath($thePath) {
		return escapeshellcmd(str_replace('..', '', $thePath));
	}

	public static function systemExec($theCmd, $theFile = '', $theLine = '') {
		$aOut = array();

		exec($theCmd, $aOut);
		Utils::log($theCmd . ' ' . implode("\n", $aOut), $theFile, $theLine);

		return $aOut;
	}

	public static function downloadFile($theUrl) {
		$aCh = curl_init();

		curl_setopt($aCh, CURLOPT_URL, $theUrl);
		curl_setopt($aCh, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($aCh, CURLOPT_SSL_VERIFYPEER, false);

		$aData 	= curl_exec($aCh);
		$aError = curl_error($aCh);

		curl_close($aCh);

		if($aError != '') {
			throw new Exception($aError);
		}

		return $aData;
	}

	public static function removeAnySlashAtEnd($theString) {
		$aLastChar = $theString[strlen($theString) - 1];

		if($aLastChar == '/' || $aLastChar == '\\') {
			$theString = substr($theString, 0, -1);
		}

		return $theString;
	}

	public static function removeAnySlashAtStart($theString) {
		if($theString[0] == '/' || $theString[0] == '\\') {
			$theString = substr($theString, 1);
		}

		return $theString;
	}
}

?>
